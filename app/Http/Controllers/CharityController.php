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

   // Store a newly created charity in the database
public function store(Request $request) {
    $request->validate([
        'charity_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'contact_info.email' => 'required|email|max:255',
        'contact_info.phone' => 'required|string|max:15', // Change max length as needed
        'charity_type' => 'required|string|max:100',
        'beneficiaries_count' => 'required|integer|min:1', // At least one beneficiary
        'preferred_food_types' => 'nullable|array', // Change to array validation
        'request_history' => 'nullable|string', // Keep as string for JSON input
        'inventory_status' => 'nullable|string', // Keep as string for JSON input
        'last_received_donation' => 'nullable|date', // Check if the date is valid
        'donation_frequency' => 'nullable|string|max:100',
        'assigned_drivers_volunteers' => 'nullable|string|max:255',
        'current_requests' => 'nullable|string', // Keep as string for JSON input
        'charity_rating' => 'nullable|numeric|min:0|max:5', // Rating between 0 and 5
        'charity_approval_status' => 'required|in:approved,pending,rejected', // Must be one of the given options
    ], [
        // Custom error messages (optional)
        'charity_name.required' => 'Le nom de la charité est requis.',
        'address.required' => 'L\'adresse est requise.',
        'contact_info.email.required' => 'L\'email est requis.',
        'contact_info.phone.required' => 'Le numéro de téléphone est requis.',
        'charity_type.required' => 'Le type de charité est requis.',
        'beneficiaries_count.required' => 'Le nombre de bénéficiaires est requis.',
        'beneficiaries_count.integer' => 'Le nombre de bénéficiaires doit être un nombre entier.',
        'beneficiaries_count.min' => 'Le nombre de bénéficiaires doit être au moins 1.',
        'preferred_food_types.array' => 'Les types d\'aliments préférés doivent être un tableau.',
        'preferred_food_types.max' => 'La longueur des types d\'aliments préférés ne peut pas dépasser 255 caractères.',
        'request_history.json' => 'L\'historique des demandes doit être un JSON valide.',
        'inventory_status.json' => 'Le statut de l\'inventaire doit être un JSON valide.',
        'last_received_donation.date' => 'La date de la dernière donation reçue doit être une date valide.',
        'donation_frequency.max' => 'La fréquence de donation ne peut pas dépasser 100 caractères.',
        'assigned_drivers_volunteers.max' => 'Les chauffeurs/volontaires assignés ne peuvent pas dépasser 255 caractères.',
        'charity_rating.numeric' => 'La note de la charité doit être un nombre.',
        'charity_rating.min' => 'La note de la charité doit être au moins 0.',
        'charity_rating.max' => 'La note de la charité ne peut pas dépasser 5.',
        'charity_approval_status.required' => 'Le statut d\'approbation de la charité est requis.',
        'charity_approval_status.in' => 'Le statut d\'approbation de la charité doit être approuvé, en attente ou rejeté.',
    ]);

    // Convert preferred food types to JSON string
    $preferredFoodTypesJson = json_encode($request->preferred_food_types); // Convert to JSON string

    // Prepare data for the Charity model
    $charityData = $request->all();
    $charityData['preferred_food_types'] = $preferredFoodTypesJson; // Assign JSON string
    $charityData['request_history'] = json_encode($request->request_history); // Optional: encode if needed
    $charityData['inventory_status'] = json_encode($request->inventory_status); // Optional: encode if needed
    $charityData['current_requests'] = json_encode($request->current_requests); // Optional: encode if needed

    // Save the charity data
    Charity::create($charityData);

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
