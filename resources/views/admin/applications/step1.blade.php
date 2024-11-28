@if ($application_type == 'student')
    <x-forms.input name="first_name" label="First Name" type="text" id="first_name" placeholder="Enter your first name"
        value="{{ $applicant->first_name ?? '' }}" />
    <x-forms.input name="last_name" label="Last Name" type="text" id="last_name" placeholder="Enter your last name"
        value="{{ $applicant->last_name ?? '' }}" />
    <x-forms.input name="phone_number" label="Phone Number" type="tel" id="phone_number"
        placeholder="Enter your phone number eg 0786065399" value="{{ $applicant->phone_number ?? '' }}" />
    <x-forms.input name="email" label="Email" type="email" id="email" placeholder="Enter your email"
        value="{{ $applicant->email ?? '' }}" />
    <x-forms.hidden name="application_type" id="application_type" value="student" />
    <x-forms.checkbox />
@elseif($application_type == 'company')
    <x-forms.input name="company_name" label="Company Name" type="text" id="company_name"
        placeholder="Enter your company name" value="{{ $applicant->company_name ?? '' }}" />
    <x-forms.input name="phone_number" label="Company Phone Number" type="tel" id="company_phone_number"
        placeholder="Enter your company phone number eg 0786065399"
        value="{{ $applicant->company_phone_number ?? '' }}" />
    <x-forms.input name="email" label="Company Email" type="email" id="company_email"
        placeholder="Enter your company email" value="{{ $applicant->company_email ?? '' }}" />
    <x-forms.hidden name="application_type" id="application_type" value="company" />
    <x-forms.checkbox />
@elseif($application_type == 'professional')
    <x-forms.input name="first_name" label="First Name" type="text" id="first_name"
        placeholder="Enter your first name" value="{{ $applicant->first_name ?? '' }}" />
    <x-forms.input name="last_name" label="Last Name" type="text" id="last_name" placeholder="Enter your last name"
        value="{{ $applicant->last_name ?? '' }}" />
    <x-forms.input name="phone_number" label="Phone Number" type="tel" id="phone_number"
        placeholder="Enter your phone number eg 0786065399" value="{{ $applicant->phone_number ?? '' }}" />
    <x-forms.input name="email" label="Email" type="email" id="email" placeholder="Enter your email"
        value="{{ $applicant->email ?? '' }}" />
    <x-forms.hidden name="application_type" id="application_type" value="professional" />
    <x-forms.checkbox />
@endif
<div class="form-group">
    <input class="btn" style="background-color: #c61c1d; color: white;" type="submit" value="Submit">
</div>
