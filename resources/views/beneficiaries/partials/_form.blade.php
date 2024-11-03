<div class="d-flex justify-content-center">
    <div class="w-50">
        <!-- Name Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $beneficiary->name ?? '') }}" required>
            @error('name')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Contact Info Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Contact Info</label>
            <input type="text" class="form-control @error('contact_info') is-invalid @enderror" name="contact_info" value="{{ old('contact_info', $beneficiary->contact_info ?? '') }}">
            @error('contact_info')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Address Input -->
        <div class="input-group input-group-outline mt-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $beneficiary->address ?? '') }}">
            @error('address')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Type Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                <option value="">Select Type</option>
                <option value="Individual" {{ old('type', $beneficiary->type ?? '') == 'Individual' ? 'selected' : '' }}>Individual</option>
                <option value="Organization" {{ old('type', $beneficiary->type ?? '') == 'Organization' ? 'selected' : '' }}>Organization</option>
                <option value="Community Center" {{ old('type', $beneficiary->type ?? '') == 'Community Center' ? 'selected' : '' }}>Community Center</option>
                <option value="Shelter" {{ old('type', $beneficiary->type ?? '') == 'Shelter' ? 'selected' : '' }}>Shelter</option>
            </select>
            @error('type')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Status Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="Active" {{ old('status', $beneficiary->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status', $beneficiary->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Managed By Input -->
        <div class="input-group input-group-outline mt-3">
            <select name="managed_by" class="form-control @error('managed_by') is-invalid @enderror" required>
                <option value="">Managed By</option>
                @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}" {{ old('managed_by', $beneficiary->managed_by ?? '') == $admin->id ? 'selected' : '' }}>
                        {{ $admin->name }}
                    </option>
                @endforeach
            </select>
            @error('managed_by')
            <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <!-- Needs Input -->
        <div class="input-group input-group-outline mt-3">
            <textarea name="needs" class="form-control @error('needs') is-invalid @enderror" placeholder="List the needs...">{{ old('needs', $beneficiary->needs ?? '') }}</textarea>
            @error('needs')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
