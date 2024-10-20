<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\PickupRequest;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Driver;

use Illuminate\Http\Request;

class PickupRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */public function index(Request $request)
{
    $query = PickupRequest::with(['user'])->orderBy('created_at', 'desc');

    // Apply status filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Apply search
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('id', 'like', "%{$searchTerm}%")
              ->orWhere('pickup_address', 'like', "%{$searchTerm}%")
              ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                  $userQuery->where('name', 'like', "%{$searchTerm}%");
              });
        });
    }

    $pickupRequests = $query->get();

    return view('pickups.index', compact('pickupRequests'));
}

    public function accept($id)
    {
        $request = PickupRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();

        return redirect()->back()->with('success', 'Pickup request accepted successfully.');
    }
    public function reject($id)
    {
        $request = PickupRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return redirect()->back()->with('success', 'Pickup request rejected successfully.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('user_type', 'user')->get();
        $restaurants = Restaurant::all();
        $food = Food::all();
    
        return view('pickups.create', compact('users', 'restaurants', 'food'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',  
            'restaurant_id' => 'required|integer',  
            'pickup_time' => 'required|date',  
            'pickup_address' => 'required|string|max:255',  
            'status' => 'required|in:pending,approved,rejected',  
            'food_id' => 'required|integer', 
        ]);

        PickupRequest::create($request->all());


        return redirect()->route('pickup-management')->with('success', 'Pickup request created successfully.');
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
        $pickup = PickupRequest::findOrFail($id);
        return view('pickups.edit', compact('pickup'));
    }

    public function update(Request $request, $id)
    {
        $pickup = PickupRequest::findOrFail($id);

        $validatedData = $request->validate([
            'pickup_address' => 'required|string|max:255',
            'pickup_time' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $pickup->update($validatedData);

        return redirect()->route('pickup-management')->with('success', 'Pickup request updated successfully.');
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

    public function getAvailableDrivers()
    {
        $drivers = Driver::with('user')
            ->whereIn('availability_status', ['available', 'busy'])
            ->get();
        
        return response()->json($drivers);
    }

    public function assignDriver(Request $request, PickupRequest $pickupRequest)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id'
        ]);

        try {
            $pickupRequest->update([
                'driver_id' => $request->driver_id
            ]);

            Driver::where('id', $request->driver_id)
                ->update(['availability_status' => 'busy']);

            return response()->json([
                'success' => true,
                'message' => 'Driver assigned successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to assign driver: ' . $e->getMessage(), [
                'exception' => $e,
                'pickupRequest' => $pickupRequest->id,
                'driver_id' => $request->driver_id
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign driver'
            ], 500);
        }
    }
}
