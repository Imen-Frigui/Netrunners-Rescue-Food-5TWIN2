<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='sponsors'></x-navbars.sidebar>
    @section('styles')
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @endsection
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Sponsors Dashboard"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Sponsors
                    <a href="{{ route('sponsors.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> New Sponsor</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success text-white">{{ session('success') }}</div>
                    @endif

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('sponsors.index') }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search sponsors by name, email, or company" value="{{ old('search', $query) }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </form>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Total Sponsorship</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sponsors as $sponsor)
                                <tr style="border-bottom: 1px solid #dee2e6;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sponsor->name }}</td>
                                    <td>{{ $sponsor->email }}</td>
                                    <td>{{ $sponsor->phone }}</td>
                                    <td>{{ $sponsor->company }}</td>
                                    <td>${{ number_format($sponsor->total_sponsorship_amount, 2) }}</td>
                                    <td>
                                        <a href="{{ route('sponsors.edit', $sponsor->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                        <a href="{{ route('sponsors.invoice', $sponsor->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-download"></i> Invoice
                                        </a>
                                        <a href="{{ route('sponsors.report', $sponsor->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-chart-bar"></i> View Report
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sponsors->links() }}
                </div>
            </div>
        </div>
    </main>
</x-layout>
