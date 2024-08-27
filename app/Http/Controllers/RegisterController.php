<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'phone' => ['required', 'max:15'],
            'password' => ['required', 'min:5', 'max:20', 'confirmed'], // confirmed handles password confirmation
            'agreement' => ['accepted']
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);
        Auth::login($user);

        session()->flash('success', 'Your account has been created.');
        return redirect('/dashboard');

    }
}
