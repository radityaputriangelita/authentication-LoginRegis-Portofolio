@extends('auth.layouts')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Photo</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_user as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
            @if ($user->photo)  
                @if (File::exists(storage_path('app/public/photo/square/' . $user->photo)))
                    <img src="{{ asset('storage/photo/square/' . $user->photo) }}"></td>
                @elseif (File::exists(storage_path('app/public/photo/thumbnail/' . $user->photo)))
                    <img src="{{ asset('storage/photo/thumbnail/' . $user->photo) }}"></td>
                @else
                    <img src="{{ asset('storage/photo/original/' . $user->photo) }}"></td>
                @endif
            @else 
                <p>Tidak Ada Photo</p></td>
            @endif
            <td>
                <form action="{{ route('destroy', $user) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm hapus-button" onClick="return confirm('Yakin mau dihapus')">Hapus Photo</button>
                </form>
                <a href="{{ route('edit', $user) }}" class="btn btn-primary btn-sm edit-button">Edit</a>
                <a href="{{ route('resizeForm', $user) }}" class="btn btn-warning btn-sm resize-button">Resize Photo</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
