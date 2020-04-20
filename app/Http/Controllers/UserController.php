<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //User validation rules
        $this->validate($request, [
            'name'             => 'required|string',
            'email'            => 'required|email|unique:users',
            'role'             => 'required',
            'password'         => 'required|min:6',
            'password_confirm' => 'required|same:password'    
        ]);

        //Create User
        $user = User::create([
            'name' => Request('name'),
            'email' => Request('email'),
            'password' => bcrypt(Request('password')),
        ]);

        $user->assignRole(Request('role'));

        return redirect()->route('user.index')->with('success', 'The user has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        //User validation rules
        $this->validate($request, [
            'name'             => 'required|string',
            'email'            => 'required|email|unique:users,email,'.$user->id.',id',
            'role'             => 'required'   
        ]);

        if($user->name != Request('name')) {
            $user->name = Request('name'); 
        }

        if($user->email != Request('email')) {
            $user->email = Request('email'); 
        }

        $user->save();

        if($user->getRoleNames()->first() != Request('role')) {
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole(Request('role'));
        }

        return redirect('/user/'. $user->id . '/edit')->with('success', 'User has been updated!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        //delete reference to this user's role
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->delete();

        return redirect()->route('user.index')->with('delete-msg', 'The user has been delete');

    }
}
