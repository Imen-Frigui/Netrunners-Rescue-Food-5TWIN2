<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Food;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;

class DonationController extends Controller
{
    /**
     * Display a listing of donations with pagination and search functionality.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Donation::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('donor_type', 'LIKE', "%$search%")
                ->orWhereHas('food', function ($q) use ($search) {
                    $q->where('food_name', 'LIKE', "%$search%");
                });
        }

        // Pagination
        $donations = $query->with('food')->paginate(5);

        return view('donation2.index', compact('donations'));
    }

    /**
     * Show the form for creating a new donation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foods = Food::all(); // Retrieve all available food items
        return view('donation2.create', compact('foods'));
    }

    /**
     * Store a newly created donation in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'food_id' => 'required',
            'donor_type' => 'required|in:Restaurant,Individual,Charity',
            'donation_date' => 'required|date',
            'quantity' => 'required|integer|min:1|max:2000',
            'status' => 'required|in:Pending,Approved,Completed,Canceled',
            'remarks' => 'nullable|string',
        ]);

        Donation::create($request->all());

        return redirect()->route('donation-management.index')->with('success', 'Donation created successfully.');
    }

    /**
     * Display the specified donation.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $donation = Donation::with('food')->findOrFail($id);
    
            // Prepare data to send to modal
            return response()->json([
                'donor_type' => $donation->donor_type,
                'food_name' => $donation->food->food_name,
                'quantity' => $donation->quantity,
                'status' => $donation->status,
                'donation_date' => $donation->donation_date,
                'remarks' => $donation->remarks,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Donation not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified donation.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        $foods = Food::all();
        return view('donation2.edit', compact('donation', 'foods'));
    }

    /**
     * Update the specified donation in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation rules
        $request->validate([
            'food_id' => 'required',
            'donor_type' => 'required|in:Restaurant,Individual,Charity',
            'donation_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Pending,Approved,Completed,Canceled',
            'remarks' => 'nullable|string',
        ]);

        $donation = Donation::findOrFail($id);
        $donation->update($request->all());

        return redirect()->route('donation-management.index')->with('success', 'Donation updated successfully.');
    }

    /**
     * Remove the specified donation from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();

        return redirect()->route('donation-management.index')->with('success', 'Donation deleted successfully.');
    }


    public function frontendCreate()
    {
        $foods = Food::all(); 
        return view('donations.create', compact('foods'));
    }

    /**
     * Store a newly created donation from the frontend.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function frontendStore(Request $request)
    {
        // Validation rules
        $request->validate([
            'food_id' => 'required',
            'donor_type' => 'required|in:Restaurant,Individual,Charity',
            'quantity' => 'required|integer|min:1|max:2000',
            'remarks' => 'nullable|string',
        ]);

        Donation::create([
            'food_id' => $request->input('food_id'),
            'donor_type' => $request->input('donor_type'),
            'quantity' => $request->input('quantity'),
            'remarks' => $request->input('remarks'),
            'status' => 'Pending', 
            'donation_date' => now(),
        ]);

        return redirect()->route('donations.create')->with('success', 'Thank you! Your donation has been submitted.');
    }
    
}
