<div class="form-group upload">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <div class="upload-container text-center">
        @if ($value)
        <label for="{{ $id }}">
            <img src="{{ asset($value) }}" alt="current image" class="img-fluid mt-3" id="current-{{ $id }}">
        </label>
        @else
            <label for="{{ $id }}">
                <img src="{{ asset('assets/img/upload.png') }}" alt="upload placeholder" class="img-fluid upload-icon mt-3">
            </label>
        @endif
        <input type="file" name="{{ $name }}" id="{{ $id }}" class="form-control-file d-none" @if (!$value) required @endif onchange="previewFile('{{ $id }}')">
    </div>
    <div id="preview-{{ $id }}" class="mt-2">
        <!-- Preview will be shown here -->
    </div>
    <div id="{{ $form_text_id }}" class="form-text text-muted">
        The file should be a JPG or PNG.
    </div>
</div>
