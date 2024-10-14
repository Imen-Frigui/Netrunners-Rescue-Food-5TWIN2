<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(){

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);

        $user = User::create($attributes);
        auth()->login($user);
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
}

