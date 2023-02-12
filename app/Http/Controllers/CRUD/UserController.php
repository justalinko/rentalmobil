<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function profile()
    {
        $data['user'] = auth()->user();
        return view('profile',$data);

    }

    public function index()
    {
        $data['users'] = \App\Models\User::orderBy('id','desc')->get();
        return view('admin.users',$data);
    }
    public function edit($id)
    {
        $data['isEdit'] = true;
        $data['edit'] = \App\Models\User::find($id);
        return view('admin.form.user',$data);
    }

    public function update(Request $request)
    {
        $user = \App\Models\User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect('/admin/users')->with('success','User has been updated');
    }

    public function destroy($id)
    {
        $user = \App\Models\User::find($id);
        $user->delete();
        return redirect('/admin/users')->with('success','User has been deleted');
    }

    public function create()
    {
        $data['isEdit'] = false;
        $data['edit'] = null;
        return view('admin.form.user',$data);
    }

    public function store(Request $request)
    {
        $user = new \App\Models\User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/admin/users')->with('success','User has been created');
    }
}
