<title>@yield('title', 'Rscue Food') - Edit Event</title>
<x-layout bodyClass="g-sidenav-show bg-gray-200">

    @section('styles')
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @endsection
    
    <x-navbars.sidebar activePage='events'></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Events Dashboard"></x-navbars.navs.auth>
        <div class="container-xl">

            <form method="POST" action="{{ route('events.update', $event->id) }}" novalidate class="form-horizontal form-create needs-validation">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->

                <div class="row">
                    <!-- Left Column: Event Information -->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-edit"></i> Edit Event</div>
                            <div class="card-body">
                                <!-- Event Name -->
                                <div class="form-group row align-items-center">
                                    <label for="name" class="col-form-label text-md-right col-md-3">Name</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="text" id="name" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', $event->name) }}">
                                        <div class="invalid-feedback">
                                            @if($errors->has('name'))
                                                {{ $errors->first('name') }}
                                            @else
                                                Name is required
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Description -->
                                <div class="form-group row align-items-center">
                                    <label for="description" class="col-form-label text-md-right col-md-3">Description</label>
                                    <div class="col-md-9 col-xl-8">
                                        <textarea id="description" name="description" placeholder="Event Description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $event->description) }}</textarea>
                                        <div class="invalid-feedback">
                                            @if($errors->has('description'))
                                                {{ $errors->first('description') }}
                                            @else
                                                Description is required
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Location -->
                                <div class="form-group row align-items-center">
                                    <label for="location" class="col-form-label text-md-right col-md-3">Location</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="text" id="location" name="location" placeholder="Event Location" class="form-control @error('location') is-invalid @enderror" required value="{{ old('location', $event->location) }}">
                                        <div class="invalid-feedback">
                                            @if($errors->has('location'))
                                                {{ $errors->first('location') }}
                                            @else
                                                Location is required
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Date -->
                                <div class="form-group row align-items-center">
                                    <label for="event_date" class="col-form-label text-md-right col-md-3">Event Date</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="datetime-local" id="event_date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" required value="{{ old('event_date', $event->event_date) }}">
                                        <div class="invalid-feedback">
                                            @if($errors->has('event_date'))
                                                {{ $errors->first('event_date') }}
                                            @else
                                                Event date is required
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Max Participants -->
                                <div class="form-group row align-items-center">
                                    <label for="max_participants" class="col-form-label text-md-right col-md-3">Max Participants</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="number" id="max_participants" name="max_participants" placeholder="Max Participants" class="form-control @error('max_participants') is-invalid @enderror" required value="{{ old('max_participants', $event->max_participants) }}">
                                        <div class="invalid-feedback">
                                            @if($errors->has('max_participants'))
                                                {{ $errors->first('max_participants') }}
                                            @else
                                                Maximum participants is required
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Restaurant -->
                                <div class="form-group row align-items-center">
                                    <label for="restaurant" class="col-form-label text-md-right col-md-3">Restaurant</label>
                                    <div class="col-md-9 col-xl-8">
                                        <select id="restaurant" name="restaurant_id" class="form-control @error('restaurant_id') is-invalid @enderror" required>
                                            @foreach($restaurants as $restaurant)
                                                <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $event->restaurant_id) == $restaurant->id ? 'selected' : '' }}>
                                                    {{ $restaurant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @if($errors->has('restaurant_id'))
                                                {{ $errors->first('restaurant_id') }}
                                            @else
                                                Please select a restaurant
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Charity -->
                                <div class="form-group row align-items-center">
                                    <label for="charity" class="col-form-label text-md-right col-md-3">Charity</label>
                                    <div class="col-md-9 col-xl-8">
                                        <select id="charity" name="charity_id" class="form-control @error('charity_id') is-invalid @enderror" required>
                                            @foreach($charities as $charity)
                                                <option value="{{ $charity->id }}" {{ old('charity_id', $event->charity_id) == $charity->id ? 'selected' : '' }}>
                                                    {{ $charity->charity_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @if($errors->has('charity_id'))
                                                {{ $errors->first('charity_id') }}
                                            @else
                                                Please select a charity
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Publish Details -->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-check"></i> Publish</div>
                            <div class="card-body">
                                <!-- Published At -->
                                <div class="form-group row align-items-center">
                                    <label for="published_at" class="col-form-label text-md-right col-md-4">Published at</label>
                                    <div class="col-md-8 col-xl-7">
                                        <input type="datetime-local" id="published_at" name="published_at" class="form-control" value="{{ old('published_at', $event->published_at ? $event->published_at->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                </div>

                                <!-- Enable Event -->
                                <div class="form-check row">
                                    <div class="ml-md-auto col-md-10">
                                        <input id="enabled" type="checkbox" name="enabled" class="form-check-input" {{ old('enabled', $event->enabled) ? 'checked' : '' }}>
                                        <label for="enabled" class="form-check-label">Enable Event</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <button type="submit" class="btn btn-primary fixed-cta-button button-save btn-md"><i class="fa fa-save"></i><span style="font-size: 80%">Update</span></button>
            </form>
        </div>
    </main>
</x-layout>
