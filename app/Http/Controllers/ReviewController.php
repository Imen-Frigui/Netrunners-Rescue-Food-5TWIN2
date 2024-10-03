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
        return view('components.reviews.index', compact('reviews')); // Updated to match your file path
    }
    


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    return response()->json($review, 201);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $review = Review::find($id);
    if ($review) {
        return response()->json($review, 200);
    } else {
        return response()->json(['message' => 'Review not found'], 404);
    }
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
        $validatedData = $request->validate([
            'user_id' => 'integer',
            'comment' => 'string',
            'rating' => 'integer|between:1,5'
        ]);
    
        $review = Review::find($id);
        if ($review) {
            $review->update($validatedData);
            return response()->json($review, 200);
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
        $review = Review::find($id);
        if ($review) {
            $review->delete();
            return response()->json(['message' => 'Review deleted'], 200);
        } else {
            return response()->json(['message' => 'Review not found'], 404);
        }
    }
    
}
