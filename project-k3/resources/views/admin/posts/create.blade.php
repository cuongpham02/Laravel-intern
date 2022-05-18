@extends('index')
@section('title')
    Create Post
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Create post</h1>

    <form method="POST" action="{{ route('store-post') }}">
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
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category</label>
            <select name="category_id" class="form-select" aria-label="Default select example">
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
              </select>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Status</label>
            <select name="status" class="form-select form-select-sm" aria-label=".form-select-sm example">
              <option selected value="1">Active</option>
              <option value="0">Un Active</option>
            </select>
          </div>   

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>   
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection