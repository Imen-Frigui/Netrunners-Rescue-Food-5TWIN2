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

                        <div class="confirm-div">

                        <div class="modals-container">

                         <!-- Add Mark as Solved Button -->
                         <form action="{{ route('reports.solve', $report->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="green-btn  " onclick="return confirm('Are you sure you want to mark this report as solved?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg> Mark as Solved
                                        </button>
                                    </form>
<form id="reject-report-{{ $report->id }}" action="{{ route('reports.reject', $report->id) }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="red-btn " href="{{ route('reports.reject', $report->id) }}" onclick="event.preventDefault(); document.getElementById('reject-report-{{ $report->id }}').submit();"><i class="material-icons text-sm me-2">close</i>Mark as Rejected</button>

    @method('PATCH') <!-- Or use DELETE if you prefer -->
</form>
</div>
</div>

<style>
/* From Uiverse.io by Lucaasbre */ 

.green-btn {
  background-color: #47a04b;
}

.green-btn:hover {
  background-color: #368339;
}

.green-btn:active {
  background-color: #2d6830;
}

.green-btn:disabled {
  background-color: #c8eac9;
  color: #1b7a43;
}

.red-btn {
  background-color: #f93a3a;
}

.red-btn:hover {
  background-color: #e71f1f;
}

.red-btn:active {
  background-color: #c21313;
}

.red-btn:disabled {
  background-color: #ffc7c7;
  color: #c21313;
}

.confirm-div {
  font-size: 14px;
  position: absolute;
  margin-left:130px;
  transform: translate(-50%, -50%);
  width: 300px;
  padding: 20px;
  text-align: center;
  font-family: "Segoe UI", Tahoma, sans-serif;
  cursor: default;
  margin-top:20px
}

.confirm-div button {
  cursor: pointer;
  width: 100%;
  padding: 4px 6px;
  border-radius: 4px;
  color: #fff;
  border: none;
  height: 30px;
  width: 100%;
}

.confirm-div p {
  display: flex;
  flex-direction: column;
}

.confirm-div p strong {
  margin-bottom: 15px;
}

.warning-general {
  position: absolute; /* switch to fixed */
  top: 0;
  left: 0;
  z-index: 999;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(2px);
}

.modals-container {
  display: flex;
  flex-direction: row;
  height: 32px;
  margin-top: 20px;
  gap: 7px;
  width: 100%;
}


</style>
                    </div>
                    <div class="card-body pt-4 p-3 mt-4">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{ $report->charity->charity_name}}</h6>
                                    <span class="mb-2 text-xs">Report Type: <span class="text-dark font-weight-bold ms-sm-2">{{ ucfirst($report->report_type) }}</span></span>
                                    <span class="mb-2 text-xs">Report Details: <span class="text-dark font-weight-bold ms-sm-2">{{ ucfirst($report->content) }}</span></span>
                                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">{{ $report->charity->contact_info['email'] ?? 'N/A' }}</span></span>
                                    <span class="mb-2 text-xs">Phone Number: <span class="text-dark ms-sm-2 font-weight-bold">{{ $report->charity->contact_info['phone'] ?? 'N/A' }}</span></span>
                                    <span class="text-xs">Report Date: <span class="text-dark ms-sm-2 font-weight-bold">{{ $report->report_date->format('d/m/Y') }}</span></span>
                                    <!-- Additional fields can be added here -->
                                </div>
                                <div class="ms-auto text-end">
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('reports.delete', $report->id) }}" onclick="event.preventDefault(); document.getElementById('delete-report-{{ $report->id }}').submit();">
                                        <i class="material-icons text-sm me-2">delete</i>
                                    </a>
                                    <form id="delete-report-{{ $report->id }}" action="{{ route('reports.delete', $report->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                  
                                   

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
