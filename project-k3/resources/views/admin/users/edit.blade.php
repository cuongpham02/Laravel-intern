@extends('index')
@section('title')
    Edit users
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Edit user</h1>
    <form method="POST" action="{{ route('update-user',$user->id) }}">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
        </div>
        @endif
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="name" value="{{ $user->name }}">
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="" aria-describedby="emailHelp" name="email" value="{{ $user->email }}">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Role</label>
          <select name="role" class="form-select form-select-lg mb-3" aria-label=".form-select-sm example">
            @if ($user->is_role == 'admin')
            <option selected value="admin">Admin</option>
            <option value="manager">Manager</option>
            @else
            <option selected value="manager">Manager</option>
            <option value="admin">Admin</option>
            @endif
           
          </select>
        </div>
        <div class="mb-3">
          {{-- <label for="exampleInputPassword1" class="form-label">Password</label> --}}
          {{-- <input type="password" class="form-control" id="" name="pswd" value=""> --}}
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
