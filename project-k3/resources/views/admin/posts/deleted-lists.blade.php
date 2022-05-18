@extends('index')
@section('title')
    List Post
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Deleted lists Posts</h1>
    {{-- <a href="{{ route('create-user') }}" class="btn btn-primary">Create user</a> --}}
    <table class="table">
        <thead>
           <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Category</th>
                <th scope="col"></th>
                <th scope="col"></th>
           </tr>
        </thead>
        <tbody>
            @foreach ($postSoftDeletes as $post)
            <tr>
               <td>{{ $post->id }}</td>
               <td>{{ $post->title }}</td>
               <td>
                @if(strlen($post->content) > 100)
                    {!! substr($post->content, 0, 100) !!}...
                @else
                    {{ $post->content }}
                @endif
            </td>
               <td>{{ $post->category->name }}</td>
               <td><a href="{{ route('restore-post', [$post->id]) }}"><button type="button" class="btn btn-success">Restore</button></a></td>
               <td><a href="{{ route('permanently-post', [$post->id]) }}"><button type="button" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bài post này?')">deleted</button></a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
        {{ $postSoftDeletes->links() }}
@endsection

