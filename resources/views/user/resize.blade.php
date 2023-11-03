@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

    <div class="card">
        <div class="card-header">Resize Photo</div>
        <div class="card-body">
            <form action="{{ route('users.resizeImage', $user) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="photo" value="{{ $user->photo }}">
                <div class="mb-3 row">
                    <label for="size" class="col-md-4 col-form-label text-md-end text-start">Choose image size:</label>
                    <div class="col-md-6">
                        <select name="size" id="size" class="form-control">
                            <option value="thumbnail">Thumbnail</option>
                            <option value="square">Square</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-warning">
                            Resize Image
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Photo</th>
            <th scope="col">Resized Photo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><img src="{{ asset('storage/'.$user->photo) }}" width="150px"></td>
            <td><img src="{{ asset('storage/'.$user->photo) }}" width="150px"></td>
        </tr>
    </tbody>
</table>

@endsection
