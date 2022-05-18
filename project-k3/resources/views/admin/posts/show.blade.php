@extends('index')
@section('title')
    Show Post
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Show post</h1>
    <hr>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>

@endsection