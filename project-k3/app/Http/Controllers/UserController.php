<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use App\Http\Requests\CreatUserRequest;
use App\Http\Requests\EditUserRequest;

class UserController extends Controller
{
    public function list_user()
    {   

        $users = User::paginate(config('constants.PAGINATE_USER'));

        if (Auth::User()->can('viewAny', User::class)) {        
            return view('admin.users.list-users', compact('users'));
        }else{
            return abort(403);
        }
    }

    // create
    public function create()
    {
        if (Auth::User()->can('create', User::class)) {
            return view('admin.users.create');
        }else{
            return abort(403);
        }
        
    }

    public function store(CreatUserRequest $request)
    {   
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->pswd),
            'is_role' => $request->role, 
        ]);
        return redirect()->route('list-users');
        
    }

    //edit
    public function edit($id)
    {   
        $user = User::find($id);

        if (Auth::User()->can('update', $user)) {        
           
            return view('admin.users.edit', compact('user'));
        }else{
            return abort(403);
        }

    }
    public function update(EditUserRequest $request, $id)
    {   
        $user = User::find($id);
        $user->name = $request->name;
        $user->is_role = $request->role;
        $user->save();

        return redirect()->route('list-users');
    }

    public function show($id)
    {   
        $user = User::find($id);
        if (Auth::User()->can('view', $user)) {
          
            return view('admin.users.show', compact('user'));
        }else{
            return abort(403);
        }
        
    }

    public function delete($id)
    {
        $user = User::find($id);
        $idUser = Auth::user()->id;
        if($idUser == $id){
            echo 'k được xóa';
        } else {
            if (Auth::User()->can('delete', $user)) {
                $user->delete();
                return redirect()->route('list-users');  
            } else {
                return abort(403);
            }   
        }
        
    }

    //deleted users
    public function deleted()
    {   
        $userSoftDeletes = User::onlyTrashed()->paginate(config('constants.PAGINATE_USER'));
        //dd($userSoftDelete);
        return view('admin.users.deleted-lists', compact('userSoftDeletes'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        if (Auth::User()->can('restore', $user)) {
            $user->restore();
            return redirect()->back();
        }else{
            return abort(403);
        }
       
    }

    public function forceDelete($id)
    {       	
        $user = User::onlyTrashed()->find($id);
        if (Auth::User()->can('forceDelete', $user)) {
            $user->forceDelete(); 
            return redirect()->back();
        }else{
            return abort(403);
        }
        
    }
}
