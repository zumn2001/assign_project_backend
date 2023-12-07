<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function register(AuthRequest $req)
    {
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;     
        $user->password = Hash::make($req->password);
        $user->save();
        $user->assignRole('admin');
        $token = $user->createToken('project')->plainTextToken;
        return response()->json([
            'data' => ['user' => $user, 'token' => $token],
            'errors' => [],
            'condition' => true
        ]);
    }

    public function login(AuthRequest $req)
    {
            $user = User::where('email', $req->email)->with('roles')->first();
            if ($user) {
                if (Hash::check($req->password, $user->password)) {
                    $token = $user->createToken('project')->plainTextToken;
                    return response()->json([
                        'data' => ['user' => $user, 'token' => $token],
                        'errors' => [],
                        'condition' => true
                    ], 200);
                } else {
                    return $this->errors([], 'Your password is something wrong!');
                }
            } else {
                return $this->errors([] , 'There is no user with this email!');
            }
        }
}
