<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SaveUserRequest;
use App\Models\Family;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->all();

        $query = User::query();

        if (!empty($inputs['family_id'])) {
            $query->where('family_id', $inputs['family_id']);
        }

        if (!empty($inputs['keyword'])) {
            $query->where(function($query) use($inputs) {
                $query->orWhere('name', 'like', "%" . $inputs['keyword'] . "%")
                ->orWhere('email', 'like', "%" . $inputs['keyword'] . "%")
                ->orWhere('phone', 'like', "%" . $inputs['keyword'] . "%");
            });

        }

        $userPaginate = $query->paginate(5);

        return view('users.index', [
            'userPaginate' => $userPaginate,
            'families' => Family::all()
        ]);
    }

    public function create()
    {
        return view('users.form', [
            'families' => Family::all(),
        ]);
    }

    public function store(SaveUserRequest $request)
    {
        $inputs =$request->all();

        $inputs['password'] = bcrypt($request->password);
        $inputs['type'] = User::TYPE['admin'];

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }

        User::create($request->all());

    }

    public function edit($id)
    {
        return view('users.form', [
            'user' => User::find($id),
            'families' => Family::all(),
        ]);
    }


    public function update(SaveUserRequest $request, $id)
    {
        // dd($request->all());
        $inputs = array_filter($request->all());

        if($request->password) {
            $inputs['password'] = bcrypt($request->password);
        }

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }

        User::find($id)->update($inputs);

        return to_route('user.index');
    }
}
