@extends('index')
@section('title')
    Show Category
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Show</h1>
    <hr>
    <h3>{{ $category->name }}</h3>
    <p>Descriptions: <br> {{ $category->desc }}</p>

    <h3>Danh sách các bài Posts</h3>
    @foreach ($category_post as $post)
      <a href="{{ route('show-post',$post->id) }}">{{ $post->title }}</a><br>
    @endforeach

@endsection