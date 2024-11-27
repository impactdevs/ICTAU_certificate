<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCertificate;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = DB::table('attendances')->paginate();

        return view('admin.attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:attendances,email', // Ensure email is unique
        ]);

        // Insert data into the attendances table and get the ID of the created record
        $id = DB::table('attendances')->insertGetId([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Generate the certificate path
        $certificatePath = $this->generate_email_certificate($id);

        // Send the email with the certificate attached
        Mail::to($validatedData['email'])->send(new SendCertificate(
            $validatedData['first_name'],
            $validatedData['last_name'],
            $certificatePath
        ));

        return view('admin.applications.thank-you');
    }

    public function generate_email_certificate($id)
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/attendance-template.jpeg'));

        //find the member details with the id from the request
        $member = DB::table('attendances')->where('id', $id)->first();

        $image->text($member->first_name . ' ' . $member->last_name, 800, 530, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(50);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(2.0);
        });


        $image->text(strtoupper("THE INAUGURAL ICT NATIONAL SUMMIT ON 23-24/10/2024"), 800, 700, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text(strtoupper("AT KAMPALA, SERENA HOTEL"), 800, 800, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text("Scan the QR code in the right corner to comfirm the validity of this certificate", 800, 1100, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(25);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        //generate the qr code
        $qrPath = $this->generate_qr($id);

        //add the qr code to the certificate
        $image->place($qrPath, 'top-right', 52, 55);
        $image->toPng();
        $imagePath = public_path('images/certificate-generated_' . $id . '.png');
        $image->save($imagePath);

        // $img = file_get_contents(public_path('images/certificate-generated_' . request()->id . '.png'));

        // return response($img)->header('Content-Type', 'image/png');
        return public_path('images/certificate-generated_' . $id . '.png');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register()
    {
        return view('admin.applications.attendance');
    }

    public function generateCertificate()
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/attendance-template.jpeg'));

        //find the member details with the id from the request
        $member = DB::table('attendances')->where('id', request()->id)->first();

        $image->text($member->first_name . ' ' . $member->last_name, 800, 530, function ($font) {
            $font->filename(public_path('fonts/Lobster-Regular.ttf'));
            $font->color('#000000');
            $font->size(50);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(2.0);
        });


        $image->text(strtoupper("THE INAUGURAL ICT NATIONAL SUMMIT ON 23-24/10/2024"), 800, 700, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text(strtoupper("AT KAMPALA, SERENA HOTEL"), 800, 800, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text("Scan the QR code in the right corner to comfirm the validity of this certificate", 800, 1100, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(25);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        //generate the qr code
        $qrPath = $this->generate_qr(request()->id);

        //add the qr code to the certificate
        $image->place($qrPath, 'top-right', 52, 55);
        $image->toPng();
        $imagePath = public_path('images/certificate-generated_' . request()->id . '.png');
        $id = request()->id;
        $image->save($imagePath);
        if (request()->file_type == 'pdf') {
            //set page to landscape


            pdf::loadView('admin.attendances.certificate', ['id' => $id])
                ->setPaper('a4', 'landscape')
                ->save(public_path('images/certificate-generated_' . request()->id . '.pdf'));
            return response()->download(public_path('images/certificate-generated_' . request()->id . '.pdf'))->deleteFileAfterSend(true);
        } else {
            // $img = file_get_contents(public_path('images/certificate-generated_' . request()->id . '.png'));

            // return response($img)->header('Content-Type', 'image/png');
            return response()->download(public_path('images/certificate-generated_' . request()->id . '.png'))->deleteFileAfterSend(true);
        }
    }


    public function certificate()
    {
        //increase execution time to 10 minutes
        set_time_limit(2000);
        //get column names from the csv
        $file = public_path('jack/invites.csv');
        $csv = array_map('str_getcsv', file($file));

        //set excution time to 5 minutes
        for ($i = 3; $i < count($csv); $i++) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read(public_path('jack/jack.jpeg'));

            $name = $csv[$i][1];

            //convert to capital letters
            $name = strtoupper($name);
            //find the member details with the id from the request
            $image->text($name, 900, 750, function ($font) {
                $font->filename(public_path('fonts/POPPINS-BOLD.TTF'));
                $font->color('#F4CECE');
                $font->size(50);
                $font->align('center');
                $font->valign('middle');
                $font->lineHeight(2.0);
            });
            $name = str_replace(' ', '_', $name);
            $image->toPng();
            $imagePath = public_path('generated/' . $name . '.png');
            $image->save($imagePath);
            if (request()->file_type == 'pdf') {
                //set page to landscape
                pdf::loadView('admin.attendances.certificate', ['id' => $name])
                    ->setPaper('a4', 'portrait')
                    ->save(public_path('jack/' . $name . '.pdf'));
                //delete the png file
                unlink(public_path('generated/' . $name . '.png'));
            }
        }
    }


    public function generate_qr($memberId)
    {
        //check if the member exists

        $member = DB::table('attendances')->where('id', $memberId)->first();
        $qrText = url('attendance/' . $member->id);

        // Generate QR code
        $img = QrCode::format('png')->size(230)->generate($qrText);

        // Save the QR code to the public folder
        file_put_contents(public_path('images/qrcode_' . $memberId . '.png'), $img);
        //return the qr path
        return public_path('images/qrcode_' . $memberId . '.png');
    }


    public function attendance_verification($id)
    {
        $member = DB::table('attendances')->where('id', $id)->first();

        return view('admin.attendances.attendance-verification', compact('member'));
    }

}
