<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $model)
    {
        return view('product.users', ['users' => $model->paginate(15)]);
    }

    public function customers(User $model)
    {
        $customers = User::where('is_admin', '!=,1')->get();
        return view('product.customers', compact('customers'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request,[
            'username'=>'required|string|unique:users',
            'password'=>'required|string',

            'mobile'=>'required',
        ]);
 
        // dd($request->all());

        $user = new User;
        $user->role_id = $request->input('role_id');
        $user->username = $request->input('username');
        $user->mobile = $request->input('mobile');
        $user->password=Hash::make($request->input('password'));
        // dd($request->all());
        $user->save();
        return redirect()->back()->with('message','User created Successfully');

    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
            'username'=>'required|string|',
            'password'=>'required|string',
            'mobile'=>'required',
        ]);
        
        //Update Post
        $user = User::find($id);
        $user->role_id = $request->input('role_id');
        $user->username = $request->input('username');
        $user->mobile = $request->input('mobile');
        $user->password=Hash::make($request->input('password'));
        // dd($request->all());
        $user->save();
        return redirect()->back()->with('message','User Updated Successfully');
    }

    public function destroy($id)
    {
       User::find($id)->delete();
       return redirect()->back()->with('message','User Deleted Successfully');
    
    }
}
 