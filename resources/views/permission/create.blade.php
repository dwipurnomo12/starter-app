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
                                <h4 class="text-white">Tambah Permission</h4>
                            </div>
                            <div class="col-6">
                                <a href="/permission/" class="btn icon icon-left btn-light float-end"><i
                                        data-feather="arrow-left"></i>
                                    Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <form action="/permission" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Permission <span style="color: red">*</span>
                                </label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori <span style="color: red">*</span></label>
                                <select id="category" name="category" class="form-control" value="{{ old('category') }}">
                                    <option value="" disabled selected>Pilih kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                    <option value="new">+ Tambah Kategori Baru</option>
                                </select>
                                @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 d-none" id="new-category-wrapper">
                                <label for="new_category" class="form-label">Nama Kategori Baru <span
                                        style="color: red">*</span></label>
                                <input type="text" id="new_category" name="new_category" class="form-control"
                                    placeholder="Masukkan kategori baru" value="{{ old('new_category') }}">
                                @error('new_category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn icon icon-left btn-primary float-end"> <i
                                    data-feather="save"></i>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const newCategoryWrapper = document.getElementById('new-category-wrapper');
            const newCategoryInput = document.getElementById('new_category');

            categorySelect.addEventListener('change', function() {
                if (this.value === 'new') {
                    newCategoryWrapper.classList.remove('d-none');
                    newCategoryInput.setAttribute('required', true);
                } else {
                    newCategoryWrapper.classList.add('d-none');
                    newCategoryInput.removeAttribute('required');
                    newCategoryInput.value = '';
                }
            });
        });
    </script>
@endsection
