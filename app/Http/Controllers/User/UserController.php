<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{

    public function index()
    {
        $users = User::all();
        return $this->showAll($users , 200);
    }


    public function store(Request $request)
    {
        $rule = ['name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users'
        ];

        $this->validate($request, $rule);
        $data = $request->all();
        $data['password'] = bcrypt($request->get('passowrd'));
        $data['verified'] = User::unverified;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::requar_user;
        $users =User::create($data);
        return $this->showOne($users , 200);


    }


    public function show(User $user , $id )
    {
       // $user = User::findOrFail($id);
        return $this->showOne($user , 200);
    }

    public function update(Request $request, User $user, $id)
    {
       // $user = User::findOrFail($id);
        $rule = [
            'password' => 'min:6|confirmed' ,
            'email' => 'email|unique:users'. $user->id,
            'admin' => 'im:' . User::requar_user . 'or' . User::admin,


        ];
        $this->validate($request, $rule);
        if ($request->has('name')) {
            $user->name = $request->get('name');
        }
        if ($request->has('email') && $user->email != $request->get('email')) {
            $user->verified = User::unverified;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->get('email');
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return $this->errorMassage('only verified user can handel this field ', 409);

            }
            $user->admin = $request->get('admin');

        }
        if(!$user->isDirty()){
            return $this->errorMassage('you need to change your value to update ', 409);
        }
        $user->save();
        return response()->json(['data' => $user], 200);
    }


    public function destroy(User $user )
    {
      //  $user = User::findOrFail($id);
        $user->delete();
        return $this->showOne($user , 200);
    }
}
