<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="inventory-management"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add New Inventory Item"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Add New Inventory Item for {{ $restaurant->name }}</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <form action="{{ route('inventories.storeResto', $restaurant->id) }}" method="POST" novalidate>
                                @csrf

                                <div class="form-group">
                                    <label for="food_id">Select Food <i class="fas fa-utensils"></i></label>
                                    <select name="food_id" id="food_id" class="form-control border border-2 p-2 @error('food_id') is-invalid @enderror" required>
                                        <option value="">Select Food</option>
                                        @foreach($foods as $food)
                                            <option value="{{ $food->id }}" data-unit="{{ $food->unit }}" {{ old('food_id') == $food->id ? 'selected' : '' }}>
                                                {{ $food->food_name }} 
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('food_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Choose the food item for which you are adding inventory.</small>
                                </div>

                                <div class="form-group">
                                    <label for="quantity_on_hand">Quantity on Hand <i class="fas fa-box"></i></label>
                                    <input type="number" name="quantity_on_hand" id="quantity_on_hand" class="form-control border border-2 p-2 @error('quantity_on_hand') is-invalid @enderror" required min="0" value="{{ old('quantity_on_hand') }}">
                                    @error('quantity_on_hand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Enter the current stock level of this food item.</small>
                                </div>

                                <!-- Unit Display -->
                                <div class="form-group">
                                    <label>Unit <i class="fas fa-weight-hanging"></i></label>
                                    <span id="unit-display" class="form-text text-muted">Select a food item to see the unit.</span>
                                </div>

                                <div class="form-group">
                                    <label for="minimum_quantity">Minimum Quantity <i class="fas fa-exclamation-triangle"></i></label>
                                    <input  value="1" type="number" name="minimum_quantity" id="minimum_quantity" class="form-control border border-2 p-2 @error('minimum_quantity') is-invalid @enderror" required min="0" value="{{ old('minimum_quantity') }}">
                                    @error('minimum_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Define the minimum stock level before restocking is required.</small>
                                </div>

                                <div class="form-group">
                                    <label for="storage_location">Storage Location <i class="fas fa-map-marker-alt"></i></label>
                                    <input type="text" name="storage_location" id="storage_location" class="form-control border border-2 p-2 @error('storage_location') is-invalid @enderror" maxlength="255" value="{{ old('storage_location') }}">
                                    @error('storage_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Specify where the inventory is stored (e.g., fridge, pantry).</small>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Inventory Item</button>
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
            const foodSelect = document.getElementById('food_id');
            const unitDisplay = document.getElementById('unit-display');

            foodSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const unit = selectedOption.getAttribute('data-unit');

                if (unit) {
                    unitDisplay.textContent = `Unit: ${unit}`;
                } else {
                    unitDisplay.textContent = 'Select a food item to see the unit.';
                }
            });
        });
    </script>
</x-layout>
