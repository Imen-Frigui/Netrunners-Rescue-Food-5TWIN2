<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="restaurants"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Restaurant"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <h1>Edit Restaurant</h1>
            
            <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card p-3 mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons">restaurant_menu</i>
                                </span>
                                <input type="text" name="name" id="name" class="form-control" 
                                       value="{{ old('name', $restaurant->name) }}" 
                                       placeholder="Enter restaurant name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons">location_on</i>
                                </span>
                                <input type="text" name="address" id="address" class="form-control" 
                                       value="{{ old('address', $restaurant->address) }}" 
                                       placeholder="Enter restaurant address" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons">phone</i>
                                </span>
                                <input type="text" name="phone" id="phone" class="form-control" 
                                       value="{{ old('phone', $restaurant->phone) }}" 
                                       placeholder="Enter phone number" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Restaurant</button>
                        <a href="{{ route('restaurants') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
