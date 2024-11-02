<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Controllers\ReviewController;
use App\Models\Review;
use App\Models\Inventory;
use App\Models\Food;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all restaurants
        $restaurants = Restaurant::all();
    
        // Pass the restaurants data and activePage variable to the view
        return view('restaurants.index', ['restaurants' => $restaurants, 'activePage' => 'restaurants']);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurants.create');
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email'=>'required|string|max:255',
            'phone' => 'required|string|max:20',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Restaurant::create($request->all());

        return redirect()->route('restaurants')->with('success', 'Restaurant created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.edit', compact('restaurant'));
    
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
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($request->all());

        return redirect()->route('restaurants')->with('success', 'Restaurant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('restaurants')->with('success', 'Restaurant deleted successfully.');
    }

    public function showInventory($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId); // Load the restaurant
    
        // Get all inventory items for the restaurant where quantity_on_hand is greater than or equal to minimum_quantity
        $inventories = Inventory::where('restaurant_id', $restaurant->id)
            ->whereColumn('quantity_on_hand', '>=', 'minimum_quantity')
            ->get(); 
    
        $foodIds = $inventories->pluck('food_id'); // Get a collection of food IDs
    
        $foods = Food::whereIn('id', $foodIds)->get(); // Get foods that exist in the inventory
    
       
    
        $reviews = Review::where('restaurant_id', $restaurant->id)->get();
    
        return view('front-office.restaurants.show', compact('restaurant', 'foods','inventories', 'reviews')); // Pass the restaurant, inventories, and reviews to the view
    }
    

    public function all()
    {
        $restaurants = Restaurant::all();
        return view('front-office.restaurants.index', compact('restaurants'));
    }
  
}
