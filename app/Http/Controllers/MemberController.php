<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Member;
use App\Models\Membership_Type;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Barryvdh\DomPDF\Facade\Pdf;

use SimpleSoftwareIO\QrCode\Facades\QrCode;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $member = Member::where('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('membership_id', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $member = Member::latest()->paginate($perPage);
        }

        return view('admin.members.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $membershipTypes = Membership_Type::all();

        // Get the last membership code and increment it
        $lastMembership = Member::orderBy('id', 'desc')->first();
        $lastCode = $lastMembership ? intval(substr($lastMembership->membership_id, -3)) : 299;
        $newCode = $lastCode + 1;

        // Get the last two figures of the current year
        $currentYear = date('y');

        // Generate the membership code
        $membershipCode = 'ICTAU/' . $currentYear . '/' . str_pad($newCode, 3, '0', STR_PAD_LEFT);

        return view('admin.members.create', compact('membershipTypes', 'membershipCode', 'newCode'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Member::create($requestData);

        return redirect('admin/member')->with('flash_message', 'Member added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

        $member = Member::findOrFail($id);

        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $membershipTypes = Membership_Type::all();


        return view('admin.members.edit', compact('member', 'membershipTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $member = Member::findOrFail($id);
        $member->update($requestData);

        return redirect('admin/member')->with('flash_message', 'Member updated!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Member::destroy($id);

        return redirect('admin/member')->with('flash_message', 'Member deleted!');
    }

    /*
     *
     */


    public function generateCertificate()
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/certificate-template.jpeg'));

        //find the member details with the id from the request
        $member = Member::find(request()->id);

        $image->text($member->first_name . ' ' . $member->last_name, 800, 630, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(2.0);
        });

        $image->text(strtoupper("2024/2025"), 1316, 709, function ($font) {
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
        $qrPath = $this->generate_qr(request()->id);

        //add the qr code to the certificate
        $image->place($qrPath, 'top-right', 52, 55);
        $image->toPng();
        $imagePath = public_path('images/certificate-generated_' . request()->id . '.png');
        $id = request()->id;
        $image->save($imagePath);
        if (request()->file_type == 'pdf') {
            //set page to landscape


            pdf::loadView('admin.members.certificate', ['id' => $id])
            ->setPaper('a4', 'landscape')
            ->save(public_path('images/certificate-generated_' . request()->id . '.pdf'));
            return response()->download(public_path('images/certificate-generated_' . request()->id . '.pdf'))->deleteFileAfterSend(true);
        } else {
            // $img = file_get_contents(public_path('images/certificate-generated.png'));

            // return response($img)->header('Content-Type', 'image/png');
            return response()->download(public_path('images/certificate-generated_' . request()->id . '.png'))->deleteFileAfterSend(true);
        }
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

    public function member_verification($id)
    {
        $member = Member::find($id);
        return view('admin.members.member_verification', compact('member'));
    }
}

