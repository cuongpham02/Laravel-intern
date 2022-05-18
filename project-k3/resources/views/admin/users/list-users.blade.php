@extends('index')
@section('title')
    List users
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Users</h1>
    <a href="{{ route('create-user') }}" class="btn btn-primary">Create user</a>
    <br>
    <a style="float:right;" href="{{ route('deleted-users') }}"class="btn btn-warning">Deleted Lists</a>
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
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td><a href="{{ route('show-user',[$user->id]) }}" class="link">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td><h6>{{ $user->is_role }}</h6></td>
                <td><a href="{{ route('edit-user',[$user->id]) }}" class="link"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="{{ route('delete-user',[$user->id]) }}" class="link" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><button type="button" class="btn btn-danger">Delete</button></a></td>
            </tr>
        @endforeach
        </tbody>
      </table>
        <div class="clearfix pd-30">
            <div class="pull-left">
                {!! $users->links() !!} 
            </div>
        </div>

@endsection

