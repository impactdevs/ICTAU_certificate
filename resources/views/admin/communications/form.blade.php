<div class="mb-3">
    <label for="recipients" class="form-label">Recipient Selection</label>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Individual Members</label>
                    <select class="form-control select2" id="members" name="members[]" multiple>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">
                                {{ $member->first_name }} {{ $member->last_name }} ({{ $member->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Membership Types</label>
                    <select class="form-control select2" id="membership_types" name="membership_types[]">
                        <option value="">-- Select Membership Type --</option>
                        <option value="all">All Members</option>
                        @foreach ($membershipTypes as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->membership_type_name }} Members
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- subscription --}}
                <div class="col-md-6 mt-3">
                    <label class="form-label">Subscription Status</label>
                    <select class="form-control select2" id="subscription_status" name="subscription_status">
                        <option value="">-- Select Subscription Status --</option>
                        <option value="running">Running Subscriptions</option>
                        <option value="expired">Expired Subscriptions</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="subject" class="form-label">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" required>
</div>

<div class="mb-3">
    <label for="body" class="form-label">Body</label>
    <textarea class="form-control" id="body" name="body" rows="6"></textarea>
</div>
<button type="submit" class="btn btn-primary">Send Email</button>

@push('scripts')
    {{-- Required Styles and Scripts --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- You will need to integrate a WYSIWYG editor, like TinyMCE or CKEditor for the body --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"
        integrity="sha512-/4EpSbZW47rO/cUIb0AMRs/xWwE8pyOLf8eiDWQ6sQash5RP1Cl8Zi2aqa4QEufjeqnzTK8CLZWX7J5ZjLcc1Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#members').select2({
                placeholder: 'Select individual members',
                allowClear: true,
                closeOnSelect: false
            });

            $('#membership_types').select2({
                placeholder: '-- Select Membership Type --',
                allowClear: true,
                closeOnSelect: false
            });

            tinymce.init({
                selector: '#body', // This will make the textarea a WYSIWYG editor
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            });
        });
    </script>
@endpush
