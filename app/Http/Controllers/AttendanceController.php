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
use App\Models\Event;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Attendance::with('event');

    if ($request->has('event_id') && $request->event_id != '') {
        $query->where('event_id', $request->event_id);
    }

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'LIKE', "%$search%")
              ->orWhere('last_name', 'LIKE', "%$search%")
              ->orWhere('email', 'LIKE', "%$search%");
        });
    }

    $attendances = $query->paginate(10);
    $events = Event::orderBy('event_date', 'desc')->get();

    return view('admin.attendances.index', compact('attendances', 'events'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $events = Event::all()->pluck('topic', 'event_id')->toArray();;
        return view('admin.attendances.create', compact('events'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validate the request data
    $validatedData = $request->validate([
        'event_id'   => 'required|uuid|exists:events,event_id',
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|max:255|unique:second_summit_attendance,email',
    ]);

    // Insert into database
    $id = DB::table('second_summit_attendance')->insertGetId([
        'event_id'   => $validatedData['event_id'],
        'first_name' => $validatedData['first_name'],
        'last_name'  => $validatedData['last_name'],
        'email'      => $validatedData['email'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);



        return view('admin.applications.thank-you');
    }

    public function generate_email_certificate($id)
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/attendance-template.jpeg'));

        //find the member details with the id from the request
        $member = DB::table('second_summit_attendance')->where('id', $id)->first();

        $image->text($member->first_name . ' ' . $member->last_name, 800, 530, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(50);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(2.0);
        });


        $image->text(strtoupper("2ND ICT NATIONAL SUMMIT"), 800, 650, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text(strtoupper("17–18 JULY 2025"), 800, 730, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text(strtoupper("AT KAMPALA, NATIONAL ICT INNOVATION HUB"), 800, 810, function ($font) {
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
       $attendance = Attendance::findOrFail($id);
        $events = Event::orderBy('name')->get(); // for a dropdown if needed

        return view('admin.attendances.edit', compact('attendance', 'events'));
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

    public function register(Request $request)
    {
        $event_id = $request->event_id;
        $events = Event::findOrFail($event_id);
        return view('admin.applications.attendance', compact('events'));
    }


    public function generateCertificate()
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/attendance-template.jpeg'));

        //find the member details with the id from the request
        $member = DB::table('second_summit_attendance')->where('id', request()->id)->first();

        $image->text($member->first_name . ' ' . $member->last_name, 800, 530, function ($font) {
            $font->filename(public_path('fonts/Lobster-Regular.ttf'));
            $font->color('#000000');
            $font->size(50);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(2.0);
        });


         $image->text(strtoupper("2ND ICT NATIONAL SUMMIT"), 800, 650, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text(strtoupper("17–18 JULY 2025"), 800, 730, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->size(60);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text(strtoupper("AT KAMPALA, NATIONAL ICT INNOVATION HUB"), 800, 810, function ($font) {
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

        $member = DB::table('second_summit_attendance')->where('id', $memberId)->first();
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
        $member = DB::table('second_summit_attendance')->where('id', $id)->first();

        return view('admin.attendances.attendance-verification', compact('member'));
    }

        public function generate_qr_for_attendance()
    {
        $qrText = 'http://crm.ictau.ug/summit-attendance-registration';

        // Generate QR code
        $img = QrCode::format('png')->size(230)->generate($qrText);

        // Save the QR code to the public folder
        file_put_contents(public_path('images/summit_attendance_qrcode.png'), $img);
        //return the qr path
        return response()->file(public_path('images/summit_attendance_qrcode.png'), ['Content-Type' => 'image/png']);
    }
}
