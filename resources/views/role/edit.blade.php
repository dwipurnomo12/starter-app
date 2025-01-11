@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <h3>User Management</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="text-white">Edit Role</h4>
                            </div>
                            <div class="col-6">
                                <a href="/role/" class="btn icon icon-left btn-light float-end"><i
                                        data-feather="arrow-left"></i>
                                    Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <form action="/role/{{ $role->id }}" method="POST">
                            @method('put')
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Role <span style="color: red">*</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name', $role->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="permissions" class="form-label">Permissions <span
                                        style="color: red">*</span></label>

                                <div class="row">
                                    @foreach ($permissions as $category => $permissionGroup)
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <h5>{{ $category }}</h5>
                                                @foreach ($permissionGroup as $permission)
                                                    <div class="form-check">
                                                        <!-- Cek apakah permission ini sudah dipilih untuk role saat edit -->
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}"
                                                            id="permission_{{ $permission->id }}"
                                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="permission_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
