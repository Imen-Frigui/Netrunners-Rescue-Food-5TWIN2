<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;


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
        'user_id' => 'required|integer',
        'comment' => 'required|string',
        'rating' => 'required|integer|between:1,5'
    ]);

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
            'user_id' => 'integer',
            'comment' => 'string',
            'rating' => 'integer|between:1,5'
        ]);
    
        $review = Review::find($id);
        if ($review) {
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
    
}
