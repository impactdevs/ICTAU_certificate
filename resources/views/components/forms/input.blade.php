<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control shadow-none" id="{{ $id }}" name="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" required>

    @error($name)
        <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
</div>
