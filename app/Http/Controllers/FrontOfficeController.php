<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Restaurant;
use App\Models\Food;
use App\Models\Pickup;
use App\Models\Charity;
use Illuminate\Http\Request;

class FrontOfficeController extends Controller
{
    // Main layout view with various sections (events, restaurants, foods, pickups)
    public function index()
    {
        $events = Event::all(); // Fetch all events
        $restaurants = Restaurant::all(); // Fetch all restaurants
        $foods = Food::all(); // Fetch all foods
        $charities = Charity::all(); // Fetch all charities
        return view('front-office.index', compact('events', 'restaurants', 'foods', 'charities'));
    }

    // Display the specific event's details
    // public function showEvent(Event $event)
    // {
    //     return view('front-office.events.show', compact('event'));
    // }
    // public function EventsList(Event $event)
    // {
    //     $events = Event::all(); // Fetch all events
    //     return view('front-office.events.index', compact('events'));
    // }


    public function createProfile()
    {
        return view('front-office.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $attributes = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'required|max:150',
            'location' => 'required'
        ]);

        $user->update($attributes);

        return back()->withStatus('Profile successfully updated.');
    }
    
    public function aboutUs()
    {
        return view('front-office.about');
    }

    // Add other show methods for restaurants, foods, pickups as needed
}
