<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="beneficiaries-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Beneficiary"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Edit Beneficiary</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <form action="{{ route('beneficiaries.update', $beneficiary->id) }}" method="POST" novalidate>
                                @csrf
                                @method('PUT')
                                @include('beneficiaries.partials._form')

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Update Beneficiary</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
