@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <h3>Settings</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
                        {{ session('success') }}</div>
                @endif
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Aplikasi/Website</h4>
                    </div>
                    <div class="card-body pt-3">
                        <form action="/aplikasi/{{ $application->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="form-group">
                                <label for="website_name">Nama aplikasi/website<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="website_name" id="website_name"
                                    value="{{ old('website_name', $application->website_name) }}">
                                @error('website_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="website_logo">Logo aplikasi/website<span style="color: red">*</span></label>
                                <br>
                                <img src="{{ $application->website_logo ? asset('storage/' . $application->website_logo) : '' }}"
                                    class="img-preview img-fluid mb-3 mt-2" id="preview"
                                    style="border-radius: 3px; max-height:50px; max-width:50px; overflow:hidden;">
                                <br>
                                <input type="file" class="form-control" name="website_logo" id="website_logo"
                                    onchange="previewImage()">
                                @error('website_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Deskripsi situs <span style="color: red">*</span></label>
                                <textarea name="meta_description" id="summernote">{!! $application->meta_description !!}</textarea>
                                @error('meta_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-success float-end">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Preview Image -->
    <script>
        function previewImage() {
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <!-- Summernote -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
        });
    </script>
@endsection
