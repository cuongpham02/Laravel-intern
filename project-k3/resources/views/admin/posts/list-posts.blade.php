@extends('index')
@section('title')
    List Posts
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Posts</h1>
    <a href="{{ route('create-post') }}" class="btn btn-primary">Create Post</a>
    <a style="float:right;" href="{{ route('deleted-posts') }}"class="btn btn-warning">Deleted Lists</a>
    <br>
    <br>
    <div class="float-right">
    <form action="{{ route('import.csv.post') }}" enctype="multipart/form-data" method="POST">
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
        <input type="file" name="file" accept=".csv,.xlsx">
        <input class="btn btn-success float-right" type="submit" name="" value="Import">
        <hr>
    </form> 
    </div>


    <table class="table">
        <thead>
           <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>          
                <th scope="col">Content</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>          
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
           </tr>
        </thead>
        <tbody>
           @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><a href="{{ route('show-post',[$post->id]) }}" class="link">{{ $post->title }}</a></td>
                
                <td>
                    @if(strlen($post->content) > 100)
                        {!! substr($post->content, 0, 100) !!}...
                    @else
                        {{ $post->content }}
                    @endif
                </td>

                <td>{{ $post->category->name }}</td>
                <td>
                    @if($post->status==1)
                        <a class="btn btn-primary" href="{{route('admin.post.status',$post->id)}}">Active</a>
                    @else 
                        <a class="btn btn-danger" href="{{route('admin.post.status',$post->id)}}">UnActive</a>
                    @endif
                </td>
                <td><a href="{{ route('edit-post',[$post->id]) }}" class="link"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="{{ route('delete-post',[$post->id]) }}" class="link" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><button type="button" class="btn btn-danger">Delete</button></a></td>
                <td>
                    <a href="{{ route('export.csv.post',[$post->id]) }}" class="btn btn-dark">Export</a>
                </td>
            </tr>  
           @endforeach
        </tbody>
      </table>
      {{  $posts->links()  }}

@endsection

