<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="pickup-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add PickUp Request"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Add New PickUp Request</strong></h6>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('pickup.store') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="user_id">Customer</label>
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                               

                                <div class="form-group">
                                    <label for="pickup_time">PickUp Time</label>
                                    <input type="datetime-local" name="pickup_time" class="form-control" value="{{ old('pickup_time') }}">
                                </div>

                                <div class="form-group">
                                    <label for="pickup_address">PickUp Address</label>
                                    <input type="text" name="pickup_address" class="form-control" value="{{ old('pickup_address') }}">
                                </div>

                                

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn bg-gradient-dark mb-0">Add PickUp Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
