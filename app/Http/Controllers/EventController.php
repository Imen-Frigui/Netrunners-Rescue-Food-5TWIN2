<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Restaurant;
use App\Models\Charity;
use Illuminate\Http\Request;
use App\Models\Sponsor;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $events = Event::with('restaurant', 'charity')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->paginate(4);
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
        $sponsors = Sponsor::all();

        return view('dashboard.events.create', compact('restaurants', 'charities', 'sponsors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {

        $event = Event::create(array_merge($request->validated(), [
            'published_at' => $request->filled('published_at') ? $request->published_at : null,
            'enabled' => $request->has('enabled'),
        ]));

        if ($request->has('sponsor_ids')) {
            $event->sponsors()->attach($request->sponsor_ids);
        }

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
        return view('front-office.events.show', compact('event'));
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
        $sponsors = Sponsor::all();

        return view('dashboard.events.edit', compact('event','restaurants', 'charities', 'sponsors'));
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
        $event->update(array_merge($request->validated(), [
            'published_at' => $request->filled('published_at') ? $request->published_at : null,
            'enabled' => $request->has('enabled'),
        ]));
        $event->sponsors()->sync($request->input('sponsor_id'));
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
        $events = Event::with('restaurant', 'charity')->paginate(4);
        return view('dashboard.events.index', compact('events'))->render();
    }

    public function publish(Event $event)
    {
        $event->enabled = true;
        $event->published_at = now();
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event published successfully.');
    }

    public function all()
    {
        $events = Event::where('enabled', true)->get();
        return view('front-office.events.index', compact('events'));
    }
}
