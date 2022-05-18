@extends('index')
@section('title')
    List Categories
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

    <h1>Categories</h1>
    <a href="{{ route('create-category') }}" class="btn btn-primary">Create category</a>
    <br>
    <a style="float:right;" href="{{ route('deleted-categories') }}"class="btn btn-warning">Deleted Lists</a>
    <table class="table">
        <thead>
           <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>          
                <th scope="col">DESC</th>
                <th scope="col">Status</th>        
                <th scope="col"></th>
                <th scope="col"></th>
           </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td><a href="{{ route('show-category',[$category->id]) }}" class="link">{{ $category->name }}</a></td>
                <td>{{ $category->desc }}</td>
                <td>
                    @if($category->status==1)
                        <a class="btn btn-primary" href="{{route('admin.category.status',$category->id)}}">Active</a>
                    @else 
                        <a class="btn btn-danger" href="{{route('admin.category.status',$category->id)}}">UnActive</a>
                    @endif
                </td>
                
                <td><a href="{{ route('edit-category',[$category->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="{{ route('delete-category',[$category->id]) }}" class="link" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><button type="button" class="btn btn-danger">Delete</button></a></td>
            </tr>
        @endforeach
        </tbody>
      </table>

      {!! $categories->links() !!}

@endsection

