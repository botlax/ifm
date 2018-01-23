<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Auth;
use App\Admin;
use App\Logs;
use Carbon\Carbon;

class AdminController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('intranet');
        $this->middleware('auth');
        $this->middleware('spectator');
        $this->middleware('god')->only(['admins']);
    }

    public function password(){
    	return view('dashboard.password');
    }

    public function changePassword(Request $request){
    	$this->validate($request,[
            'old_password' => 'required|required_with:new_password',
            'new_password' => 'required|confirmed'
        ]);

        if(Hash::check($request->input('old_password'),Auth::user()->password)){
           Auth::user()->password = bcrypt($request->input('new_password'));
           Auth::user()->save();

            flash('Successfully updated!')->success();
        }
        else{
            flash("Old Password incorrect!")->error();
        }

        return redirect()->back();
    }

    public function admins(){
    	$admins = Admin::whereNotIn('id',[Auth::user()->id])->get();
       	return view('dashboard.admins',compact('admins'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'role' => 'required',
    		'name' => 'required',
            'email' => 'required|email|unique:admins',
    		'password' => 'required|confirmed|min:6'
    	]);

        $data = [];
        $data['role'] = $request->input('role');
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['password'] = bcrypt($request->input('password'));
    	
        Admin::create($data);

    	flash('Successfully added!')->success();

    	return redirect()->back();
    }

    public function edit($id){
    	$admin = Admin::findOrFail($id);
    	return view('dashboard.admin-edit',compact('admin'));
    }

    public function update(Request $request,$id){
        $emp = Admin::findOrFail($id);

    	$this->validate($request,[
    		'role' => 'required',
    		'name' => 'required',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($emp->id)],
    		'old_password' => 'required_with:new_password',
    		'new_password' => 'nullable|confirmed|min:6'
    	]);

    	
    	$emp->role = $request->input('role');
    	$emp->name = $request->input('name');
        $emp->email = $request->input('email');
    	
    	if($request->input('old_password')){
    		if(Hash::check($request->input('old_password'),$emp->password)){
	          	$emp->password = bcrypt($request->input('new_password'));
	        }
    	}

    	$emp->save();
    	flash('Successfully updated!')->success();

    	return redirect()->back();
    }

    public function delete($id){
    	Admin::destroy($id);

    	flash('Successfully deleted!')->success();
    	return redirect()->back();
    }
}
