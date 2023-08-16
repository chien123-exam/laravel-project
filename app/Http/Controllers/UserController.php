<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' =>User::get()
        ]);
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(SaveUserRequest $request)
    {
        // dd($request->all());
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'address' => $request->address,
        //     'gender' => $request->gender,
        //     'avarta' => null,
        //     'type' => User::TYPE['admin'],
        //     'password' => $request->password,

        // ]);
        $inputs =$request->all();
        $inputs['password'] = bcrypt($request->password);

        User::create($request->all());

    }

    public function edit($id)
    {
        return view('users.form', [
            'user' => User::find($id)
        ]);
    }


    public function update(SaveUserRequest $request, $id)
    {
        $inputs = array_filter($request->all());

        if($request->password) {
            $inputs['password'] = bcrypt($request->password);
        }

        User::find($id)->update($inputs);

        return to_route('user.index');
    }
}
