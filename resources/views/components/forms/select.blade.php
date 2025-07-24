<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        <option value="">-- Choose --</option>
        @foreach($options as $value => $display)
            <option value="{{ $value }}" {{ (old($name, $selected) == $value) ? 'selected' : '' }}>
                {{ $display }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
</div>
