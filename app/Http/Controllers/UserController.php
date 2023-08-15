<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Family;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{
    protected $familyModel;
    protected $userModel;
    protected $profileModel;

    public function __construct(Family $family, User $user, Profile $profile)
    {
        $this->familyModel = $family;
        $this->userModel = $user;
        $this->profileModel = $profile;
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

        $families = $this->familyModel->all();

        return view('users.index', [
            'userPaginate' => $userPaginate,
            'families' => $families,
            'profiles' => Profile::all()
        ]);

    }

    public function create()
    {
        return view('users.form', [
            'families' => Family::all(),
            'profiles' => Profile::all()
        ]);
    }

    public function store(SaveUserRequest $request)
    {
        $inputs = $request->all();

        if($request->password) {
            $inputs['password'] = bcrypt($request->password);
        }

        $inputs['type'] = User::TYPE['admin'];

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }

        $user = $this->userModel->create($inputs);


            $profileData = [
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
                'youtube_url' => $request->youtube_url,
                'zalo_phone' => $request->zalo_phone,
                'other_info' => $request->other_info,
                'user_id' => $user->id
            ];

            $profile = $this->profileModel->create($profileData);


        return to_route('user.index');
    }

    public function edit($id)
    {
        return view('users.form', [
            'user' => $this->userModel->find($id),
            'families' => $this->familyModel->all(),
            'profiles' => $this-> profileModel::all()
        ]);
    }


    public function update(SaveUserRequest $request, $id)
    {
        $inputs = array_filter($request->all());
        $user = $this->userModel->find($id)->update($inputs);

        if ($request->password) {
            $inputs['password'] = bcrypt($request->password);
        }

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }

        $this->userModel->find($id)->update($inputs);

            if ($user->profile) {
                $profileData = [
                    'facebook_url' => $request->facebook_url,
                    'twitter_url' => $request->twitter_url,
                    'youtube_url' => $request->youtube_url,
                    'zalo_phone' => $request->zalo_phone,
                    'other_info' => $request->other_info,
                ];
                $user->profile->update($profileData);
            } else {
                $profileData = [
                    'facebook_url' => $request->facebook_url,
                    'twitter_url' => $request->twitter_url,
                    'youtube_url' => $request->youtube_url,
                    'zalo_phone' => $request->zalo_phone,
                    'other_info' => $request->other_info,
                    'user_id' => $user->id
                ];

                $profile = $this->profileModel->create($profileData);
            }

        return to_route('user.index');
    }

}
