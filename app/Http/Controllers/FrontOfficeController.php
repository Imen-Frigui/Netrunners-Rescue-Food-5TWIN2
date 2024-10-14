<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Restaurant;
use App\Models\Food;
use App\Models\Pickup;
use Illuminate\Http\Request;

class FrontOfficeController extends Controller
{
    // Main layout view with various sections (events, restaurants, foods, pickups)
    public function index()
    {
        $events = Event::all(); // Fetch all events
        $restaurants = Restaurant::all(); // Fetch all restaurants
        $foods = Food::all(); // Fetch all foods

        return view('front-office.index', compact('events', 'restaurants', 'foods'));
    }

    // Display the specific event's details
    public function showEvent(Event $event)
    {
        return view('front-office.events.show', compact('event'));
    }
    public function EventsList(Event $event)
    {
        $events = Event::all(); // Fetch all events
        return view('front-office.events.index', compact('events'));
    }
    // Add other show methods for restaurants, foods, pickups as needed
}
