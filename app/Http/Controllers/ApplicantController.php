<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\PassportPhoto;
use App\Models\PaymentProof;
use App\Models\StudentId;
use Illuminate\Support\Str;
use App\Models\CurriculumVitae;
use App\Models\CompanyLogo;
use App\Models\ContactPerson;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate email and phone number by checking if they are present and unique
        $request->validate([
            'email' => 'required|unique:applicants',
            'phone_number' => 'required|unique:applicants'
        ]);
        
        //check if the request has application_type as student
        if ($request->application_type == 'student') {
            $this->student();
        } else if ($request->application_type == 'professional') {
            $this->professional();
        } else if ($request->application_type == 'company') {
            $this->company();
        } else {
            return redirect()->back()->with('error', 'Application Bio data submission failed. Please try again.');
        }

        return redirect()->back()->with('success', 'Application Bio-data submitted successfully');
    }

    //save student
    public function student()
    {
        $application = new Applicant();

        $application->first_name = request('first_name');
        $application->last_name = request('last_name');
        $application->email = request('email');
        $application->phone_number = request('phone_number');
        $application->date_of_birth = request('date_of_birth');
        $application->institution = request('institution');
        $application->course = request('course');
        $application->application_id = Str::uuid();
        $application->save();

        if (request()->hasFile('passport_photo')) {
            $file = request()->file('passport_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to passport_photos table
            $passport_photo = new PassportPhoto();
            $passport_photo->application_id = $application->application_id;
            $passport_photo->passport_photo = $filename;
            $passport_photo->save();
        }

        if (request()->hasFile('payment_proof')) {
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to payment_proofs table
            $payment_proof = new PaymentProof();
            $payment_proof->application_id = $application->application_id;
            $payment_proof->payment_proof = $filename;
            $payment_proof->save();
        }

        if (request()->hasFile('student_id')) {
            $file = request()->file('student_id');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to student_ids table
            $student_id = new StudentId();
            $student_id->application_id = $application->application_id;
            $student_id->student_id = $filename;

            $student_id->save();
        }

    }

    //save professional
    public function professional()
    {
        $application = new Applicant();

        $application->first_name = request('first_name');
        $application->last_name = request('last_name');
        $application->email = request('email');
        $application->phone_number = request('phone_number');
        $application->date_of_birth = request('date_of_birth');
        $application->profession = request('profession');
        $application->application_id = Str::uuid();
        $application->save();

        if (request()->hasFile('passport_photo')) {
            $file = request()->file('passport_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to passport_photos table
            $passport_photo = new PassportPhoto();
            $passport_photo->application_id = $application->application_id;
            $passport_photo->passport_photo = $filename;
            $passport_photo->save();
        }

        if (request()->hasFile('curriculum_vitae')) {
            $file = request()->file('curriculum_vitae');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/cvs', $filename);

            //save to cvs table
            $cv = new CurriculumVitae();
            $cv->application_id = $application->application_id;
            $cv->cv = $filename;
            $cv->save();
        }

        if (request()->hasFile('payment_proof')) {
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to payment_proofs table
            $payment_proof = new PaymentProof();
            $payment_proof->application_id = $application->application_id;
            $payment_proof->payment_proof = $filename;
            $payment_proof->save();
        }

    }
    //save company
    public function company()
    {
        $application = new Applicant();

        $application->first_name = request('company_name');
        $application->first_name = request('company_website');
        $application->first_name = request('niche');
        $application->email = request('email');
        $application->phone_number = request('phone_number');
        $application->application_id = Str::uuid();
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
                $contact->application_id = $application->application_id;
                $contact->save();
            }

        if (request()->hasFile('company_logo')) {
            $file = request()->file('company_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/company_logos', $filename);

            //save to company_logos table
            $company_logo = new CompanyLogo();
            $company_logo->application_id = $application->application_id;
            $company_logo->logo = $filename;
            $company_logo->save();
        }

        if (request()->hasFile('payment_proof')) {
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //save to payment_proofs table
            $payment_proof = new PaymentProof();
            $payment_proof->application_id = $application->application_id;
            $payment_proof->payment_proof = $filename;
            $payment_proof->save();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
