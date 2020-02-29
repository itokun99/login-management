<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function profile(Request $request) {
        $token = $request->header('token');
        if(!$token) return $this->responseError(NULL, 'Invalid Token');
        $user = $this->findOne(new User, 'token', $token);
        if(!$user) return $this->responseError(NULL, 'Failed!, User not found');
        return $this->responseSuccess($user);
    }
}
