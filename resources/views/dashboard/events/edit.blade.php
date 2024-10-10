<title>@yield('title', 'Rscue Food') - Edit Event</title>
@extends('admin.layout.default')

@include('admin.layout.sidebar')
@section('content')
    <div class="container-xl">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('events.update', $event->id) }}" novalidate class="form-horizontal form-create">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->
            <div class="row">
                <!-- Left Column: Event Information -->
                <div class="col">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-edit"></i> Edit Event</div>
                        <div class="card-body">
                            <!-- Event Name -->
                            <div class="form-group row align-items-center">
                                <label for="name" class="col-form-label text-md-right col-md-2">Name</label>
                                <div class="col-md-9 col-xl-8">
                                    <input type="text" id="name" name="name" placeholder="Name" class="form-control" required value="{{ old('name', $event->name) }}">
                                </div>
                            </div>

                            <!-- Event Description -->
                            <div class="form-group row align-items-center">
                                <label for="description" class="col-form-label text-md-right col-md-2">Description</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea id="description" name="description" placeholder="Event Description" class="form-control" rows="5" required>{{ old('description', $event->description) }}</textarea>
                                </div>
                            </div>

                            <!-- Event Location -->
                            <div class="form-group row align-items-center">
                                <label for="location" class="col-form-label text-md-right col-md-2">Location</label>
                                <div class="col-md-9 col-xl-8">
                                    <input type="text" id="location" name="location" placeholder="Event Location" class="form-control" required value="{{ old('location', $event->location) }}">
                                </div>
                            </div>

                            <!-- Event Date -->
                            <div class="form-group row align-items-center">
                                <label for="event_date" class="col-form-label text-md-right col-md-2">Event Date</label>
                                <div class="col-md-9 col-xl-8">
                                    <input type="datetime-local" id="event_date" name="event_date" class="form-control" required value="{{ old('event_date', $event->event_date) }}">
                                </div>
                            </div>

                            <!-- Max Participants -->
                            <div class="form-group row align-items-center">
                                <label for="max_participants" class="col-form-label text-md-right col-md-2">Max Participants</label>
                                <div class="col-md-9 col-xl-8">
                                    <input type="number" id="max_participants" name="max_participants" placeholder="Max Participants" class="form-control" required value="{{ old('max_participants', $event->max_participants) }}">
                                </div>
                            </div>

                            <!-- Restaurant -->
                            <div class="form-group row align-items-center">
                                <label for="restaurant" class="col-form-label text-md-right col-md-2">Restaurant</label>
                                <div class="col-md-9 col-xl-8">
                                    <select id="restaurant" name="restaurant_id" class="form-control" required>
                                        <option value="" disabled>Select a Restaurant</option>
                                        @foreach($restaurants as $restaurant)
                                            <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $event->restaurant_id) == $restaurant->id ? 'selected' : '' }}>
                                                {{ $restaurant->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Charity -->
                            <div class="form-group row align-items-center">
                                <label for="charity" class="col-form-label text-md-right col-md-2">Charity</label>
                                <div class="col-md-9 col-xl-8">
                                    <select id="charity" name="charity_id" class="form-control" required>
                                        <option value="" disabled>Select a Charity</option>
                                        @foreach($charities as $charity)
                                            <option value="{{ $charity->id }}" {{ old('charity_id', $event->charity_id) == $charity->id ? 'selected' : '' }}>
                                                {{ $charity->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Publish Details -->
                <div class="col-md-12 col-lg-12 col-xl-5 col-xxl-4">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-check"></i> Publish</div>
                        <div class="card-body">
                            <!-- Published At -->
                            <div class="form-group row align-items-center">
                                <label for="published_at" class="col-form-label text-md-right col-md-4">Published at</label>
                                <div class="col-md-9 col-xl-8">
                                    <input type="datetime-local" id="published_at" name="published_at" class="form-control" value="{{ old('published_at', $event->published_at) }}">
                                </div>
                            </div>

                            <!-- Enable Event -->
                            <div class="form-check row">
                                <div class="ml-md-auto col-md-10">
                                    <input id="enabled" type="checkbox" name="enabled" class="form-check-input" {{ $event->enabled ? 'checked' : '' }}>
                                    <label for="enabled" class="form-check-label">Enable Event</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <button type="submit" class="btn btn-primary fixed-cta-button button-save"><i class="fa fa-save"></i> Update</button>
        </form>
    </div>
@endsection

@section('footer')
    @include('admin.partials.footer')
@endsection

@section('bottom-scripts')
    @parent
@endsection
