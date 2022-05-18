@extends('index')
@section('title')
    Edit Category
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Edit category</h1>

    <form method="POST" action="{{ route('update-category',[$category->id]) }}">
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
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" value="{{ $category->name }}">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descriptions</label>
            <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $category->desc }}</textarea>
          </div>

       
        
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection