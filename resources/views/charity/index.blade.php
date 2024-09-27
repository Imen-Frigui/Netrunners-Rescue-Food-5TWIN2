<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Charities</h6>
                            </div>
                        </div>
                        



  <!-- Place this where you want the success message to appear -->
  @if(session('success'))
                            <div class="success mt-n0 mx-3 z-index-2" id="success-message">
                                <div class="success__icon">
                                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd" d="m12 1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm4.768 9.14c.0878-.1004.1546-.21726.1966-.34383.0419-.12657.0581-.26026.0477-.39319-.0105-.13293-.0475-.26242-.1087-.38085-.0613-.11844-.1456-.22342-.2481-.30879-.1024-.08536-.2209-.14938-.3484-.18828s-.2616-.0519-.3942-.03823c-.1327.01366-.2612.05372-.3782.1178-.1169.06409-.2198.15091-.3027.25537l-4.3 5.159-2.225-2.226c-.1886-.1822-.4412-.283-.7034-.2807s-.51301.1075-.69842.2929-.29058.4362-.29285.6984c-.00228.2622.09851.5148.28067.7034l3 3c.0983.0982.2159.1748.3454.2251.1295.0502.2681.0729.4069.0665.1387-.0063.2747-.0414.3991-.1032.1244-.0617.2347-.1487.3236-.2554z" fill="#393a37" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="success__title">{{ session('success') }}</div> 
                                <div class="success__close" onclick="this.parentElement.style.display='none'">
                                    <svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var successMessage = document.getElementById('success-message');
                                if (successMessage) {
                                    // Show the message and hide it after 3 seconds
                                    setTimeout(function() {
                                        successMessage.style.display = 'none';
                                    }, 3000);
                                }
                            });
                        </script>

                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('charities.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                Charity</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Charity Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Beneficiaries</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Donation</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($charities as $charity)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $charity->charity_name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $charity->contact_info['email'] ?? '' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ ucfirst($charity->charity_type) }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-info">{{ $charity->beneficiaries_count }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">        {{ $charity->last_received_donation ? $charity->last_received_donation->format('d/m/Y') : 'N/A' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-info btn-link" href="{{ route('charities.details', $charity->id) }}" title="View Details">
        Details
        <div class="ripple-container"></div>
    </a>
   
                                                <a href="{{ route('charities.edit', $charity->id) }}" rel="tooltip" class="btn btn-warning btn-link"
                                                    href="" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
     <form action="{{ route('charities.destroy', $charity->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger btn-link" onclick="confirmDelete(event, this)">
        <i class="material-icons">close</i>
        <div class="ripple-container"></div>
    </button>
</form>
<script>
    function confirmDelete(event, element) {
        event.preventDefault(); // Prevent the form from submitting immediately
        if (confirm('Are you sure you want to delete this charity?')) {
            // If confirmed, submit the form
            element.closest('form').submit();
        }
    }
</script>
                                            
                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
<style>
 .success {
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  width: 100%;
  padding: 12px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  background: #EDFBD8;
  border-radius: 8px;
  box-shadow: 0px 0px 5px -3px #111;
}

.success__icon {
  width: 20px;
  height: 20px;
  transform: translateY(-2px);
  margin-right: 8px;
}

.success__icon path {
  fill: #84D65A;
}

.success__title {
  font-weight: 500;
  font-size: 14px;
  color: #2B641E;
}

.success__close {
  width: 20px;
  height: 20px;
  cursor: pointer;
  margin-left: auto;
}

.success__close path {
  fill: #2B641E;
}
</style>
