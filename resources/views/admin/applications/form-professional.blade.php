<x-forms.input name="first_name" label="First Name" type="text" id="first_name" placeholder="Enter your first name" />
<x-forms.input name="last_name" label="Last Name" type="text" id="last_name" placeholder="Enter your last name" />
<x-forms.input name="phone_number" label="Phone Number" type="tel" id="phone_number"
    placeholder="Enter your phone number eg 0786065399" />
<x-forms.input name="date_of_birth" label="Date of Birth" type="date" id="date_of_birth" />
<x-forms.input name="profession" label="Profession" type="text" id="profession"
    placeholder="Enter your profession e.g Software Engineer, IT Officer" />
<x-forms.input name="email" label="Email" type="email" id="email" placeholder="Enter your email" />
<x-forms.upload name="curriculum_vitae" label="Curriculum Vitae" id="curriculum_vitae" />
<x-forms.upload name="passport_photo" label="Passport Photo" id="passport_photo_professional" />
<x-forms.upload name="payment_proof" label="Payment Proof" id="payment_proof_professional" />
<x-forms.hidden name="application_type" id="application_type" value="professional" />
<div class="form-group">
    <input class="btn" style="background-color: #c61c1d; color:white" type="submit"
        value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
