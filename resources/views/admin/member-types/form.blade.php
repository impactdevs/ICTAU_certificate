<div class="form-group">
    <label for="membership_type_name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="membership_type_name" type="text" id="membership_type_name" value="{{ isset($member_type->membership_type_name) ? $member_type->membership_type_name : ''}}" >
</div>
<div class="form-group">
    <input class="button4" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

