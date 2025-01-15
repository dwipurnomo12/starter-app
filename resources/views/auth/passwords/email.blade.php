@extends('layouts.app')

@section('content')
    <div class="card mb-0">
        <div class="card-body">
            <div class="my-4">
                <h4 class="text-center">Password Reset Link</h4>
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

            @if (session('success'))
                <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
                    {{ session('success') }}</div>
            @endif


            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" class="form-control" name="email" aria-describedby="emailHelp"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4">Send Password Reset Link</button>
            </form>
        </div>
    </div>


@endsection
