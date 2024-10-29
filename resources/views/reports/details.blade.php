<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reports"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Report Details"></x-navbars.navs.auth>
        <!-- End Navbar -->
        
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $report->charity->charity_name }} Report Details</h6>
                    </div>
                </div>
                
                <div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">Report Information</h6>
    </div>
    <div class="card-body pt-4 p-3">
        <ul class="list-group">
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                    <!-- Dynamic content starts here -->
                    <h6 class="mb-3 text-sm">{{ $report->charity->charity_name}}</h6>
                    <span class="mb-2 text-xs">Report Type: <span class="text-dark font-weight-bold ms-sm-2">{{ ucfirst($report->report_type) }}</span></span>
                    <span class="mb-2 text-xs">Report Details: <span class="text-dark font-weight-bold ms-sm-2">{{ ucfirst($report->content) }}</span></span>
                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">{{ $report->charity->contact_info['email'] ?? 'N/A' }}</span></span>
                    <span class="mb-2 text-xs">Phone Number: <span class="text-dark ms-sm-2 font-weight-bold">{{ $report->charity->contact_info['phone'] ?? 'N/A' }}</span></span>
                    <span class="text-xs">Report Date: <span class="text-dark ms-sm-2 font-weight-bold">{{ $report->report_date->format('d/m/Y') }}</span></span>
                    <!-- Additional fields can be added here -->
                </div>
                <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('reports.delete', $report->id) }}" onclick="event.preventDefault(); document.getElementById('delete-report-{{ $report->id }}').submit();"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                    <form id="delete-report-{{ $report->id }}" action="{{ route('reports.delete', $report->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('reports.edit', $report->id) }}"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                </div>

            </li>
            
        </ul>
         <!-- Back Button -->
         <a href="{{ route('reports.index') }}" class="btn bg-gradient-dark">Back to Reports</a>
    </div>
</div>






              
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
