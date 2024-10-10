<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PickupRequest;
use App\Models\User;

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
        $users = User::all();
        return view('pickups.create', compact('users'));

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
            'user_id' => 'required|exists:users,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'pickup_time' => 'required|date',
            'pickup_address' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'food_id' => 'required|exists:foods,id',
        ]);

        PickupRequest::create($request->all());


        return redirect()->route('pickups.index')->with('success', 'Pickup request created successfully.');
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
}
