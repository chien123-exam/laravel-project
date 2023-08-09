<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SaveUserRequest;
use App\Models\Family;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $familyModel;
    protected $userModel;

    public function __construct(Family $family, User $user)
    {
        $this->familyModel = $family;
        $this->userModel = $user;
    }

    public function index(Request $request)
    {
        $inputs = $request->all();

        $query = $this->userModel->query();

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
        $inputs = $request->all();

        $inputs['password'] = bcrypt($request->password);
        $inputs['type'] = User::TYPE['admin'];

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }

        $this->userModel->create($request->all());
    }

    public function edit($id)
    {
        return view('users.form', [
            'user' => $this->userModel->find($id),
            'families' => $this->familyModel->all(),
        ]);
    }


    public function update(SaveUserRequest $request, $id)
    {
        $inputs = array_filter($request->all());

        if ($request->password) {
            $inputs['password'] = bcrypt($request->password);
        }

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }

        $this->userModel->find($id)->update($inputs);

        return to_route('user.index');
    }
}
