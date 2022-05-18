@extends('index')
@section('title')
    Show users 
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Show</h1>
   
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name:</label><br>
            {{ $user->name }}
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address:</label><br>
          {{ $user->email }}
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Address:</label><br>

        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Phone:</label><br>

        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">ID:</label><br>

        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Avatar:</label><br>

        </div>


@endsection