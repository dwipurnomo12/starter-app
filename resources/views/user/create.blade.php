@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <h3>User Management</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
                        {{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="text-white">Tambah User</h4>
                            </div>
                            <div class="col-6">
                                <a href="/user" class="btn icon icon-left btn-light float-end"><i
                                        data-feather="arrow-left"></i>
                                    Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <form action="/user" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama User<span style="color: red">*</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email<span style="color: red">*</span></label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password<span style="color: red">*</span></label>
                                <input type="password" id="password" name="password" class="form-control"
                                    value="{{ old('password') }}" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="roles" class="form-label">Roles<span style="color: red">*</span></label>
                                <select name="role" id="role" class="form-control">
                                    <option value=""> -- Pilih Role -- </option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn icon icon-left btn-primary float-end">
                                <i data-feather="save"></i>Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
