<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Restaurant;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Auth;




class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all(); // Fetch all reviews
        return view('reviews.index', compact('reviews')); // Updated to match your file path
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reviews.create');
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
            'comment' => 'required|string',
            'rating' => 'required|integer|between:1,5'
        ]);
    
        // Set user_id statically to 1
        $validatedData['user_id'] = 1;
    
        $review = Review::create($validatedData);
    
        return redirect()->route('reviews')->with('success', 'Review created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $review = Review::findOrFail($id);
        return view('reviews.show', compact('review'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the review by ID
        $review = Review::find($id);
    
        // Check if the review exists
        if ($review) {
            // Return the edit view with the review data
            return view('reviews.edit', compact('review'));
        } else {
            return redirect()->route('reviews')->with('error', 'Review not found');
        }
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
        $validatedData = $request->validate([
            'comment' => 'string',
            'rating' => 'integer|between:1,5'
        ]);
    
        $review = Review::find($id);
        if ($review) {
            // Ensure user_id remains 1
            $validatedData['user_id'] = 1;
    
            $review->update($validatedData);
            return redirect()->route('reviews')->with('success', 'Review updated successfully.');
        } else {
            return response()->json(['message' => 'Review not found'], 404);
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
return redirect()->route('reviews')->with('success', 'Review deleted successfully.');
    }


    public function indexFront ()
    {
        $reviews = Review::where('user_id', auth()->id())->get();
    return view('front-office.reviews.index', compact('reviews'));
    }

    public function updateFront(Request $request, $id)
    {
        $validatedData = $request->validate([
            'comment' => 'string',
            'rating' => 'integer|between:1,5'
        ]);
    
        $review = Review::find($id);
        if ($review) {
            // Ensure user_id remains 1
            $validatedData['user_id'] = 1;
    
            $review->update($validatedData);
            return redirect()->route('myreviews')->with('success', 'Review updated successfully.');
        } else {
            return response()->json(['message' => 'Review not found'], 404);
        }
    }

    public function editFront($id)
    {
        // Find the review by ID
        $review = Review::find($id);
    
        // Check if the review exists
        if ($review) {
            // Return the edit view with the review data
            return view('front-office.reviews.edit', compact('review'));
        } else {
            return redirect()->route('myreviews')->with('error', 'Review not found');
        }
    }

    

    public function createFront()
    {
       
            $restaurants = Restaurant::all(); // Fetch all restaurants
            return view('front-office.reviews.create', compact('restaurants')); // Pass the restaurants to the view
        }
        public function storeFront(Request $request)
        {$validatedData = $request->validate(['restaurant_id' => 'required|exists:restaurants,id', 
             'comment' => 'required|string','rating' => 'required|integer|between:1,5',]);

            $review = Review::create([
                'user_id' => Auth::id(),
                'restaurant_id' => $validatedData['restaurant_id'],
                'comment' => $validatedData['comment'],
                'rating' => $validatedData['rating'],
            ]);
    
            return redirect()->route('myreviews')->with('success', 'Review created successfully.'); // Adjust redirection as needed
        }

    
}
