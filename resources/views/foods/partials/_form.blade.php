<div class="d-flex justify-content-center">
    <div class="w-50">
        <!-- Food Name Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Food Name</label>
            <input type="text" class="form-control @error('food_name') is-invalid @enderror" name="food_name" value="{{ old('food_name', $food->food_name ?? '') }}" required>
            @error('food_name')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Quantity Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Quantity</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity', $food->quantity ?? '') }}" required>
            @error('quantity')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Unit Input -->
        <div class="input-group input-group-outline mt-3">
            <!-- <label class="form-label">Unit</label> -->
            <select name="unit" class="form-control @error('unit') is-invalid @enderror" required>
                <option value="">Select Unit</option>
                <option value="kg" {{ old('unit', $food->unit ?? '') == 'kg' ? 'selected' : '' }}>Kilograms</option>
                <option value="liters" {{ old('unit', $food->unit ?? '') == 'liters' ? 'selected' : '' }}>Liters</option>
                <option value="pieces" {{ old('unit', $food->unit ?? '') == 'pieces' ? 'selected' : '' }}>Pieces</option>
            </select>
            @error('unit')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Expiration Date Input -->
        <div class="mb-3">
    <label for="expiration_date" class="form-label">Expiration Date</label>
    <input type="date" 
           class="form-control border border-2 p-2 @error('expiration_date') is-invalid @enderror" 
           id="expiration_date" 
           name="expiration_date" 
           value="{{ old('expiration_date', $food->expiration_date ?? '') }}" 
           required>
    @error('expiration_date')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

        <!-- Category Input -->
        <div class="input-group input-group-outline mt-3">
            <!-- <label class="form-label">Category</label> -->
            <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                <option value="">Select Category</option>
                <option value="fruit" {{ old('category', $food->category ?? '') == 'fruit' ? 'selected' : '' }}>Fruit</option>
                <option value="vegetable" {{ old('category', $food->category ?? '') == 'vegetable' ? 'selected' : '' }}>Vegetable</option>
                <option value="dairy" {{ old('category', $food->category ?? '') == 'dairy' ? 'selected' : '' }}>Dairy</option>
                <option value="meat" {{ old('category', $food->category ?? '') == 'meat' ? 'selected' : '' }}>Meat</option>
                <option value="grain" {{ old('category', $food->category ?? '') == 'grain' ? 'selected' : '' }}>Grain</option>
                <option value="canned_food" {{ old('category', $food->category ?? '') == 'canned_food' ? 'selected' : '' }}>Canned Food</option>
                <option value="beverage" {{ old('category', $food->category ?? '') == 'beverage' ? 'selected' : '' }}>Beverage</option>
                <option value="baked_goods" {{ old('category', $food->category ?? '') == 'baked_goods' ? 'selected' : '' }}>Baked Goods</option>
                <option value="seafood" {{ old('category', $food->category ?? '') == 'seafood' ? 'selected' : '' }}>Seafood</option>
            </select>
            @error('category')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Status Input -->
        <div class="input-group input-group-outline mt-3">
            <!-- <label class="form-label">Status</label> -->
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="available" {{ old('status', $food->status ?? '') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="expired" {{ old('status', $food->status ?? '') == 'expired' ? 'selected' : '' }}>Expired</option>
                <option value="donated" {{ old('status', $food->status ?? '') == 'donated' ? 'selected' : '' }}>Donated</option>
            </select>
            @error('status')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Storage Conditions Input -->
        <div class="input-group input-group-outline mt-3">
            <!-- <label class="form-label">Storage Conditions</label> -->
            <select name="storage_conditions" class="form-control @error('storage_conditions') is-invalid @enderror">
                <option value="">Select Storage Conditions</option>
                <option value="refrigerated" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'refrigerated' ? 'selected' : '' }}>Refrigerated</option>
                <option value="frozen" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'frozen' ? 'selected' : '' }}>Frozen</option>
                <option value="ambient" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'ambient' ? 'selected' : '' }}>Ambient</option>
                <option value="dry" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'dry' ? 'selected' : '' }}>Dry</option>
                <option value="humidity_controlled" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'humidity_controlled' ? 'selected' : '' }}>Humidity Controlled</option>
                <option value="vacuum_sealed" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'vacuum_sealed' ? 'selected' : '' }}>Vacuum Sealed</option>
                <option value="cool_dark_place" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'cool_dark_place' ? 'selected' : '' }}>Cool Dark Place</option>
            </select>
            @error('storage_conditions')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Image Input -->
        <div class="input-group input-group-outline mt-3">
            <!-- <label class="form-label">Image</label> -->
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
            @error('image')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Donation Date Input -->
        <div class="mb-3">
    <label for="donation_date" class="form-label">Donation Date</label>
    <input type="date" 
           class="form-control border border-2 p-2 @error('donation_date') is-invalid @enderror" 
           id="donation_date" 
           name="donation_date" 
           value="{{ old('donation_date', $food->donation_date ?? '') }}" 
           required>
    @error('donation_date')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
        <!-- Select Restaurants Input -->

<div class="mb-3">
    <label for="restaurant_id" class="form-label">Select Restaurant</label>
    <select
        name="restaurant_id[]"
        class="form-control border border-2 p-2 @error('restaurant_id') is-invalid @enderror"
        id="restaurant_id"
        multiple
        style="height: 150px;">
        @foreach ($restaurants as $restaurant)
        <option value="{{ $restaurant->id }}">
            {{ $restaurant->name }}
        </option>
        @endforeach
    </select>
    @error('restaurant_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
    </div>
</div>
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