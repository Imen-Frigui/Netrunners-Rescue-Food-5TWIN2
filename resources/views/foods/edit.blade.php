<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="food-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Edit Food"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Edit Food</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <form action="{{ route('foods.update', $food->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')
                                @include('foods.partials._form')

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Update Food</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                control.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        this.classList.remove('is-invalid');
                        const errorFeedback = this.nextElementSibling;
                        if (errorFeedback && errorFeedback.classList.contains('invalid-feedback')) {
                            errorFeedback.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
</x-layout>
