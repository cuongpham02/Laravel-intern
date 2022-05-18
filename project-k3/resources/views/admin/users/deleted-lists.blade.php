@extends('index')
@section('title')
    List users
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Deleted lists User</h1>
    {{-- <a href="{{ route('create-user') }}" class="btn btn-primary">Create user</a> --}}
    <table class="table">
        <thead>
           <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
                <th scope="col"></th>
           </tr>
        </thead>
        <tbody>
            @foreach ($userSoftDeletes as $user)
            <tr>
               <td>{{ $user->id }}</td>
               <td>{{ $user->name }}</td>
               <td>{{ $user->email }}</td>
               <td>{{ $user->is_role }}</td>
               <td><a href="{{ route('restore-user', [$user->id]) }}"><button type="button" class="btn btn-success">Restore</button></a></td>
               <td><a href="{{ route('permanently-user', [$user->id]) }}"><button type="button" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn User này?')">Permanently deleted</button></a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{ $userSoftDeletes->links() }}
@endsection

