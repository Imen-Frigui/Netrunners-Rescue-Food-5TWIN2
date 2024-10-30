<div class="d-flex justify-content-center">
    <div class="w-50">
        <!-- Donor Type Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="donor_type" class="form-control @error('donor_type') is-invalid @enderror" required>
                <option value="">Select Donor Type</option>
                <option value="Restaurant" {{ old('donor_type', $donation->donor_type ?? '') == 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                <option value="Individual" {{ old('donor_type', $donation->donor_type ?? '') == 'Individual' ? 'selected' : '' }}>Individual</option>
                <option value="Charity" {{ old('donor_type', $donation->donor_type ?? '') == 'Charity' ? 'selected' : '' }}>Charity</option>
            </select>
            @error('donor_type')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Quantity Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Quantity</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity', $donation->quantity ?? '') }}" required>
            @error('quantity')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Donation Date Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Donation Date</label>
            <input type="date" class="form-control @error('donation_date') is-invalid @enderror" name="donation_date" value="{{ old('donation_date', $donation->donation_date ?? '') }}" required>
            @error('donation_date')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Status Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="Pending" {{ old('status', $donation->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ old('status', $donation->status ?? '') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Completed" {{ old('status', $donation->status ?? '') == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Canceled" {{ old('status', $donation->status ?? '') == 'Canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
            @error('status')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Remarks Input -->
        <div class="input-group input-group-outline mt-3">
            <textarea
                name="remarks"
                class="form-control @error('remarks') is-invalid @enderror"
                placeholder="Add your remarks here...">{{ old('remarks', $donation->remarks ?? '') }}</textarea>
            @error('remarks')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select Foods Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="food_id" class="form-control @error('food_id') is-invalid @enderror" required>
                <option value="">Select Food</option>
                @foreach ($foods as $food)
                <option value="{{ $food->id }}" {{ old('food_id', $donation->food_id ?? '') == $food->id ? 'selected' : '' }}>{{ $food->food_name }}</option>
                @endforeach
            </select>
            @error('food_id')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>