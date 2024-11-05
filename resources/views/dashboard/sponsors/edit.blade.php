<title>@yield('title', 'Rscue Food') - Edit Sponsor</title>
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='sponsors'></x-navbars.sidebar>
    @section('styles')
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @endsection
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Sponsor"></x-navbars.navs.auth>
        <div class="container-xl">
            <form action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" class="form-horizontal form-create needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row align-item-center">
                    <div class="col-md-7">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-edit"></i> Edit Sponsor</div>
                    <div class="card-body">
                        <!-- Sponsor Name -->
                        <div class="form-group row align-items-center">
                            <label for="name" class="col-form-label text-md-right col-md-3">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', $sponsor->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sponsor Email -->
                        <div class="form-group row align-items-center">
                            <label for="email" class="col-form-label text-md-right col-md-3">Email</label>
                            <div class="col-md-8">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email', $sponsor->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sponsor Phone -->
                        <div class="form-group row align-items-center">
                            <label for="phone" class="col-form-label text-md-right col-md-3">Phone</label>
                            <div class="col-md-8">
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $sponsor->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sponsor Company -->
                        <div class="form-group row align-items-center">
                            <label for="company" class="col-form-label text-md-right col-md-3">Company</label>
                            <div class="col-md-8">
                                <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', $sponsor->company) }}">
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Sponsor</button>
                        </div>
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
