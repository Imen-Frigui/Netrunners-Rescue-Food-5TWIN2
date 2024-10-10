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
     */
    public function index()
    {
        $pickupRequests = PickupRequest::with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();
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
        //
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
        //
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
