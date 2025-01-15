@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body p-5">
                        <a href="/" class="text-nowrap logo-img text-center d-block py-3 mb-4 w-100"
                            style="max-height: 150px;">
                            <img src="{{ asset('storage/' . $application->website_logo) }}" alt="Logo" class="img-fluid"
                                style="max-height: 150px;">
                        </a>
                        <div class="my-4">
                            <h4 class="text-center">Register Account</h4>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-form-label">{{ __('Role') }}</label>
                                <select class="form-control" name="role">
                                    <option value="">-- Tentukan Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="new-password">
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>


                            <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4">Register</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
