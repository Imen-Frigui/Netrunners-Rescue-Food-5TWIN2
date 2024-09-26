<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    // List all charities

    public function index()
{
    $charities = Charity::all();
    return view('charity.index', compact('charities'))->with('activePage', 'charities');
}


    // Show the form for creating a new charity
    public function create()
    {
        return view('charity.create');
    }


    public function showdetails($id)
    {
        // Find the charity by ID
        $charity = Charity::findOrFail($id);
    
        // Pass charity data to the view
        return view('charity.details', compact('charity'));
    }
    

    // Store a newly created charity in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'charity_name' => 'required',
            'address' => 'required',
            'contact_info' => 'required|array',
            'charity_type' => 'required',
            'beneficiaries_count' => 'required|integer',
            'preferred_food_types' => 'nullable|string', // Allow null for optional field
            'last_received_donation' => 'nullable|date', // Add this line

        ]);
        $validated['preferred_food_types'] = $validated['preferred_food_types'] ?? 'none';

        Charity::create($validated);
        return redirect()->route('charities')->with('success', 'Charity created successfully!');
    }

    // Show a single charity
/*     public function show(Charity $charity)
    {
        return view('charities.show', compact('charity'));
    }
 */
    // Show the form for editing a charity
    public function edit(Charity $charity)
    {
        return view('charities.edit', compact('charity'));
    }

    // Update the charity in the database
    public function update(Request $request, Charity $charity)
    {
        $validated = $request->validate([
            'charity_name' => 'required',
            'address' => 'required',
            'contact_info' => 'required|array',
            'charity_type' => 'required',
            'beneficiaries_count' => 'required|integer',
        ]);

        $charity->update($validated);
        return redirect()->route('charities.index')->with('success', 'Charity updated successfully!');
    }

// Delete a charity from the database
public function destroy($id)
{
    // Find and delete the charity
    $charity = Charity::findOrFail($id);
    $charity->delete();

    // Redirect to the index route for charities
    return redirect()->route('charities')->with('success', 'Charity deleted successfully.');
}

    // Search for charities by name or type
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $charities = Charity::where('charity_name', 'like', "%{$query}%")
                            ->orWhere('charity_type', 'like', "%{$query}%")
                            ->get();

        return view('charities.index', compact('charities'));
    }
}
