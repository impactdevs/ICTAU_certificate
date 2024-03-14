<div class="form-group">
    <label for="first_name" class="control-label">{{ 'First Name' }}</label>
    <input class="form-control" name="first_name" type="text" id="first_name" value="{{ isset($member->first_name) ? $member->first_name : ''}}" >
</div>
<div class="form-group">
    <label for="last_name" class="control-label">{{ 'Last Name' }}</label>
    <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset($member->last_name) ? $member->last_name : ''}}" >
</div>
<div class="form-group">
    <label for="membership_type_id" class="control-label">{{ 'Membership Type' }}</label>
    <select class="form-control" name="membership_type_id" id="membership_type_id">
        @foreach($membershipTypes as $membershipType)
            <option value="{{ $membershipType->id }}" {{ isset($member) && $member->membership_type_id == $membershipType->id ? 'selected' : '' }}>
                {{ $membershipType->membership_type_name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="phone" class="control-label">{{ 'Phone Number' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($member->phone) ? $member->phone : ''}}" >
</div>
<div class="form-group">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($member->email) ? $member->email : ''}}" >
</div>
<div class="form-group">
    <label for="membership_id" class="control-label">{{ 'Membership Code' }}</label>
    <input class="form-control" name="membership_id" type="text" id="membership_id" value="{{ isset($member->membership_id) ? $member->membership_id : $membershipCode }}" >
</div>

<div class="form-group">
    <input class="button4" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

