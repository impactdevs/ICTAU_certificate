<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function index()
    {
        return view('admin.communications.index');
    }

    public function create()
    {
        return view('admin.communications.create');
    }

    public function sendEmai()
    {

    }

    public function sendSms()
    {
        
    }
}
