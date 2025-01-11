<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Applicant;

class DashboardController extends Controller
{
    public function index() {
        $memberships = Member::count();
        $new_applications = Applicant::where('application_status', 'pending')->count();
        return view('dashboard', compact('memberships', 'new_applications'));
    }
}
