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
use Illuminate\Support\Facades\Validator;

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
        $category = request()->input('category');
        //set the active tab to student
        return view('admin.applications.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //generate a unique id for the application
        $uuid = Str::uuid();

        //check if the request has application_type as student
        if ($request->application_type == 'student') {
            //validate email and phone number by checking if they are present and unique
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:applicants',
                'phone_number' => 'required|unique:applicants',
                'passport_photo' => 'required|mimes:png,jpg',
                'payment_proof' => 'required|mimes:png,jpg',
                'student_id' => 'required|mimes:png,jpg'
            ]);
            //check if validation fails
            if ($validate->fails()) {
                // Assuming $validate contains the validation errors and $request contains the form input
                return redirect()->to('apply?category=' . $request->input('application_type'))
                    ->withInput()
                    ->withErrors($validate)
                    ->with('error', 'Application Bio data submission failed. Please try again.');

            }
            $this->student($uuid);
        } else if ($request->application_type == 'professional') {
            //validate email and phone number by checking if they are present and unique
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:applicants',
                'phone_number' => 'required|unique:applicants',
                'passport_photo' => 'required|mimes:png,jpg',
                'curriculum_vitae' => 'required|mimes:pdf',
                'payment_proof' => 'required|mimes:png,jpg'
            ]);
            //check if validation fails
            if ($validate->fails()) {
                // Assuming $validate contains the validation errors and $request contains the form input
                return redirect()->to('apply?category=' . $request->input('application_type'))
                    ->withInput()
                    ->withErrors($validate)
                    ->with('error', 'Application Bio data submission failed. Please try again.');

            }
            $this->professional($uuid);
        } else if ($request->application_type == 'company') {
            //validate email and phone number by checking if they are present and unique
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:applicants',
                'phone_number' => 'required|unique:applicants',
                'company_logo' => 'required|mimes:png,jpg',
                'payment_proof' => 'required|mimes:png,jpg'
            ]);
            //check if validation fails
            if ($validate->fails()) {
                // Assuming $validate contains the validation errors and $request contains the form input
                return redirect()->to('apply?category=' . $request->input('application_type'))
                    ->withInput()
                    ->withErrors($validate)
                    ->with('error', 'Application Bio data submission failed. Please try again.');

            }
            $this->company($uuid);
        } else {
            return redirect()->back()->with('error', 'Application Bio data submission failed. Please try again.');
        }

        //route to application/$uuid
        return redirect()->route('application.edit', $uuid)->with('success', 'Application Bio-data submitted successfully');
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
        //
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
            //deleting the old passport photo
            unlink($old_passport_photo->passport_photo);
            $file = request()->file('passport_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //get the passport photo related to the application
            $passport_photo = PassportPhoto::where('application_id', $applicant->application_id)->first();
            $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
            $passport_photo->save();
        }

        if ($request->hasFile('payment_proof')) {
            //delete the old payment proof
            $old_payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
            //deleting the old payment proof
            unlink($old_payment_proof->payment_proof);

            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/payment_proofs', $filename);

            //get the payment proof related to the application
            $payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
            $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
            $payment_proof->save();
        }

        //student_id
        if ($request->hasFile('student_id')) {
            //delete the old student id
            $old_student_id = StudentId::where('application_id', $applicant->application_id)->first();
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

        $applicant->update($request->all());
    }

    public function professionalUpdate($request, $applicant)
    {
        //check if the request contains any of the files
        if ($request->hasFile('passport_photo')) {
            //delete the old passport photo
            $old_passport_photo = PassportPhoto::where('application_id', $applicant->application_id)->first();
            //deleting the old passport photo
            unlink($old_passport_photo->passport_photo);
            $file = request()->file('passport_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/passport_photos', $filename);

            //get the passport photo related to the application
            $passport_photo = PassportPhoto::where('application_id', $applicant->application_id)->first();
            $passport_photo->passport_photo = 'uploads/applications/passport_photos/' . $filename;
            $passport_photo->save();
        }

        if ($request->hasFile('curriculum_vitae')) {
            //delete the old curriculum vitae
            $old_cv = CurriculumVitae::where('application_id', $applicant->application_id)->first();
            //deleting the old curriculum vitae
            unlink($old_cv->cv);
            $file = request()->file('curriculum_vitae');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/cvs', $filename);

            //get the cv related to the application
            $cv = CurriculumVitae::where('application_id', $applicant->application_id)->first();
            $cv->cv = 'uploads/applications/cvs/' . $filename;
            $cv->save();
        }

        if ($request->hasFile('payment_proof')) {
            //delete the old payment proof
            $old_payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
            //deleting the old payment proof
            unlink($old_payment_proof->payment_proof);
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/payment_proofs', $filename);

            //get the payment proof related to the application
            $payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
            $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
            $payment_proof->save();
        }

        $applicant->update($request->all());
    }

    public function companyUpdate($request, $applicant)
    {
        //check if the request contains any of the files
        if ($request->hasFile('company_logo')) {
            //delete the old company logo
            $old_company_logo = CompanyLogo::where('application_id', $applicant->application_id)->first();
            //deleting the old company logo
            unlink($old_company_logo->logo);
            $file = request()->file('company_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/company_logos', $filename);

            //get the company logo related to the application
            $company_logo = CompanyLogo::where('application_id', $applicant->application_id)->first();
            $company_logo->logo = 'uploads/applications/company_logos/' . $filename;
            $company_logo->save();
        }

        if ($request->hasFile('payment_proof')) {
            //delete the old payment proof
            $old_payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
            //deleting the old payment proof
            unlink($old_payment_proof->payment_proof);
            $file = request()->file('payment_proof');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/applications/payment_proofs', $filename);

            //get the payment proof related to the application
            $payment_proof = PaymentProof::where('application_id', $applicant->application_id)->first();
            $payment_proof->payment_proof = 'uploads/applications/payment_proofs/' . $filename;
            $payment_proof->save();
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
}
