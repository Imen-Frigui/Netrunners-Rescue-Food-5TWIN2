<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Food;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Events\LowStockNotification; // Ensure this line is present

class InventoryController extends Controller
{
 
    public function index(Request $request)
    {
        $searchTerm = $request->input('search'); // Get the search term from the request
    
        if ($request->query('low_stock') == 'true') {
            $inventories = Inventory::whereColumn('quantity_on_hand', '<=', 'minimum_quantity');
        } else {
            $inventories = Inventory::query();
        }
    
        // If there is a search term, filter the inventories
        if ($searchTerm) {
            $inventories->whereHas('food', function($query) use ($searchTerm) {
                $query->where('food_name', 'like', "%{$searchTerm}%");
            })->orWhereHas('restaurant', function($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%");
            });
        }
    
        $inventories = $inventories->get(); // Get the results after filtering
    
        return view('inventories.index', compact('inventories', 'searchTerm'));
    }
    

  
    public function create()
    {
        $foods = Food::all();
        $restaurants = Restaurant::all();

        return view('inventories.create', compact('foods', 'restaurants'));
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'food_id' => 'required|exists:food,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'quantity_on_hand' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'storage_location' => 'nullable|string|max:255',
        ]);

        Inventory::create($validatedData);

        return redirect()->route('inventories.index')->with('success', 'Inventory item added successfully.');
    }

    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.show', compact('inventory'));
    }

  
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $foods = Food::all();
        $restaurants = Restaurant::all();

        return view('inventories.edit', compact('inventory', 'foods', 'restaurants'));
    }

  
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validatedData = $request->validate([
            'quantity_on_hand' => 'integer|min:0',
            'minimum_quantity' => 'integer|min:0',
            'storage_location' => 'nullable|string|max:255',
        ]);

        $validatedData['last_updated'] = now();
        $inventory->update($validatedData);

        return redirect()->route('inventories.index')->with('success', 'Inventory item updated successfully.');
    }

  
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventory item deleted successfully.');
    }

    public function lowStock()
    {
        $lowStockItems = Inventory::with(['food', 'restaurant'])
            ->whereColumn('quantity_on_hand', '<=', 'minimum_quantity')
            ->get();
        
        return response()->json($lowStockItems);
    }

 
  
    public function reorderSuggestions()
    {
        $reorderItems = Inventory::whereColumn('quantity_on_hand', '<=', 'minimum_quantity')->get();

        return view('inventories.reorder_suggestions', compact('reorderItems'));
    }

    public function indexResto(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
    
        // Get the search term from the request
        $searchTerm = $request->input('search');
    
        // Query the inventories with pagination and search
        $inventories = Inventory::where('restaurant_id', $restaurant->id)
            ->when($searchTerm, function($query) use ($searchTerm) {
                return $query->whereHas('food', function($q) use ($searchTerm) {
                    $q->where('food_name', 'like', '%' . $searchTerm . '%');
                });
            })
            ->paginate(10); // Adjust the number for items per page as needed
    
        return view('inventories.indexResto', compact('inventories', 'restaurant', 'searchTerm'));
    }
    


    public function createResto(Restaurant $restaurant)
    {

        $foods = Food::all();

        return view('inventories.createResto', compact('foods', 'restaurant'));
    }


    public function storeResto(Request $request, $restaurantId)
    {
        $validatedData = $request->validate([
            'food_id' => 'required|exists:food,id', 
            'quantity_on_hand' => 'required|integer|min:0', 
            'minimum_quantity' => 'required|integer|min:0',
            'storage_location' => 'nullable|string|max:255', 
        ]);

        // If validation passes, create the inventory item
        Inventory::create([
            'food_id' => $validatedData['food_id'],
            'restaurant_id' => $restaurantId,
            'quantity_on_hand' => $validatedData['quantity_on_hand'],
            'minimum_quantity' => $validatedData['minimum_quantity'],
            'storage_location' => $validatedData['storage_location'],
        ]);


        return redirect()->route('inventories.indexResto', $restaurantId)
        ->with('success', 'Inventory item added successfully.');    }


    public function showResto(Restaurant $restaurant, $id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.showResto', compact('inventory', 'restaurant'));
    }
    public function destroyResto(Restaurant $restaurant, $inventoryId)
    {
        $inventory = Inventory::where('id', $inventoryId)
            ->where('restaurant_id', $restaurant->id)
            ->firstOrFail(); 
    
        $inventory->delete();
    
        return redirect()->route('inventories.indexResto', $restaurant->id)->with('success', 'Inventory item deleted successfully.');
    }

    public function editResto($restaurantId, $id)   
    {
        $inventory = Inventory::findOrFail($id);
        $foods = Food::all();
        $restaurant = Restaurant::findOrFail($restaurantId);
        return view('inventories.editResto', compact('inventory', 'foods', 'restaurant'));
    }
    
    public function updateResto(Request $request, Restaurant $restaurant, Inventory $inventory)
    {
        $request->validate([
            'food_id' => 'required|exists:food,id',
            'quantity_on_hand' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'storage_location' => 'nullable|string|max:255',
        ]);
    
        // Update the inventory item
        $inventory->update([
            'food_id' => $request->food_id,
            'quantity_on_hand' => $request->quantity_on_hand,
            'minimum_quantity' => $request->minimum_quantity,
            'storage_location' => $request->storage_location,
        ]);

        \Log::info('Inventory item updated.', ['inventory' => $inventory]);

        $lowStockResponse = $this->checkLowStock();
        
        // Log the response from checkLowStock
        \Log::info('Low stock check response:', ['response' => $lowStockResponse]);
        session()->flash('success', 'Inventory item updated successfully and low stock notification sent.');
        return redirect()->route('inventories.indexResto', ['restaurant' => $restaurant->id])
                         ->with('success', 'Inventory item updated successfully.');
    }
    public function checkLowStock()
    {
        $lowStockItems = Inventory::with(['food', 'restaurant'])
            ->whereColumn('quantity_on_hand', '<=', 'minimum_quantity')
            ->get();
    
        if ($lowStockItems->isNotEmpty()) {
            event(new LowStockNotification($lowStockItems));
            return response()->json([
                'status' => 'Notification sent',
                'low_stock_items' => $lowStockItems
            ]);
        }
    
        return response()->json([
            'status' => 'No low stock items found',
            'low_stock_items' => []
        ]);
    }
    

}
