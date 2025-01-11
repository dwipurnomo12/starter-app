@extends('layouts.app')

@section('content')
    <div class="card mb-0">
        <div class="card-body">
            <a href="/" class="text-nowrap logo-img text-center d-block py-3 mb-4 w-100" style="max-height: 150px;">
                <img src="{{ asset('storage/' . $application->website_logo) }}" alt="Iuran Kita Logo" class="img-fluid"
                    style="max-height: 150px;">
            </a>
            <div class="my-4">
                <h4 class="text-center">{{ $application->website_name }}</h4>
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

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" name="email" aria-describedby="emailHelp"
                        value="admin@example.com" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" name="password" value="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4">Masuk</button>
            </form>
        </div>

    </div>
@endsection
