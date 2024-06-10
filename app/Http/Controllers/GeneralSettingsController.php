<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneralSettings;

class GeneralSettingsController extends Controller
{
    public function update(Request $request){
        $request->validate([
            'send_certificate_after' => 'required|numeric',
            'send_welcome_email_after' => 'required|numeric',
        ]);

        $requestData = $request->all();

        $general_setting = GeneralSettings::first();

        $general_setting->update($requestData);

        return redirect()->route('admin.general_settings.update')->with('success', 'General settings updated successfully');
    }

    public function edit()
    {
        $general_settings = DB::table('general__settings')->first();
        return view('admin.general_settings.edit', compact('general_settings'));
    }
}
