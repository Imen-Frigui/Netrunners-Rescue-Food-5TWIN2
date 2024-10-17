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


public function frontindex()
{
    $charities = Charity::paginate(4); // Display 4 charities per page
    return view('charity.frontindex', compact('charities'))->with('activePage', 'frontindex');
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
    
    public function frontdetails($id)
    {
        // Find the charity by ID
        $charity = Charity::findOrFail($id);
    
        // Pass charity data to the view
        return view('charity.frontdetails', compact('charity'));
    }

    public function store(Request $request) {
        // Validate the request inputs
        $validatedData = $request->validate([
            'charity_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_info.email' => 'required|email|max:255',
            'contact_info.phone' => 'required|string|max:15',
            'charity_type' => 'required|string|max:100',
            'beneficiaries_count' => 'required|integer|min:1',
            'preferred_food_types' => 'nullable|string', // Change to string
            'request_history' => 'nullable|string',
            'inventory_status' => 'nullable|string',
            'last_received_donation' => 'nullable|date',
            'donation_frequency' => 'nullable|string|max:100',
            'assigned_drivers_volunteers' => 'nullable|string|max:255',
            'current_requests' => 'nullable|string',
            'charity_rating' => 'nullable|numeric|min:0|max:5',
            'charity_approval_status' => 'required|in:approved,pending,rejected',
        ], [
            // Custom error messages
            'charity_name.required' => 'Le nom de la charité est requis.',
            'address.required' => 'L\'adresse est requise.',
            'contact_info.email.required' => 'L\'email est requis.',
            'contact_info.phone.required' => 'Le numéro de téléphone est requis.',
            'charity_type.required' => 'Le type de charité est requis.',
            'beneficiaries_count.required' => 'Le nombre de bénéficiaires est requis.',
            'beneficiaries_count.integer' => 'Le nombre de bénéficiaires doit être un nombre entier.',
            'beneficiaries_count.min' => 'Le nombre de bénéficiaires doit être au moins 1.',
            'preferred_food_types.string' => 'Les types d\'aliments préférés doivent être un tableau.',
            'last_received_donation.date' => 'La date de la dernière donation reçue doit être une date valide.',
            'donation_frequency.max' => 'La fréquence de donation ne peut pas dépasser 100 caractères.',
            'assigned_drivers_volunteers.max' => 'Les chauffeurs/volontaires assignés ne peuvent pas dépasser 255 caractères.',
            'charity_rating.numeric' => 'La note de la charité doit être un nombre.',
            'charity_rating.min' => 'La note de la charité doit être au moins 0.',
            'charity_rating.max' => 'La note de la charité ne peut pas dépasser 5.',
            'charity_approval_status.required' => 'Le statut d\'approbation de la charité est requis.',
            'charity_approval_status.in' => 'Le statut d\'approbation de la charité doit être approuvé, en attente ou rejeté.',
        ]);
    
        // Save the charity data
        Charity::create($validatedData);
    
        return redirect()->route('charities')->with('success', 'Charity added successfully!');
    }
    

    // Show a single charity
/*     public function show(Charity $charity)
    {
        return view('charities.show', compact('charity'));
    }
 */
   



 public function edit($id) {
    $charity = Charity::findOrFail($id);
    return view('charity.edit', compact('charity'));
}


 // Update the charity in the database
 public function update(Request $request, Charity $charity)
 {
     // Validate the incoming request
     $validated = $request->validate([
        'charity_approval_status' => 'required|in:approved,pending,rejected',
         'charity_name' => 'required|string|max:255',
         'address' => 'required|string',
         'contact_info' => 'required|array',
         'charity_type' => 'required|string',
         'beneficiaries_count' => 'required|integer',
         'preferred_food_types' => 'nullable|string',
         'last_received_donation' => 'nullable|date'
     ]);

     // Update the charity record
     $charity->update($validated);

     // Redirect back to the charity list with a success message
     return redirect()->route('charities')->with('success', 'Charity updated successfully!');
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
