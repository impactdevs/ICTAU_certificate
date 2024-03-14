<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Member;
use App\Models\Membership_Type;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

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

        $image->toPng();

        //save the image to the public folder
        $image->save(public_path('images/certificate-generated.png'));

        $img = file_get_contents(public_path('images/certificate-generated.png'));

        return response($img)->header('Content-Type', 'image/png');
    }

    public function generate_qr()
    {
        $url = "https://image.intervention.io/v3/basics/image-output#encode-images-with-encoder-objects";


        // Create renderer for PNG image output
        $renderer = new ImageRenderer(
            new RendererStyle(100),
            new ImagickImageBackEnd()
        );

        // Create writer to generate QR code
        $writer = new Writer($renderer);

        // Generate the QR code as a PNG image
        $qrCode = $writer->writeString($url);

        // Prompt the user to save the image
        header('Content-Disposition: attachment; filename="qr_code.png"');
        header('Content-Type: image/png');
        echo $qrCode;
    }
}

