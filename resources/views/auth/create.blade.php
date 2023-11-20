@extends('auth.layouts')

@section('content')
<form action="{{ route('ApiGallery') }}" method="GET">
    @csrf
    <button type="submit" class="btn btn-secondary btn-sm back-button">Back</button>
</form>
<form action="{{ route('ApiStoreGallery') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 row">
        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="title" name="title">
            {{-- @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}
        </div>
    </div>
    <div class="mb-3 row">
        <label for="link" class="col-md-4 col-form-label text-md-end text-start">Link</label>
        <div class="col-md-6">
            <input type="text" class="form-control form-control-edit" id="link" name="link">
            {{-- @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}
        </div>
    </div>
    <div class="mb-3 row">
        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
        <div class="col-md-6">
            <textarea class="form-control form-control-edit" id="description" rows="5" name="description"></textarea>
            {{-- @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}
         </div>
    </div>
    <div class="mb-3 row d-flex">
        <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">File input</label>
        <div class="col-md-6">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input form-control-edit" id="input-file" name="picture">
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 row d-flex">
        <label for="input-file" class="col-md-4 col-form-label text-md-end text-start"></label>
        <div class="col-md-6 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
