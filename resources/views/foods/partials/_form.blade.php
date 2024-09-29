<!-- Form for Creating Food -->
<div class="d-flex justify-content-center">
    <div class="w-50">
        <!-- Food Name Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Food Name</label>
            <input type="text" class="form-control" name="food_name" value="{{ old('food_name', $food->food_name ?? '') }}" required>
        </div>
        @error('food_name')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Quantity Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Quantity</label>
            <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $food->quantity ?? '') }}" required>
        </div>
        @error('quantity')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Unit Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="unit" class="form-control" required>
                <option value="">Select Unit</option>
                <option value="kg" {{ old('unit', $food->unit ?? '') == 'kg' ? 'selected' : '' }}>Kilograms</option>
                <option value="liters" {{ old('unit', $food->unit ?? '') == 'liters' ? 'selected' : '' }}>Liters</option>
                <option value="pieces" {{ old('unit', $food->unit ?? '') == 'pieces' ? 'selected' : '' }}>Pieces</option>
            </select>
        </div>
        @error('unit')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Expiration Date Input -->
        <div class="input-group input-group-outline mt-3">
        <label for="expiration_date" class="form-label">Expiration Date</label>
            <input type="date" class="form-control" name="expiration_date" value="{{ old('expiration_date', $food->expiration_date ?? '') }}" required>
        </div>
        @error('expiration_date')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Category Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="category" class="form-control" required>
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
        </div>
        @error('category')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Status Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="status" class="form-control" required>
                <option value="available" {{ old('status', $food->status ?? '') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="expired" {{ old('status', $food->status ?? '') == 'expired' ? 'selected' : '' }}>Expired</option>
                <option value="donated" {{ old('status', $food->status ?? '') == 'donated' ? 'selected' : '' }}>Donated</option>
            </select>
        </div>
        @error('status')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Storage Conditions Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="storage_conditions" class="form-control">
                <option value="">Select Storage Conditions</option>
                <option value="refrigerated" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'refrigerated' ? 'selected' : '' }}>Refrigerated</option>
                <option value="frozen" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'frozen' ? 'selected' : '' }}>Frozen</option>
                <option value="ambient" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'ambient' ? 'selected' : '' }}>Ambient</option>
                <option value="dry" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'dry' ? 'selected' : '' }}>Dry</option>
                <option value="humidity_controlled" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'humidity_controlled' ? 'selected' : '' }}>Humidity Controlled</option>
                <option value="vacuum_sealed" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'vacuum_sealed' ? 'selected' : '' }}>Vacuum Sealed</option>
                <option value="cool_dark_place" {{ old('storage_conditions', $food->storage_conditions ?? '') == 'cool_dark_place' ? 'selected' : '' }}>Cool Dark Place</option>
            </select>
        </div>
        @error('storage_conditions')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Image Input -->
        <div class="input-group input-group-outline mt-3">
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>
        @error('image')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror

        <!-- Donation Date Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Donation Date</label>
            <input type="date" class="form-control" name="donation_date" value="{{ old('donation_date', $food->donation_date ?? '') }}">
        </div>
        @error('donation_date')
        <p class='text-danger inputerror'>{{ $message }} </p>
        @enderror


    </div>
</div>
