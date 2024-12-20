<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- TODO translatable suffix --}}
    <title>@yield('title', 'Rscue Food') - Dashboard</title>

	@include('admin.partials.main-styles')
    @yield('additional-styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>

<body class="app header-fixed sidebar-fixed sidebar-lg-show">

    @yield('header')
    <div class="app-body">
        @yield('sidebar')
        @include('admin.layout.sidebar') <!-- Sidebar inclusion here -->
        
        <main class="main">
            @yield('content') <!-- This will include the content from `index.blade.php` -->
        </main>
    </div>

    {{-- @yield('content') --}}

    @yield('footer')

    @include('admin.partials.wysiwyg-svgs')
    @include('admin.partials.main-bottom-scripts')
    @yield('bottom-scripts')
</body>

</html>