<?php

namespace App\Http\Controllers;

use App\Mail\CertificateSent;
use App\Mail\Registered;
use App\Models\Applicant;
use App\Models\Membership_Type;
use Illuminate\Http\Request;
use App\Models\PassportPhoto;
use App\Models\PaymentProof;
use App\Models\StudentId;
use Illuminate\Support\Str;
use App\Models\CurriculumVitae;
use App\Models\CompanyLogo;
use App\Models\ContactPerson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationApproved;
use App\Mail\ApplicationRejected;
use App\Mail\Welcome;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Models\Member;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\IpUtils;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch applicants with pagination (10 per page)
        $applicants = Applicant::whereNot('application_status', 'approve')->latest()->get();

        // Pass the applicants data to the view
        return view('admin.applications.index', compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = request()->input('category');
        //set the active tab to student
        return view('admin.applications.create', compact('category'));
    }

    public function step1(Request $request, $application_type)
    {
        //redirect to apply-to-become-a-member with the application type
        return view('admin.applications.apply', compact('application_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $recaptcha = $request->input('g-recaptcha-response');

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $params = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha,
            'remoteip' => IpUtils::anonymize($request->ip())
        ];

        // Make the HTTP request
        $response = Http::asForm()->post($url, $params);

        // Decode response
        $result = $response->json(); // Instead of json_decode($response)

        // Check if reCAPTCHA verification failed
        if (!($response->successful() && ($result['success'] ?? false) == true)) {
            $request->session()->flash('message', "Please complete the reCAPTCHA again to proceed.");
            return redirect()->back();
        }
        //generate a unique id for the application
        $uuid = Str::uuid();

        //check if the request has application_type as student
        if ($request->application_type == 'student') {
            // Validate email and phone number by checking if they are present and unique
            $validate = Validator::make($request->all(), [
                'email' => 'required|email|unique:applicants,email',
                'phone_number' => 'required|unique:applicants,phone_number',  // Corrected field name
                'g-recaptcha-response' => 'required',
            ]);



            // Check if validation fails
            if ($validate->fails()) {
                return redirect()->back()->withInput()->withErrors($validate);  // Pass errors back to the form
            }

            $this->student($uuid);
        } else if ($request->application_type == 'professional') {
            //validate email and phone number by checking if they are present and unique
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:applicants',
                'phone_number' => 'required|unique:applicants',
                'g-recaptcha-response' => 'required',
            ]);
            //check if validation fails
            if ($validate->fails()) {
                //return errors here
                // $errors = $validate->errors();
                return redirect()->back()->withInput()->withErrors($validate);  // Pass errors back to the form
            }
            $this->professional($uuid);
        } else if ($request->application_type == 'company') {
            //validate email and phone number by checking if they are present and unique
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:applicants',
                'phone_number' => 'required|unique:applicants',
                'g-recaptcha-response' => 'required',
            ]);
            //check if validation fails
            if ($validate->fails()) {

                //return errors here
                // $errors = $validate->errors();
                // return $errors;
                return redirect()->back()->withInput()->withErrors($validate);  // Pass errors back to the form

            }
            $this->company($uuid);
        } else {
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }

        $first_name = $request->first_name != null ? $request->first_name ?? '' : $request->company_name ?? '';

        Mail::to($request->email)->send(new Registered($first_name, $request->application_type, url('application/' . $uuid)));

        //route to application/$uuid
        return redirect()->to('application/' . $uuid)->with('success', 'Application Bio data submitted successfully');
    }

    //save student
    public function student($uuid)
    {
        $application = new Applicant();
        $application->first_name = request('first_name');
        $application->last_name = request('last_name');
        $application->email = request('email');
        $application->phone_number = request('phone_number');
        $application->date_of_birth = request('date_of_birth');
        $application->institution = request('institution');
        $application->course = request('course');
        $application->application_type = request('application_type');
        $application->application_id = $uuid;
        $application->save();

        if (request()->hasFile('passport_photo')) {
            $file = request()->file('passport_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to passport_photos table
            $passport_photo = new PassportPhoto();
            $passport_photo->application_id = $uuid;
            $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
            $passport_photo->save();
        }

        if (request()->hasFile('payment_proof')) {
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/payment_proofs', $filename);

            //save to payment_proofs table
            $payment_proof = new PaymentProof();
            $payment_proof->application_id = $uuid;
            $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
            $payment_proof->save();
        }

        if (request()->hasFile('student_id')) {
            $file = request()->file('student_id');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/student_ids', $filename);

            //save to student_ids table
            $student_id = new StudentId();
            $student_id->application_id = $uuid;
            $student_id->student_id = 'uploads/applications/student_ids/' . $filename;

            $student_id->save();
        }

    }

    //save professional
    public function professional($uuid)
    {
        $application = new Applicant();

        $application->first_name = request('first_name');
        $application->last_name = request('last_name');
        $application->email = request('email');
        $application->phone_number = request('phone_number');
        $application->date_of_birth = request('date_of_birth');
        $application->profession = request('profession');
        $application->application_type = request('application_type');
        $application->application_id = $uuid;
        $application->save();

        if (request()->hasFile('passport_photo')) {
            $file = request()->file('passport_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to passport_photos table
            $passport_photo = new PassportPhoto();
            $passport_photo->application_id = $uuid;
            $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
            $passport_photo->save();
        }

        if (request()->hasFile('curriculum_vitae')) {
            $file = request()->file('curriculum_vitae');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/cvs/', $filename);

            //save to cvs table
            $cv = new CurriculumVitae();
            $cv->application_id = $uuid;
            $cv->cv = 'uploads/applications/cvs/' . $filename;
            $cv->save();
        }

        if (request()->hasFile('payment_proof')) {
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/payment_proofs', $filename);

            //save to payment_proofs table
            $payment_proof = new PaymentProof();
            $payment_proof->application_id = $uuid;
            $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
            $payment_proof->save();
        }

    }
    //save company
    public function company($uuid)
    {
        $application = new Applicant();

        $application->company_name = request('company_name');
        $application->company_website = request('company_website');
        $application->niche = request('niche');
        $application->email = request('email');
        $application->phone_number = request('phone_number');
        $application->application_type = request('application_type');
        $application->application_id = $uuid;
        $application->save();

        //save the contact people
        $contact_people = request('contact_people');

        if ($contact_people != null)
            foreach ($contact_people as $contact_person) {
                $contact = new ContactPerson();
                $contact->first_name = $contact_person['first_name'];
                $contact->last_name = $contact_person['last_name'];
                $contact->phone_number = $contact_person['phone_number'];
                $contact->email = $contact_person['email'];
                $contact->application_id = $uuid;
                $contact->save();
            }

        if (request()->hasFile('company_logo')) {
            $file = request()->file('company_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/company_logos', $filename);

            //save to company_logos table
            $company_logo = new CompanyLogo();
            $company_logo->application_id = $uuid;
            $company_logo->logo = 'uploads/applications/company_logos/' . $filename;
            $company_logo->save();
        }

        if (request()->hasFile('payment_proof')) {
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/payment_proofs', $filename);

            //save to payment_proofs table
            $payment_proof = new PaymentProof();
            $payment_proof->application_id = $uuid;
            $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
            $payment_proof->save();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        if ($applicant->application_type == 'student') {
            $applicant->load('passportPhoto', 'paymentProof', 'studentId');
        } else if ($applicant->application_type == 'professional') {
            $applicant->load('passportPhoto', 'paymentProof', 'curriculumVitae');
        } else if ($applicant->application_type == 'company') {
            $applicant->load('companyLogo', 'paymentProof', 'contactPersons');
        }

        return view('admin.applications.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        //check if the application type is student
        if ($applicant->application_type == 'student') {
            $applicant->load('passportPhoto', 'paymentProof', 'studentId');
        } else if ($applicant->application_type == 'professional') {
            $applicant->load('passportPhoto', 'paymentProof', 'curriculumVitae');
        } else if ($applicant->application_type == 'company') {
            $applicant->load('companyLogo', 'paymentProof', 'contactPersons');
        }

        return view('admin.applications.edit', compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
    {
        //check if the application type is student
        if ($applicant->application_type == 'student') {
            $this->studentUpdate($request, $applicant);
        } else if ($applicant->application_type == 'professional') {
            $this->professionalUpdate($request, $applicant);
        } else if ($applicant->application_type == 'company') {
            $this->companyUpdate($request, $applicant);
        } else {
            return redirect()->back()->with('error', 'Application Bio data submission failed. Please try again.');
        }
        return redirect()->back()->with('success', 'Application Bio-data updated successfully');
    }

    public function studentUpdate($request, $applicant)
    {
        //check if the request contains any of the files
        if ($request->hasFile('passport_photo')) {
            //delete the old passport photo
            $old_passport_photo = PassportPhoto::where('application_id', $applicant->application_id)->first();
            //if $old_passport_photo is null, create a new one
            if ($old_passport_photo == null) {
                $passport_photo = new PassportPhoto();
                $file = request()->file('passport_photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/passport_photos', $filename);

                //get the passport photo related to the application
                $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
                $passport_photo->application_id = $applicant->application_id;
                $passport_photo->save();
            } else {
                //deleting the old passport photo
                if (file_exists($old_passport_photo->passport_photo)) {
                    unlink(filename: $old_passport_photo->passport_photo);
                }
                $file = request()->file('passport_photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/passport_photos', $filename);

                //get the passport photo related to the application
                $passport_photo = PassportPhoto::where('application_id', $applicant->application_id)->first();
                $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
                $passport_photo->save();
            }
        }

        if ($request->hasFile('payment_proof')) {
            //delete the old payment proof
            $old_payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();

            //if $old_payment_proof is null, create a new one
            if ($old_payment_proof == null) {
                $payment_proof = new PaymentProof();
                $file = request()->file('payment_proof');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/payment_proofs', $filename);

                //get the payment proof related to the application
                $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
                $payment_proof->application_id = $applicant->application_id;
                $payment_proof->save();
            } else {
                //check if the file exists
                if (file_exists($old_payment_proof->payment_proof)) {
                    unlink($old_payment_proof->payment_proof);
                }
                //deleting the old payment proof
                $file = request()->file('payment_proof');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/payment_proofs', $filename);

                //get the payment proof related to the application
                $payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
                $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
                $payment_proof->save();
            }
        }

        //student_id
        if ($request->hasFile('student_id')) {
            //delete the old student id
            $old_student_id = StudentId::where('application_id', $applicant->application_id)->first();
            //if $old_student_id is null, create a new one
            if ($old_student_id == null) {
                $student_id = new StudentId();
                $file = request()->file('student_id');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/student_ids', $filename);

                //get the student related to the application
                $student_id->student_id = 'uploads/applications/student_ids/' . $filename;
                $student_id->application_id = $applicant->application_id;
                $student_id->save();
            } else {
                //check if a file exists
                if (file_exists($old_student_id->student_id)) {
                    unlink($old_student_id->student_id);
                }
                //deleting the old student id
                $file = $request->file('student_id');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/student_ids', $filename);

                //get the student related to the application
                $student_id = StudentId::where('application_id', $applicant->application_id)->first();
                $student_id->student_id = 'uploads/applications/student_ids/' . $filename;
                $student_id->save();
            }
        }

        $applicant->update($request->all());
    }

    public function professionalUpdate($request, $applicant)
    {
        //check if the request contains any of the files
        if ($request->hasFile('passport_photo')) {
            //delete the old passport photo
            $old_passport_photo = PassportPhoto::where('application_id', $applicant->application_id)->first();
            //if $old_passport_photo is null, create a new one
            if ($old_passport_photo == null) {
                $passport_photo = new PassportPhoto();
                $file = request()->file('passport_photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/passport_photos', $filename);

                //get the passport photo related to the application
                $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
                $passport_photo->application_id = $applicant->application_id;
                $passport_photo->save();
            } else {
                //deleting the old passport photo
                if (file_exists($old_passport_photo->passport_photo)) {
                    unlink(filename: $old_passport_photo->passport_photo);
                }
                $file = request()->file('passport_photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/passport_photos', $filename);

                //get the passport photo related to the application
                $passport_photo = PassportPhoto::where('application_id', $applicant->application_id)->first();
                $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
                $passport_photo->save();
            }
        }

        if ($request->hasFile('curriculum_vitae')) {
            //delete the old curriculum vitae
            $old_cv = CurriculumVitae::where('application_id', $applicant->application_id)->first();
            //check if $old_cv is null, create a new one
            if ($old_cv == null) {
                $cv = new CurriculumVitae();
                $file = request()->file('curriculum_vitae');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/cvs/', $filename);

                //get the cv related to the application
                $cv->cv = 'uploads/applications/cvs/' . $filename;
                $cv->application_id = $applicant->application_id;
                $cv->save();
            } else {
                //check if a file exists
                if (file_exists($old_cv->cv)) {
                    unlink($old_cv->cv);
                }
                $file = request()->file('curriculum_vitae');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/cvs', $filename);

                //get the cv related to the application
                $cv = CurriculumVitae::where('application_id', $applicant->application_id)->first();
                $cv->cv = 'uploads/applications/cvs/' . $filename;
                $cv->save();
            }
        }

        if ($request->hasFile('payment_proof')) {
            //delete the old payment proof
            $old_payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();

            //if $old_payment_proof is null, create a new one
            if ($old_payment_proof == null) {
                $payment_proof = new PaymentProof();
                $file = request()->file('payment_proof');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/payment_proofs', $filename);

                //get the payment proof related to the application
                $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
                $payment_proof->application_id = $applicant->application_id;
                $payment_proof->save();
            } else {
                //check if the file exists
                if (file_exists($old_payment_proof->payment_proof)) {
                    unlink($old_payment_proof->payment_proof);
                }
                //deleting the old payment proof
                $file = request()->file('payment_proof');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/payment_proofs', $filename);

                //get the payment proof related to the application
                $payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
                $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
                $payment_proof->save();
            }
        }
        $applicant->update($request->all());
    }

    public function companyUpdate($request, $applicant)
    {
        //check if the request contains any of the files
        if ($request->hasFile('company_logo')) {
            //delete the old company logo
            $old_company_logo = CompanyLogo::where('application_id', $applicant->application_id)->first();

            //if $old_company_logo is null, create a new one
            if ($old_company_logo == null) {
                $company_logo = new CompanyLogo();
                $file = request()->file('company_logo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/company_logos', $filename);

                //get the company logo related to the application
                $company_logo->logo = 'uploads/applications/company_logos/' . $filename;
                $company_logo->application_id = $applicant->application_id;
                $company_logo->save();
            } else {
                //check if a file exists
                if (file_exists($old_company_logo->logo)) {
                    unlink($old_company_logo->logo);
                }
                //deleting the old company logo
                $file = request()->file('company_logo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/company_logos', $filename);

                //get the company logo related to the application
                $company_logo = CompanyLogo::where('application_id', $applicant->application_id)->first();
                $company_logo->logo = 'uploads/applications/company_logos/' . $filename;

                $company_logo->save();
            }
        }

        if ($request->hasFile('payment_proof')) {
            //delete the old payment proof
            $old_payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();

            //if $old_payment_proof is null, create a new one
            if ($old_payment_proof == null) {
                $payment_proof = new PaymentProof();
                $file = request()->file('payment_proof');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/payment_proofs', $filename);

                //get the payment proof related to the application
                $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
                $payment_proof->application_id = $applicant->application_id;
                $payment_proof->save();
            } else {
                //check if the file exists
                if (file_exists($old_payment_proof->payment_proof)) {
                    unlink($old_payment_proof->payment_proof);
                }
                //deleting the old payment proof
                $file = request()->file('payment_proof');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/applications/payment_proofs', $filename);

                //get the payment proof related to the application
                $payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
                $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
                $payment_proof->save();
            }
        }

        //contact people
        $contact_people = request('contact_people');

        if ($contact_people != null) {
            foreach ($contact_people as $contact_person) {
                //check if the contact already exists, if it does update it else create a new one
                if (ContactPerson::where('id', $contact_person['id'])->exists()) {
                    $contact = ContactPerson::find($contact_person['id']);
                    $contact->first_name = $contact_person['first_name'];
                    $contact->last_name = $contact_person['last_name'];
                    $contact->phone_number = $contact_person['phone_number'];
                    $contact->email = $contact_person['email'];
                    $contact->application_id = $applicant->application_id;
                    $contact->save();
                } else {
                    $contact = new ContactPerson();
                    $contact->first_name = $contact_person['first_name'];
                    $contact->last_name = $contact_person['last_name'];
                    $contact->phone_number = $contact_person['phone_number'];
                    $contact->email = $contact_person['email'];
                    $contact->application_id = $applicant->application_id;
                    $contact->save();
                }
            }
        }

        $applicant->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        //
    }

    public function approve(Request $request)
    {

        $applicant = Applicant::where('application_id', $request->application_id)->first();
        $isMember = Member::where('email', $applicant->email)->first();
        $settings = GeneralSettings::first();

        $applicant->application_status = $request->status;
        $update_status = $applicant->save();
        DB::beginTransaction();

        try {
            if (!$isMember) {
                //if the application status is approved, send an email to the applicant
                if ($update_status) {
                    //check if the status is approved or rejected
                    if ($request->status == 'approve') {
                        $membershipTypes = Membership_Type::all();

                        if ($applicant->application_type == 'student') {
                            $membershipType = $membershipTypes->where('membership_type_name', 'Student')->first();
                            //if its null, create the membership type
                            if ($membershipType == null) {
                                $membershipType = new Membership_Type();
                                $membershipType->membership_type_name = 'Student';
                                $membershipType->save();
                            }
                        } else if ($applicant->application_type == 'professional') {
                            $membershipType = $membershipTypes->where('membership_type_name', 'Professional')->first();
                            //if its null, create the membership type
                            if ($membershipType == null) {
                                $membershipType = new Membership_Type();
                                $membershipType->membership_type_name = 'Professional';
                                $membershipType->save();
                            }
                        } else if ($applicant->application_type == 'company') {
                            $membershipType = $membershipTypes->where('membership_type_name', 'Private Company')->first();
                            //if its null, create the membership type
                            if ($membershipType == null) {
                                $membershipType = new Membership_Type();
                                $membershipType->membership_type_name = 'Private Company';
                                $membershipType->save();
                            }
                        } else {
                            //create the membership type before saving the member
                            $membershipType = new Membership_Type();
                            $membershipType->membership_type_name = $applicant->application_type;
                            $membershipType->save();
                        }

                        // Get the last membership code and increment it
                        $lastMembership = Member::orderBy('id', 'desc')->first();
                        $lastCode = $lastMembership ? intval(substr($lastMembership->membership_id, -3)) : 299;
                        $newCode = $lastCode + 1;

                        // Get the last two figures of the current year
                        $currentYear = date('y');

                        // Generate the membership code
                        $membershipCode = 'ICTAU/' . $currentYear . '/' . str_pad($newCode, 3, '0', STR_PAD_LEFT);
                        //add the applicant to the members table
                        $member = new Member();
                        if ($applicant->application_type == 'student' || $applicant->application_type == 'professional') {
                            $member->first_name = $applicant->first_name;
                            $member->last_name = $applicant->last_name;
                        } else {
                            $member->first_name = $applicant->company_name;
                            $member->last_name = '';
                        }
                        $member->email = $applicant->email;
                        $member->phone = $applicant->phone_number;
                        $member->membership_type_id = $membershipType->id;
                        $member->membership_id = $membershipCode;
                        $member->save();
                        //send an email to the applicant
                        if ($applicant->application_type == 'company') {
                            Mail::to($applicant->email)->send(new ApplicationApproved($applicant->company_name, $applicant->application_type));
                        } else {
                            Mail::to($applicant->email)->send(new ApplicationApproved($applicant->first_name, $applicant->application_type));
                        }

                        //send a welcome email to the applicant after 5 minutes
                        Mail::to($applicant->email)->later(now()->addMinutes($settings->send_welcome_email_after * 24 * 60), new Welcome($applicant));

                        //generate the certificate
                        $path = $this->generateCertificate($member->id);

                        //send the certificate to the applicant after 10 minutes
                        Mail::to($applicant->email)->later(now()->addMinutes($settings->send_certificate_after * 24 * 60), new CertificateSent($applicant, $path));
                    } else {
                        //send an email to the applicant
                        Mail::to($applicant->email)->send(new ApplicationRejected($applicant->first_name, $applicant->application_type, $request->rejection_comments, url('application/' . $applicant->application_id)));
                    }
                }

                DB::commit();

                return redirect()->back()->with('success', 'Application approved successfully');
            } else {
                DB::rollBack();
                return redirect()->back()->with('success', 'Applicant is already a member');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function generateCertificate($user_id)
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/certificate-template.jpeg'));

        //find the member details with the id from the request
        $member = Member::find($user_id);

        $image->text($member->first_name . ' ' . $member->last_name, 800, 630, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(2.0);
        });

        $image->text(strtoupper("2025/2026"), 1316, 709, function ($font) {
            $font->filename(public_path('fonts/Roboto-Thin.ttf'));
            $font->size(30);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text($member->membershipType->membership_type_name, 880, 780, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(30);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text($member->membership_id, 800, 990, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#f15822');
            $font->size(30);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        //generate the qr code
        $qrPath = $this->generate_qr($user_id);

        //add the qr code to the certificate
        $image->place($qrPath, 'top-right', 52, 55);

        $image->toPng();

        //save the image to the public folder
        $image->save(public_path('images/certificate-generated_' . $user_id . '.png'));

        //return the path to the generated certificate
        return public_path('images/certificate-generated_' . $user_id . '.png');
    }

    public function generate_qr($memberId)
    {
        //check if the member exists

        $member = Member::find($memberId);
        $qrText = url('member/' . $member->id);

        // Generate QR code
        $img = QrCode::format('png')->size(230)->generate($qrText);

        // Save the QR code to the public folder
        file_put_contents(public_path('images/qrcode_' . $memberId . '.png'), $img);
        //return the qr path
        return public_path('images/qrcode_' . $memberId . '.png');
    }

}
