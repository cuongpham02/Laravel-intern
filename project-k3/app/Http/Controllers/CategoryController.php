<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Session;
class CategoryController extends Controller
{



    public function list_categories() 
    {
        $categories = Category::paginate(config('constants.PAGINATE_CATEGORY'));
        if (Auth::User()->can('viewAny', Category::class)) {        
            return view('admin.categories.list-categories', compact('categories'));
        }else{
            return abort(403);
        }
    }

    public function changStatus($id)
    {
        $category = Category::findOrFail($id);
        $status = $category->status;
        if ($status == 1) {
          $category->status = 0;
          $category->save();
        } else {
          $category->status = 1;
          $category->save();
        }
        return redirect()->back();
    }

    // create
    public function create()
    {
        if (Auth::User()->can('create', Category::class)) {
            return view('admin.categories.create');
        }else{
            return abort(403);
        }
    }
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'desc' => $request->desc,
        ]);
        return redirect()->route('list-categories');
    }

    //update
    public function edit($id)
    {
        $category = Category::find($id);

        if (Auth::User()->can('update', $category)) {        
           
            return view('admin.categories.edit', compact('category'));
        }else{
            return abort(403);
        }
    }
    public function update(EditCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->save();

        return redirect()->route('list-categories');
    }

    //show
    public function show($id)
    {   
        $category = Category::find($id);
        $category_post = Category::find($id)->post;
        if (Auth::User()->can('view', $category)) {
            return view('admin.categories.show', compact('category', 'category_post'));
        }else{
            return abort(403);
        }
        
    }

    //delete
    public function delete($id)
    {   
        $category = Category::find($id);
        if (Auth::User()->can('delete', $category)) {
            if ($category->post->toArray() == null) {
                $category->delete();               
            return redirect()->route('list-categories');
            } else {
                Session::flash('error', 'Không được xóa Category này. Vui lòng xóa hết post');
                return redirect()->back();
            }
        } else {
            return abort(403);
        }   
    }

    //deleted categories
    public function deleted()
    {   
        $categorySoftDeletes = Category::onlyTrashed()->get();
        return view('admin.categories.deleted-lists', compact('categorySoftDeletes'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        if (Auth::User()->can('restore', $category)) {
            $category->restore();
            return redirect()->back();
        }else{
            return abort(403);
        }
        
    }

    public function forceDelete($id)
    {       	
        $category = Category::onlyTrashed()->find($id);
        if (Auth::User()->can('forceDelete', $category)) {
            $category->forceDelete(); 
            return redirect()->back();
        } else {
            return abort(403);
        }
    }

    
}

