@extends('layouts.user_type.guest')

@section('content')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <div class="container-fluid text-center py-3">
                                        <img class="rounded mb-3 img-fluid mx-auto d-block shadow-sm"
                                            src="{{ asset('assets/img/ictaulogo.jpg') }}" alt="ICTAU Logo">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-center">REGISTER HERE</p>
                                    <form role="form text-left" method="POST" action="/register">
                                        @csrf

                                        <!-- Name Field -->
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Name" aria-label="Name" aria-describedby="name-addon">
                                            @error('name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email Field -->
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Phone Field -->
                                        <label>Phone Number</label>
                                        <div class="mb-3">
                                            <input type="phone" class="form-control" name="phone" id="phone"
                                                placeholder="Phone Number" aria-label="Phone Number"
                                                aria-describedby="phone-addon">
                                            @error('phone')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Password Field -->
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" aria-label="password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password Field -->
                                        <label>Confirm Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Confirm Password"
                                                aria-label="Password" aria-describedby="password-addon">
                                            @error('password_confirmation')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Agreement Checkbox -->
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="agreement" id="agreement">
                                            <label class="form-check-label" for="agreement">
                                                I agree to the terms and conditions
                                            </label>
                                            @error('agreement')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- Have an account? --}}
                                        <div class="text-center">
                                            <a href="/login" class="text-sm">Have an account? Sign in</a>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-warning w-100 mt-4 mb-0 text-white">Sign
                                                up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
