<x-forms.input name="company_name" label="Company Name" type="text" id="company_name"
    placeholder="Enter your company name" />
<x-forms.input name="company_website" label="Company Website" type="text" id="company_website"
    placeholder="Enter your company website url" />
<x-forms.input name="niche" label="Niche" type="text" id="niche"
    placeholder="What is your company's speciality eg. Software Development" />
<x-forms.input name="phone_number" label="Phone Number" type="tel" id="phone_number"
    placeholder="Company phone number e.g 0786065399" />
<x-forms.input name="email" label="Email" type="email" id="email" placeholder="Enter company email" />
<x-forms.upload name="company_logo" label="Company Logo" id="company_logo" />
<x-forms.upload name="payment_proof" label="Payment Proof" id="payment_proof_company" />
<x-forms.hidden name="application_type" id="application_type" value="company" />
<fieldset>
    <legend style="font-size: 1.5em; margin-bottom: 10px;">Contact People</legend>
    <p style="font-size: 1em; color: #555;">Please provide details for three contact people.</p>

    @for ($i = 0; $i < 3; $i++)
        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
            <h3 style="margin-top: 0; color: #c61c1d;">Contact Person {{ $i + 1 }}</h3>
            <x-forms.input name="contact_people[{{ $i }}][first_name]" label="First Name" type="text"
                id="contact_person_first_name_{{ $i }}" placeholder="Enter first name" />
            <x-forms.input name="contact_people[{{ $i }}][last_name]" label="Last Name" type="text"
                id="contact_person_last_name_{{ $i }}" placeholder="Enter last name" />
            <x-forms.input name="contact_people[{{ $i }}][phone_number]" label="Phone Number" type="tel"
                id="contact_person_phone_number_{{ $i }}" placeholder="Enter phone number" />
            <x-forms.input name="contact_people[{{ $i }}][email]" label="Email" type="email"
                id="contact_person_email_{{ $i }}" placeholder="Enter email" />
        </div>
    @endfor
</fieldset>

<div class="form-group">
    <input class="btn" style="background-color: #c61c1d; color: white;" type="submit"
        value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
