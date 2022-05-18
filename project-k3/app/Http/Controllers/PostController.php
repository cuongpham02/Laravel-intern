<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePosstRequest;
use App\Http\Requests\EditPosstRequest;
use App\Http\Requests\FileImportRequest;
use Auth;
use Illuminate\Support\Str;
use App\Exports\PostExport;
use App\Imports\ImportPost;
use Excel;

class PostController extends Controller
{
    public function list_posts()
    {   

        $posts = Post::orderBy('id','DESC')->paginate(config('constants.PAGINATE_POST'));

        if (Auth::User()->can('viewAny', Post::class)) {
            return view('admin.posts.list-posts', compact('posts'));
        }else {
            return abort(403);
        }
    }

    public function create()
    {   
        $categories = Category::all();
        if (Auth::User()->can('create', Post::class)) {
            return view('admin.posts.create', compact('categories'));
        }else {
            return abort(403);
        }
       
    }

    public function changStatus($id)
    {   
        $post = Post::findOrFail($id);
        $status = $post->status;
        if ($status == 1) {
          $post->status = 0;
          $post->save();
        } else {
          $post->status = 1;
          $post->save();
        }
        return redirect()->back();
    }

    public function store(CreatePosstRequest $request)
    {

       //dd(Post::all()->toArray());
        $post = Post::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'status' => $request->status,
        ]);
        return redirect()->route('list-posts');
    }


    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        if (Auth::User()->can('update', $post)) {               
            return view('admin.posts.edit', compact('post', 'categories'));
        }else{
            return abort(403);
        }
    }

    public function update(EditPosstRequest $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->save();
        return redirect()->route('list-posts');
    }

    public function show($id)
    {   
        $post = Post::find($id);
        if (Auth::User()->can('view', $post)) {
            return view('admin.posts.show', compact('post'));
        }else{
            return abort(403);
        }
        
    }

    public function delete($id)
    {   
        $post = Post::find($id);
        if (Auth::User()->can('delete', $post)) {
            $post->delete();
            return redirect()->route('list-posts'); 
        } else {
            return abort(403);
        }   
    }

        //deleted Posts
        public function deleted()
        {   
            $postSoftDeletes = Post::onlyTrashed()->paginate(config('constants.PAGINATE_POST'));
            return view('admin.posts.deleted-lists', compact('postSoftDeletes'));
        }
    
        public function restore($id)
        {
            $post = Post::onlyTrashed()->find($id);
            if (Auth::User()->can('restore', $post)) {
                $post->restore();
                return redirect()->back();
            }else{
                return abort(403);
            }
            
        }
    
        public function forceDelete($id)
        {       	
            $post = Post::onlyTrashed()->find($id);
            if (Auth::User()->can('forceDelete', $post)) {
                $post->forceDelete(); 
                return redirect()->back();
            }else{
                return abort(403);
            }
           
        }
        public function exportPostCsv($id)
        {

            if (Auth::User()->can('exportPostCsv', Post::class)) {
                return Excel::download(new PostExport($id),'post'.$id.'.csv', \Maatwebsite\Excel\Excel::CSV);
            } else {
                return abort(403);
            }         

           return Excel::download(new PostExport($id),'post'.$id.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }
        public function importPostCsv(FileImportRequest $request)
        {   
            if (Auth::User()->can('importPostCsv', Post::class)) {
                $file = $request->file('file');
                $import = Excel::import(new ImportPost,$file);
                return redirect()->back()->with('message','File Import Successfuly');
            } else {
                return abort(403);
            }
        }
}
