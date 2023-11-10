@extends('auth.layouts')

@section('content')
<form action="{{ route('updatePorto', $post->id) }}" method="POST" enctype="multipart/form-data">
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    @csrf
    @method('PATCH') <!-- Menggunakan metode PATCH untuk mengirimkan data pembaruan -->

    <div class="mb-3 row">
        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="link" class="col-md-4 col-form-label text-md-end text-start">Link</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="link" name="link" value="{{ $post->link }}">
            @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
        <div class="col-md-6">
            <textarea class="form-control" id="description" rows="5" name="description">{{ $post->description }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
         </div>
    </div>
    <div class="mb-3 row">
        <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">File input</label>
        <div class="col-md-6">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-file" name="picture">
                    <label class="custom-file-label" for="input-file">Choose file</label>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
