<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Number;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $payment = Payment::where('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('receipt_no', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $payment = Payment::latest()->paginate($perPage);
        }

        return view('admin.payments.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get the last receipt number and add 1
        $lastPayment = Payment::latest()->first();
        $receiptNo = $lastPayment ? $lastPayment->receipt_no + 1 : 545;

        return view('admin.payments.create', compact('receiptNo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Payment::create($requestData);

        return redirect('admin/payment')->with('flash_message', 'Payment added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $payment = Payment::findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);


        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $member = Payment::findOrFail($id);
        $member->update($requestData);

        return redirect('admin/payment')->with('flash_message', 'Payment updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Payment::destroy($id);

        return redirect('admin/payment')->with('flash_message', 'Payment deleted!');
    }

    public function generateReceipt()
    {

        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/receipt.jpeg'));

        //find the member details with the id from the request
        $member = Payment::find(request()->id);
        //get today's day
        $todayDay = date('d');

        //get today's month
        $todayMonth = date('m');

        //get today's year
        $todayYear = date('Y');

        $amountInWords = Number::spell($member->amount);

        $image->text($member->receipt_no, 60, 150, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.0);
        });

        $image->text($todayDay, 170, 148, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($todayMonth, 199, 148, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($todayYear, 233, 148, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($member->first_name . ' ' . $member->last_name, 340, 180, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($amountInWords . ' ' . 'only', 340, 205, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });


        $image->text($member->payment_of, 310, 250, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        // $image->text("attending an event at skyz hotel on 23rd of September skyz hotel on 23rd of September", 310, 272, function ($font) {
        //     $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
        //     $font->color('#000000');
        //     $font->size(15);
        //     $font->align('center');
        //     $font->valign('middle');
        //     $font->lineHeight(1.5);
        // });

        //add a tick to the receipt

        $tick = $manager->read(public_path('images/tick.png'));

        //reduce its height and width
        $tick->resize(20, 20);

        if ($member->payment_mode == "cash")
            //cash
            $image->place($tick, 'bottom-left', 90, 110);

        if ($member->payment_mode == "cheque") {
            //cheque
            $image->place($tick, 'bottom-left', 155, 110);
        }

        $image->text($member->cheque_no, 290, 300, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text(Number::format($member->balance) . '/=', 460, 300, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text(Number::format($member->amount) . '/=', 230, 330, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($member->received_by ?? "N/A", 460, 330, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text("PN", 460, 360, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->toPng();

        //save the image to the public folder
        $image->save(public_path('images/receipt_generated_' . request()->id . '.png'));

        // $img = file_get_contents(public_path('images/receipt_generated_' . request()->id . '.png'));

        // return response($img)->header('Content-Type', 'image/png');
        return response()->download(public_path('images/receipt_generated_' . request()->id . '.png'))->deleteFileAfterSend(true);
    }

    //shared receipt download url
    public function receiptDownload()
    {
        //split request()->id to get the receipt number by - and get the last element
        $receiptId = explode('-', request()->id)[0];

        $manager = new ImageManager(new Driver());

        $image = $manager->read(public_path('images/receipt.jpeg'));

        //find the member details with the id from the request
        $member = Payment::find($receiptId);
        //get today's day
        $todayDay = date('d');

        //get today's month
        $todayMonth = date('m');

        //get today's year
        $todayYear = date('Y');

        $amountInWords = Number::spell($member->amount);

        $image->text($member->receipt_no, 60, 150, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.0);
        });

        $image->text($todayDay, 170, 148, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($todayMonth, 199, 148, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($todayYear, 233, 148, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($member->first_name . ' ' . $member->last_name, 340, 180, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($amountInWords . ' ' . 'only', 340, 205, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });


        $image->text($member->payment_of, 310, 250, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        // $image->text("attending an event at skyz hotel on 23rd of September skyz hotel on 23rd of September", 310, 272, function ($font) {
        //     $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
        //     $font->color('#000000');
        //     $font->size(15);
        //     $font->align('center');
        //     $font->valign('middle');
        //     $font->lineHeight(1.5);
        // });

        //add a tick to the receipt

        $tick = $manager->read(public_path('images/tick.png'));

        //reduce its height and width
        $tick->resize(20, 20);

        if ($member->payment_mode == "cash")
            //cash
            $image->place($tick, 'bottom-left', 90, 110);

        if ($member->payment_mode == "cheque") {
            //cheque
            $image->place($tick, 'bottom-left', 155, 110);
        }

        $image->text($member->cheque_no, 290, 300, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text(Number::format($member->balance) . '/=', 460, 300, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text(Number::format($member->amount) . '/=', 230, 330, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text($member->received_by ?? "N/A", 460, 330, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->text("PN", 460, 360, function ($font) {
            $font->filename(public_path('fonts/OpenSans_Condensed-Bold.ttf'));
            $font->color('#000000');
            $font->size(15);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.5);
        });

        $image->toPng();

        //save the image to the public folder
        $image->save(public_path('images/receipt_generated_' . request()->id . '.png'));

        // $img = file_get_contents(public_path('images/receipt_generated_' . request()->id . '.png'));

        // return response($img)->header('Content-Type', 'image/png');
        return response()->download(public_path('images/receipt_generated_' . request()->id . '.png'))->deleteFileAfterSend(true);
    }

    public function ShareWidget()
    {
        //generate a unique random string
        $receiptId = uniqid() . '-' . request()->id;
        $downloadUrl = url('get-receipt') . '?id=' . $receiptId;
        $shareComponent = \Share::page(
            $downloadUrl,
            'Your Receipt is here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

            return view('share_modal', compact('shareComponent'));
    }
}
