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
            <td><img src="{{ asset('storage/'.$user->photo) }}" width="150px"></td>
            <td>
                <form action="{{ route('users.destroy', $user) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm hapus-button" onClick="return confirm('Yakin mau dihapus')">Hapus Photo</button>
                </form>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm edit-button">Edit</a>
                <a href="{{ route('users.resizeForm', $user) }}" class="btn btn-warning btn-sm resize-button">Resize Photo</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
