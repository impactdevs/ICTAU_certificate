<?php

namespace App\Http\Controllers;

use App\Models\Member;

class DashboardController extends Controller
{
    public function index() {
        $memberships = Member::count();
        return view('dashboard', compact('memberships'));
    }
}
