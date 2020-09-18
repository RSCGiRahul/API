<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * p = get_user_data
     * @param $fbId
     * @return Response
     */
    public function detail($fbId)
    {
        $user = User::where('fb_id',$fbId)->first();
        return response(['msg' => [$user] ]);
    }

    /**
     * edit_profile
     *
     */
    public function update(Request $request)
    {
        $input = $request->only(
            'first_name',
            'last_name',
            'gender',
            'bio',
            'username'
        );
        $user = User::where('fb_id' ,$request->fb_id);
        $user->update(
            $input
        );
        return (new UserResource($user->first()))->response()->setStatusCode(200);
    }

    /**
     *$_GET["p"]=="get_followers"
     */
    public function followers($fbId)
    {
        $user = User::with('follower') ->where('fb_id',$fbId)->first();

        $follow = count($user->follower) ?  1 : 0;
        $follow_status_button = count($user->follower) ?  'Unfollow' : 'Follow';
        $user->unsetRelation('follower');
        return response(['msg' => [[
            $user,
            'follow_status' => [
                'follow' => $follow,
                'follow_status_button' => $follow_status_button,
        ]]] ] );
    }

    /**
     * get_followings
     */
    public function follow($fbId)
    {
        $user = User::with('follow') ->where('fb_id',$fbId)->first();

        $follow = count($user->follower) ?  1 : 0;
        $follow_status_button = count($user->follower) ?  'Unfollow' : 'Follow';
        $user->unsetRelation('follower');
        return response(['msg' => [[
            $user,
            'follow_status' => [
                'follow' => $follow,
                'follow_status_button' => $follow_status_button,
            ]]] ] );
    }

}
