@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

    <div class="card">
        <div class="card-header">Resize Photo</div>
        <div class="card-body">
            <form action="{{ route('resizeImage', $user) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="photo" value="{{ $user->photo }}">
                <div class="mb-3 row">
                    <label for="size" class="col-md-4 col-form-label text-md-end text-start">Choose image size:</label>
                    <div class="col-md-6">
                        <select name="size" id="size" class="form-control">
                            <option value="square" {{ $user->size === 'square' ? 'selected' : '' }}>Square</option>
                            <option value="thumbnail" {{ $user->size === 'thumbnail' ? 'selected' : '' }}>Thumbnail</option>
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
            <th scope="col">Square Photo</th>
            <th scope="col">Thumbnail Photo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                @if($user->photo)  
                    <img src="{{ asset('storage/photo/original/' . $user->photo) }}"></td>
                @else
                    <p>Tidak Ada Photo</p></td>
                @endif
            <td>
                @if($user->photo)  
                    @if (File::exists(storage_path('app/public/photo/square/' . $user->photo)))
                        <img src="{{ asset('storage/photo/square/' . $user->photo) }}"></td>
                    @else
                        <p>Photo Belum Diresize</p></td>
                    @endif
                @else
                    <p>Tidak Ada Photo</p></td>
                @endif
            <td>
                @if($user->photo)  
                    @if (File::exists(storage_path('app/public/photo/thumbnail/' . $user->photo)))
                        <img src="{{ asset('storage/photo/thumbnail/' . $user->photo) }}"></td>
                    @else
                        <p>Photo Belum Diresize</p></td>
                    @endif
                @else
                    <p>Tidak Ada Photo</p></td>
                @endif
        </tr>
    </tbody>
</table>

@endsection
