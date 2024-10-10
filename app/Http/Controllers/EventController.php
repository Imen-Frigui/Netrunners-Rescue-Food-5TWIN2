<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Restaurant;
use App\Models\Charity;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('restaurant', 'charity')->paginate(4);
        // return response()->json($events);
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        $charities = Charity::all();
        return view('dashboard.events.create', compact('restaurants', 'charities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());
        // return response()->json(['message' => 'Event created successfully', 'event' => $event]);
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event->load(['restaurant', 'charity', 'volunteers']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $restaurants = Restaurant::all();
        $charities = Charity::all();
        return view('dashboard.events.edit', compact('event','restaurants', 'charities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        // return response()->json(['message' => 'Event updated successfully', 'event' => $event]);
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        // return response()->json(['message' => 'Event deleted successfully']);
        $events = Event::with('restaurant', 'charity')->paginate(4);
        return view('dashboard.events.index', compact('events'))->render();
    }
}
