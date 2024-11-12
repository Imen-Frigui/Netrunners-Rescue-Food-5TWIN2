<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='sponsors'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-primary"><i class="fa fa-file-text"></i> Sponsor Report for {{ $sponsor->name }}</h3>
                </div>
                <div class="card-body">
                    <!-- Include Sponsor Details Section -->
                    @include('dashboard.sponsors.reports.sponsor_details', ['sponsor' => $sponsor, 'events' => $events])

                    <!-- Include Engagement Report Section -->
                    @include('dashboard.sponsors.reports.engagement_report', ['sponsor' => $sponsor, 'totalScans' => $totalScans, 'scansPerEvent' => $scansPerEvent])
                </div>
            </div>
        </div>
    </main>
</x-layout>
