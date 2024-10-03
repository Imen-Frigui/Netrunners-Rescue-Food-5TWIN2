@extends('admin.layout.master')
@yield('styles')
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