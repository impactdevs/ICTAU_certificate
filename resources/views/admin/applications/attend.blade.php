    <x-forms.input name="first_name" label="First Name" type="text" id="first_name" placeholder="Enter your first name"
        value="{{ $applicant->first_name ?? '' }}" />
    <x-forms.input name="last_name" label="Last Name" type="text" id="last_name" placeholder="Enter your last name"
        value="{{ $applicant->last_name ?? '' }}" />
    <x-forms.input name="email" label="Email" type="email" id="email" placeholder="Enter your email"
        value="{{ $applicant->email ?? '' }}" />
    <x-forms.input name="event_id" type="hidden" :value="$events->event_id" />
    <div class="form-group">
        <input class="btn" style="background-color: #c61c1d; color: white;" type="submit" value="Submit">
    </div>
