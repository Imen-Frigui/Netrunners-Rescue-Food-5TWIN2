<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reports"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Reports"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">All Reports</h6>
                            </div>
                             <!-- Back Button -->
         <a href="{{ route('charities') }}" class="btn bg-gradient-dark mt-4">Back to Charities</a>
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




<div class="container-fluid py-4">
 

    <form action="{{ route('reports.index') }}" method="GET" class="mb-4">

<div class="searchBox">

            <input class="searchInput" type="text" name="search" placeholder="Search something" value="{{ old('search', $searchTerm) }}">
            <button class="searchButton" type="submit" >
                   
                  

                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
  <g clip-path="url(#clip0_2_17)">
    <g filter="url(#filter0_d_2_17)">
      <path d="M23.7953 23.9182L19.0585 19.1814M19.0585 19.1814C19.8188 18.4211 20.4219 17.5185 20.8333 16.5251C21.2448 15.5318 21.4566 14.4671 21.4566 13.3919C21.4566 12.3167 21.2448 11.252 20.8333 10.2587C20.4219 9.2653 19.8188 8.36271 19.0585 7.60242C18.2982 6.84214 17.3956 6.23905 16.4022 5.82759C15.4089 5.41612 14.3442 5.20435 13.269 5.20435C12.1938 5.20435 11.1291 5.41612 10.1358 5.82759C9.1424 6.23905 8.23981 6.84214 7.47953 7.60242C5.94407 9.13789 5.08145 11.2204 5.08145 13.3919C5.08145 15.5634 5.94407 17.6459 7.47953 19.1814C9.01499 20.7168 11.0975 21.5794 13.269 21.5794C15.4405 21.5794 17.523 20.7168 19.0585 19.1814Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" shape-rendering="crispEdges"></path>
    </g>
  </g>
  <defs>
    <filter id="filter0_d_2_17" x="-0.418549" y="3.70435" width="29.7139" height="29.7139" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
      <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
      <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
      <feOffset dy="4"></feOffset>
      <feGaussianBlur stdDeviation="2"></feGaussianBlur>
      <feComposite in2="hardAlpha" operator="out"></feComposite>
      <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
      <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_17"></feBlend>
      <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_17" result="shape"></feBlend>
    </filter>
    <clipPath id="clip0_2_17">
      <rect width="28.0702" height="28.0702" fill="white" transform="translate(0.403503 0.526367)"></rect>
    </clipPath>
  </defs>
</svg>
                     

            </button>
        </div>

        </form>
        




    <div class="row">
        @foreach($reports as $report)
            <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                <div class="">
                    <a class="card1" href="{{ route('reports.show', $report->id) }}">
                        <div class="card-body d-flex align-items-center">
                            <div class="ms-2">
                                <p class="h6 mb-1">{{ \Illuminate\Support\Str::limit($report->charity->charity_name, 20, '...') }}</p>
                                <p class="small">{{ ucfirst($report->report_type) }}</p>
                            </div>
                        </div>
                        <div class="go-corner">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

   <!-- Pagination Links -->
  
   <div class="d-flex justify-content-center ">
    <!-- Previous Page Link -->
    @if ($reports->onFirstPage())
        <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <button class="btn btn-light" disabled>Previous</button>
        </span>
    @else
        <a href="{{ $reports->previousPageUrl() }}" rel="prev" class="btn btn-light">Previous</a>
    @endif

    <!-- Page Number Links -->
    @for ($i = 1; $i <= $reports->lastPage(); $i++)
        @if ($i == $reports->currentPage())
            <span class="current btn btn-primary mx-1">{{ $i }}</span> <!-- Current page style -->
        @else
            <a href="{{ $reports->url($i) }}" class="btn btn-light mx-1">{{ $i }}</a>
        @endif
    @endfor

    <!-- Ellipsis for pages in the middle -->
    @if ($reports->currentPage() < $reports->lastPage() - 1)
        <span class="disabled mx-1">...</span>
        <a href="{{ $reports->url($reports->lastPage()) }}" class="btn btn-light mx-1">{{ $reports->lastPage() }}</a>
    @endif

    <!-- Next Page Link -->
    @if ($reports->hasMorePages())
        <a href="{{ $reports->nextPageUrl() }}" rel="next" class="btn btn-light">Next</a>
    @else
        <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <button class="btn btn-light" disabled>Next</button>
        </span>
    @endif
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

.current {
    background-color: #66BB6A; /* Primary color */
    color: white; /* Text color */
    border: 1px solid #66BB6A; /* Border matching the button */
}

.btn-light {
    color: #66BB6A;
    background-color: white;
    border: 1px solid #66BB6A;
}

.btn-light:hover {
    background-image: linear-gradient(195deg, #66BB6A 0%, #43A047 100%);;
    color: white;
}







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
/* From Uiverse.io by Prince4fff */ 





.card p {
 
  
  line-height: 20px;
  color: #666;
}

.card p.small {
  font-size: 14px;
}

.go-corner {
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  width: 32px;
  height: 32px;
  overflow: hidden;
  top: 0;
  right: 0;
  background-color: red;
  border-radius: 0 4px 0 32px;
}

.go-arrow {
  margin-top: -4px;
  margin-right: -4px;
  color: white;
  font-family: courier, sans;
}

.card1 {
  display: block;
  position: relative;
  max-width: 262px;
  background-color: #f2f8f9;
  border-radius: 4px;
  padding: 3px 3px;
  margin: 12px;
  text-decoration: none;
  z-index: 0;
  overflow: hidden;
}

.card1:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: -16px;
  right: -16px;
  background: red;
  height: 32px;
  width: 32px;
  border-radius: 32px;
  transform: scale(1);
  transform-origin: 50% 50%;
  transition: transform 0.25s ease-out;
}

.card1:hover:before {
  transform: scale(21);
}

.card1:hover p {
  transition: all 0.3s ease-out;
  color: rgba(255, 255, 255, 0.9);
}

.card1:hover h3 {
  transition: all 0.3s ease-out;
  color: #fff;
}

.card2 {
  display: block;
  top: 0px;
  position: relative;
  max-width: 262px;
  background-color: #f2f8f9;
  border-radius: 4px;
  padding: 32px 24px;
  margin: 12px;
  text-decoration: none;
  z-index: 0;
  overflow: hidden;
  border: 1px solid #f2f8f9;
}

.card2:hover {
  transition: all 0.2s ease-out;
  box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
  top: -4px;
  border: 1px solid #ccc;
  background-color: white;
}

.card2:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: -16px;
  right: -16px;
  background: #00838d;
  height: 32px;
  width: 32px;
  border-radius: 32px;
  transform: scale(2);
  transform-origin: 50% 50%;
  transition: transform 0.15s ease-out;
}

.card2:hover:before {
  transform: scale(2.15);
}

.card3 {
  display: block;
  top: 0px;
  position: relative;
  max-width: 262px;
  background-color: #f2f8f9;
  border-radius: 4px;
  padding: 32px 24px;
  margin: 12px;
  text-decoration: none;
  overflow: hidden;
  border: 1px solid #f2f8f9;
}

.card3 .go-corner {
  opacity: 0.7;
}

.card3:hover {
  border: 1px solid #00838d;
  box-shadow: 0px 0px 999px 999px rgba(255, 255, 255, 0.5);
  z-index: 500;
}

.card3:hover p {
  color: #00838d;
}

.card3:hover .go-corner {
  transition: opactiy 0.3s linear;
  opacity: 1;
}

.card4 {
  display: block;
  top: 0px;
  position: relative;
  max-width: 262px;
  background-color: #fff;
  border-radius: 4px;
  padding: 32px 24px;
  margin: 12px;
  text-decoration: none;
  overflow: hidden;
  border: 1px solid #ccc;
}

.card4 .go-corner {
  background-color: #00838d;
  height: 100%;
  width: 16px;
  padding-right: 9px;
  border-radius: 0;
  transform: skew(6deg);
  margin-right: -36px;
  align-items: start;
  background-image: linear-gradient(-45deg, #8f479a 1%, #dc2a74 100%);
}

.card4 .go-arrow {
  transform: skew(-6deg);
  margin-left: -2px;
  margin-top: 9px;
  opacity: 0;
}

.card4:hover {
  border: 1px solid #cd3d73;
}

.card4 h3 {
  margin-top: 8px;
}

.card4:hover .go-corner {
  margin-right: -12px;
}

.card4:hover .go-arrow {
  opacity: 1;
}
/* From Uiverse.io by OnlyCodeChannel */ 
.searchBox {
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  background: white;
  border-radius: 50px;
  position: relative;
  border: 2;
  box-shadow: rgba(0, 0, 0, 0.1) 0 10px 20px;

}

.searchButton {
  color: white;
  position: absolute;
  right: 8px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: #66BB6A;
  border: 0;
  display: inline-block;
  transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
}
/*hover effect*/
button:hover {
  color: #fff;
  background-color: #1A1A1A;
  box-shadow: rgba(0, 0, 0, 0.5) 0 10px 20px;
  transform: translateY(-3px);
}
/*button pressing effect*/
button:active {
  box-shadow: none;
  transform: translateY(0);
}

.searchInput {
  border: none;
  background: none;
  outline: none;
  color: gray;
  font-size: 15px;
  padding: 24px 46px 24px 26px;
  width: 100%;
}




</style>
