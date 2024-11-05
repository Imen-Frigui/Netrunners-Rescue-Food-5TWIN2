<title>@yield('title', 'Rscue Food') - Create Sponsor</title>
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    @section('styles')
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @endsection
    <x-navbars.sidebar activePage='sponsors'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add New Sponsor"></x-navbars.navs.auth>
        <div class="container">
            <form action="{{ route('sponsors.store') }}" method="POST" class="form-horizontal form-create needs-validation" novalidate>
                @csrf
                <div class="row align-item-center">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-plus"></i> New Sponsor</div>
                            <div class="card-body">
                                <!-- Sponsor Name -->
                                <div class="form-group row align-items-center">
                                    <label for="name" class="col-form-label text-md-right col-md-3">Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Sponsor Email -->
                                <div class="form-group row align-items-center">
                                    <label for="email" class="col-form-label text-md-right col-md-3">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Sponsor Phone -->
                                <div class="form-group row align-items-center">
                                    <label for="phone" class="col-form-label text-md-right col-md-3">Phone</label>
                                    <div class="col-md-8">
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Sponsor Company -->
                                <div class="form-group row align-items-center">
                                    <label for="company" class="col-form-label text-md-right col-md-3">Company</label>
                                    <div class="col-md-8">
                                        <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}">
                                        @error('company')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Sponsor</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    @section('scripts')
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    @endsection    
</x-layout>
