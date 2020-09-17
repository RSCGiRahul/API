<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\User;
use App\Http\Resources\Api\UserResource;
use Illuminate\Support\Facades\Request;
class RegisterController extends Controller
{
    public function signup(SignupRequest $request)
    {     
        $inputs = $request->only(
            'fb_id',
            'profile_pic',
            'version',
            'first_name',
            'last_name',
            'email',
            'bio',
            'gender',
            'device',
            'signup_type',
            'username',
            'password'
        );
      $user = User::firstOrCreate( ['fb_id' => $request->fb_id] , $inputs);    
     return new UserResource($user);
    }


    /**
     * 
     * 
     */
    public function index()
    {
        return 'hello';
    }
}
