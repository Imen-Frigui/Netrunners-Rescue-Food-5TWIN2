{{-- <x-layout bodyClass="g-sidenav-show bg-gray-200"> --}}
    @extends('admin.layout.default')
    @section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">  
    @endsection
      {{-- <x-navbars.sidebar activePage='events'></x-navbars.sidebar> --}}
        <!-- Navbar -->
        {{-- <x-navbars.navs.auth titlePage="Events Dashboard"></x-navbars.navs.auth> --}}
        <!-- End Navbar -->
        @include('admin.layout.sidebar')
        @section('content')
        <div class="app-body">
            <!-- Sidebar will already be included by master layout -->
            <div class="container-fluid" id="app" :class="{'loading': loading}">
                <div class="modals">
                    <v-dialog/>
                </div>
                <div>
                    <notifications position="bottom right" :duration="2000" />
                </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i> Events
                            <a href="{{ route('events.create') }}" role="button" class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"><i
                                    class="fa fa-plus"></i>&nbsp; New Event</a>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group"><input placeholder="Search" class="form-control"> <span
                                                class="input-group-append"><button type="button"
                                                    class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;
                                                    Search</button></span></div>
                                    </div>
                                    <div class="col-sm-auto form-group"><select class="form-control">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select></div>
                                </div>
                            </form>
                            <div class="user-detail-tooltips-list col"></div>
                            <div class="table-responsive">
                                <table class="table table-hover table-listing col">
                                    <thead>
                                        <tr>
                                            <th class="bulk-checkbox"><input id="enabled" type="checkbox"
                                                    data-vv-name="enabled" name="enabled_fake_element"
                                                    class="form-check-input" aria-required="false" aria-invalid="false">
                                                <label for="enabled" class="form-check-label">
                                                    #
                                                </label></th>
                                            <th><a><span class="fa fa-sort-amount-asc"></span> ID</a></th>
                                            <th><a><span class="fa"></span> Title</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Description</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Location</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Event Date</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Max Participants</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Restaurant</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Charity</a></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($events as $event)
                                            <tr>
                                                <td class="bulk-checkbox"><input id="enabled{{ $event->id }}" type="checkbox"
                                                        data-vv-name="enabled{{ $event->id }}" name="enabled{{ $event->id }}_fake_element"
                                                        class="form-check-input" aria-required="false" aria-invalid="false">
                                                    <label for="enabled{{ $event->id }}" class="form-check-label"></label></td>
                                                <td>{{ $event->id }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($event->name, 20, '...') }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($event->description, 20, '...') }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($event->location, 20, '...') }}</td>
                                                <td>{{ $event->event_date ? $event->event_date->format('Y-m-d H:i') : 'N/A' }}</td>
                                                <td>{{ $event->max_participants }}</td>
                                                <td>{{ $event->restaurant ? $event->restaurant->name : 'No Restaurant' }}</td>
                                                <td>{{ $event->charity ? $event->charity->name : 'No Charity' }}</td>
                                                <td>
                                                    <div class="row no-gutters">
                                                        <div class="col-auto"><a href="{{ route('events.edit', $event->id) }}"
                                                                title="Edit" role="button"
                                                                class="btn btn-sm btn-spinner btn-info"><i
                                                                    class="fa fa-edit"></i></a></div>
                                                        <form class="col" method="POST" action="{{ route('events.destroy', $event->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete"
                                                                    class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash-o"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm"><span class="pagination-caption">
                                    Displaying items from 1 to {{ $events->count() }} of total {{ $events->total() }} items.</span>
                                </div>
                                <div class="col-sm-auto">
                                    {{ $events->links() }} <!-- Laravel pagination links -->
                                </div>
                            </div> <!---->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('body')
</div>
@endsection

@section('footer')
@include('admin.partials.footer')
@endsection

@section('bottom-scripts')
@parent
@endsection
{{-- </x-layout> --}}
