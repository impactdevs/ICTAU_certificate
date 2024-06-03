<div class="form-group upload">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <div class="upload-container text-center">
        <label for="{{ $id }}">
            <img src="{{ asset('assets/img/upload.png') }}" alt="upload placeholder" class="img-fluid upload-icon mt-3">
        </label>
        <input type="file" name="{{ $name }}" id="{{ $id }}" class="form-control-file d-none">
    </div>
    <div id="{{ $form_text_id }}" class="form-text text-muted">
        The file should be a JPG or PNG.
    </div>
</div>
