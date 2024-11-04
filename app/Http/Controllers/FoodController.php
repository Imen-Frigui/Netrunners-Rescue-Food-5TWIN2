<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\Restaurant;



class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::paginate(5);
        return view('foods.index', compact('foods'));
    }
    public function donations()
    {
        // Fetch food items where the expiration date is near
        $foods = Food::whereBetween('expiration_date', [now(), now()->addDays(7)])
            ->where('status', 'available')
            ->get();

        return view('donations.index', compact('foods'));
    }

    public function showDonation($id)
    {
        $food = Food::findOrFail($id);
        return view('donations.show', compact('food'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all(); 
        return view('foods.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'food_name' => 'required|string|max:25',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|in:kg,liters,pieces',
            'expiration_date' => 'required|date',
            'category' => 'required|in:fruit,vegetable,dairy,meat,grain,canned_food,beverage,baked_goods,seafood',
            'status' => 'required|in:available,expired,donated',
            'storage_conditions' => 'nullable|in:refrigerated,frozen,ambient,dry,humidity_controlled,vacuum_sealed,cool_dark_place',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $food = Food::create($request->except('restaurant_id'));

        $food->restaurants()->sync($request->restaurant_id);

        return redirect()->route('foods.index')->with('success', 'Food item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $food = Food::findOrFail($id);
            return response()->json($food);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Food item not found'], 404);
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
        $restaurants = Restaurant::all(); 
        $food = Food::findOrFail($id);
        return view('foods.edit', compact('food', 'restaurants'));
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
        // Validation rules
        $request->validate([
            'food_name' => 'required|string|max:25',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|in:kg,liters,pieces',
            'expiration_date' => 'required|date',
            'category' => 'required|in:fruit,vegetable,dairy,meat,grain,canned_food,beverage,baked_goods,seafood',
            'status' => 'required|in:available,expired,donated',
            'storage_conditions' => 'nullable|in:refrigerated,frozen,ambient,dry,humidity_controlled,vacuum_sealed,cool_dark_place',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $food = Food::findOrFail($id);
        $food->restaurants()->sync($request->restaurant_id);
        $food->update($request->all());

        return redirect()->route('foods.index')->with('success', 'Food item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->route('foods.index')->with('success', 'Food item deleted successfully.');
    }

    /**
     * Archive the specified food item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
