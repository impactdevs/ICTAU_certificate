    <x-forms.input name="company_name" label="Company Name" type="tel" id="company_name"
        placeholder="Enter your company name" value="{{ $applicant->company_name ?? '' }}" />

    <x-forms.input name="company_website" label="Company Website" type="text" id="company_website"
        placeholder="Enter your company website url" value="{{ $applicant->company_website ?? '' }}" />

    <x-forms.input name="niche" label="Niche" type="text" id="niche"
        placeholder="What is your company's speciality eg. Software Development"
        value="{{ $applicant->niche ?? '' }}" />

    <x-forms.input name="phone_number" label="Phone Number" type="tel" id="phone_number"
        placeholder="Enter your phone number eg 0786065399" value="{{ $applicant->phone_number ?? '' }}" />

    <x-forms.input name="email" label="Email" type="email" id="email" placeholder="Enter company email"
        value="{{ $applicant->email ?? '' }}" />

    <x-forms.upload name="company_logo" label="Company Logo" id="company_logo"
        value="{{ $applicant->companyLogo->logo ?? '' }}" />

    <x-forms.upload name="payment_proof" label="Payment Proof" id="payment_proof_company"
        value="{{ $applicant->paymentProof->payment_proof ?? '' }}" />

    <x-forms.hidden name="application_type" id="application_type" value="company" />
    <fieldset>
        <legend style="font-size: 1.5em; margin-bottom: 10px;">Contact People</legend>
        <p style="font-size: 1em; color: #555;">Please provide details for three contact people.</p>

        @for ($i = 0; $i < 3; $i++)
            <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                <h3 style="margin-top: 0; color: #c61c1d;">Contact Person {{ $i + 1 }}</h3>
                <x-forms.input name="contact_people[{{ $i }}][first_name]" label="First Name" type="text"
                    id="contact_person_first_name_{{ $i }}" placeholder="Enter first name"
                    value="{{ isset($applicant) ? $applicant->contactPersons->toArray()[$i]['first_name'] : '' }}"
                    isRequired="false" />

                <x-forms.input name="contact_people[{{ $i }}][last_name]" label="Last Name" type="text"
                    id="contact_person_last_name_{{ $i }}" placeholder="Enter last name"
                    value="{{ isset($applicant) ? $applicant->contactPersons->toArray()[$i]['last_name'] : '' }}"
                    isRequired="false" />

                <x-forms.input name="contact_people[{{ $i }}][phone_number]" label="Phone Number"
                    type="tel" id="contact_person_phone_number_{{ $i }}"
                    placeholder="Enter phone number"
                    value="{{ isset($applicant) ? $applicant->contactPersons->toArray()[$i]['phone_number'] : '' }}"
                    isRequired="false" />
                <x-forms.input name="contact_people[{{ $i }}][email]" label="Email" type="email"
                    id="contact_person_email_{{ $i }}" placeholder="Enter email"
                    value="{{ isset($applicant) ? $applicant->contactPersons->toArray()[$i]['email'] : '' }}"
                    isRequired="false" />

                {{-- hidden id field --}}
                <x-forms.hidden name="contact_people[{{ $i }}][id]"
                    id="contact_person_id_{{ $i }}"
                    value="{{ isset($applicant) ? $applicant->contactPersons->toArray()[$i]['id'] : '' }}" />

                <x-forms.checkbox />
            </div>
        @endfor
    </fieldset>

    <div class="form-group">
        <input class="btn" style="background-color: #c61c1d; color: white;" type="submit"
            value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
