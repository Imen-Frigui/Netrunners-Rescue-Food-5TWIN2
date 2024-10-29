<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;

use App\Http\Requests\DriverRequest;
class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Driver::with(['pickupRequests.food']);

        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%");
            });
        }

        if ($request->filled('status')) {
            $query->where('availability_status', $request->status);
        }

        $drivers = $query->get();

        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15',
            'vehicle_type' => 'required|string|max:255',
            'vehicle_plate_number' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'availability_status' => 'required|in:available,busy,offline',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password' => 'secret', 
            "user_type"=>"driver"
        ]);

        Driver::create([
            'user_id' => $user->id,
            'vehicle_type' => $validatedData['vehicle_type'],
            'vehicle_plate_number' => $validatedData['vehicle_plate_number'],
            'license_number' => $validatedData['license_number'],
            'availability_status' => $validatedData['availability_status'],
            // 'current_location' => $validatedData['current_location'], 
            // 'max_delivery_capacity' => $validatedData['max_delivery_capacity'], 
            'phone_number' => $validatedData['phone_number'],
        ]);

        return redirect()->route('driver-management')->with('success', 'Driver created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Driver::with('user')->findOrFail($id);
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:15',
            'vehicle_type' => 'required|string|max:255',
            'vehicle_plate_number' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'availability_status' => 'required|in:available,busy,offline',
        ]);

        $driver->update($validatedData);

        return redirect()->route('driver-management')->with('success', 'Driver profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myPickups(Request $request)
    {
        $user = auth()->user();
        $driver = Driver::where('user_id', $user->id)->first();
        
        if (!$driver) {
            return redirect()->route('driver-management')->with('error', 'Driver not found.');
        }

        $pickupRequests = $driver->pickupRequests()->with('food')->get();

        return view('drivers.mypickupsAssigned', compact('pickupRequests'));
    }
}
