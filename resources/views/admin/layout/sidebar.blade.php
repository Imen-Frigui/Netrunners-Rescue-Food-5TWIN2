@yield('additional-styles')
@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endsection
@section('sidebar')
<div class="sidebar">
    <nav class="sidebar-nav ps">
        <ul class="nav">
            <li class="nav-title">Contenido</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events.index') }}">
                    <i class="nav-icon icon-calendar"></i> Manage Events
                </a>
            </li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/articles"><i class="nav-icon icon-plane"></i>#1: Standard</a></li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/posts"><i class="nav-icon icon-globe"></i> #2: With media</a></li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/translatable-articles"><i class="nav-icon icon-ghost"></i> #3: Translatable</a></li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/exports"><i class="nav-icon icon-drop"></i> #4: With export</a></li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/articles-with-relationships"><i class="nav-icon icon-graduation"></i> #5: With relationship</a></li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/bulk-actions"><i class="nav-icon icon-book-open"></i> #6: Bulk Actions</a></li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/tags"><i class="nav-icon icon-tag"></i> #7: Tags</a></li>
           

            <li class="nav-title">Settings</li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/admin-users"><i class="nav-icon icon-user"></i> Manage access</a></li>
            <li class="nav-item"><a class="nav-link" href="https://demo.getcraftable.com/admin/translations"><i class="nav-icon icon-location-pin"></i> Translations</a></li>
            
            
        </ul>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
@endsection 