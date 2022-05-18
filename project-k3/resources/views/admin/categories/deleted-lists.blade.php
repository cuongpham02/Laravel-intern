@extends('index')
@section('title')
    List Categories
@endsection

@section('sidebar')
    @parent
@endsection

@section('content') 
    <h1>Deleted lists Category</h1>
    {{-- <a href="{{ route('create-user') }}" class="btn btn-primary">Create user</a> --}}
    <table class="table">
        <thead>
           <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">DESC</th>
                <th scope="col"></th>
                <th scope="col"></th>
           </tr>
        </thead>
        <tbody>
            @foreach ($categorySoftDeletes as $category)
            <tr>
               <td>{{ $category->id }}</td>
               <td>{{ $category->name }}</td>
               <td>{{ $category->desc }}</td>
               <td><a href="{{ route('restore-category', [$category->id]) }}"><button type="button" class="btn btn-success">Restore</button></a></td>
               <td><a href="{{ route('permanently-category', [$category->id]) }}"><button type="button" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn Category này?')">Permanently deleted</button></a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{-- {{ $categorySoftDeletes->links() }} --}}
@endsection

