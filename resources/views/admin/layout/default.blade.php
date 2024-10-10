@extends('admin.layout.master')
@section('styles')
{{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> --}}
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endsection
@section('content')
    @include('admin.partials.header')

    <div class="app-body">

        <main class="main">

            <div class="container-fluid" id="app" :class="{'loading': loading}">
                <div class="modals">
                    <v-dialog/>
                </div>
                <div>
                    <notifications position="bottom right" :duration="2000" />
                </div>

                @yield('body')
            </div>
        </main>
    </div>
@endsection

@section('footer')
    @include('admin.partials.footer')
@endsection

@section('bottom-scripts')
    @parent
@endsection