@extends('index')
@section('title')
    Edit Post
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Edit post</h1>
    <form method="POST" action="{{ route('update-post',[$post->id]) }}">
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
            <input name="title" type="text" class="form-control" id="exampleFormControlInput1" value="{{ $post->title }}">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category</label>
            <select name="category_id" class="form-select" aria-label="Default select example">
                {{-- <option selected value="">{{ $post->category->name }}</option> --}}

              @foreach ($categories as $category)
                <option 
                    @if ($post->category->id == $category->id)
                        {{ 'selected' }}
                    @endif 
                    value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
              </select>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Status</label>
            <select name="status" class="form-select form-select-sm" aria-label=".form-select-sm example">
              <option @if ($post->status == 1) selected @endif value="1">Active</option>
              <option @if ($post->status == 0) selected @endif value="0">Un Active</option>
            </select>
          </div>   

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $post->content }}</textarea>
          </div>   
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection