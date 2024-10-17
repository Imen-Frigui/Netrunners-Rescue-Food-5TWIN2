<?php

namespace App\Http\Controllers;

use Str;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function createForUserType($userType)
    {
        if (!in_array($userType, ['admin', 'user'])) {
            abort(404);
        }

        return view('sessions.create', ['userType' => $userType]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required|in:admin,user'
        ]);

        $user = User::where('email', $attributes['email'])->first();

        if (!$user || $user->user_type !== $attributes['user_type']) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified for the selected user type.'
            ]);
        }

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();

        return $this->redirectBasedOnUserType($user);
    }

    private function redirectBasedOnUserType(User $user)
    {
        switch ($user->user_type) {
            case 'admin':
                return redirect()->route('dashboard');
            case 'user':
            default:
                return redirect()->route('front-office.index');
        }
    }

    public function show()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function update()
    {
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }
}