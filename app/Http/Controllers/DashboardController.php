<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Applicant;

class DashboardController extends Controller
{
    public function index() 
    {
        $memberships = Member::count();
        $new_applications = Applicant::where('application_status', 'pending')->count();
        $approved_applications = Applicant::where('application_status', 'approved')->count();
        $rejected_applications = Applicant::where('application_status', 'rejected')->count();
        $pending_applications = Applicant::where('application_status', 'pending')->count();

        return view('dashboard', compact(
            'memberships', 
            'new_applications', 
            'approved_applications', 
            'rejected_applications', 
            'pending_applications'
        ));
    }
}
