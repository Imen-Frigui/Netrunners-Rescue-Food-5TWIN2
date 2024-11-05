<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="inventories"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Inventories"></x-navbars.navs.auth>

        <div class="container">
            <h1>Add New Inventory Item</h1>

            <form action="{{ route('inventories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="food_id">Food</label>
                    <select name="food_id" id="food_id" class="form-control" required>
                        @foreach($foods as $food)
                            <option value="{{ $food->id }}">{{ $food->food_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="restaurant_id">Restaurant</label>
                    <select name="restaurant_id" id="restaurant_id" class="form-control" required>
                        @foreach($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity_on_hand">Quantity on Hand</label>
                    <input type="number" name="quantity_on_hand" id="quantity_on_hand" class="form-control" required min="0">
                </div>

                <div class="form-group">
                    <label for="minimum_quantity">Minimum Quantity</label>
                    <input type="number" name="minimum_quantity" id="minimum_quantity" class="form-control" required min="0">
                </div>

                <div class="form-group">
                    <label for="storage_location">Storage Location</label>
                    <input type="text" name="storage_location" id="storage_location" class="form-control" maxlength="255">
                </div>

                <button type="submit" class="btn btn-primary">Add Inventory Item</button>
            </form>
        </div>
    </main>
</x-layout>
