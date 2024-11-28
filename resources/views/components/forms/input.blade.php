<div class="form-group">
    <label for="{{ $id }}">{{ $label }} @if (blank($isRequired))
            (*)
        @endif
    </label>
    <input type="{{ $type }}" class="form-control shadow-none" id="{{ $id }}" name="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}"
        @if (blank($isRequired)) required @endif>
</div>
