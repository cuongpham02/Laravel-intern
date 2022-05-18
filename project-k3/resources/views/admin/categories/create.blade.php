@extends('index')
@section('title')
    List users
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Create</h1>

    <form method="POST" action="{{ route('store-category') }}">
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
            <label for="exampleFormControlInput1" class="form-label">Name Category</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select name="status" class="form-select" aria-label="Default select example">
                <option selected value="1">Active</option>
                <option value="0">Un Active</option>
              </select>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descriptions</label>
            <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

       
        
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection