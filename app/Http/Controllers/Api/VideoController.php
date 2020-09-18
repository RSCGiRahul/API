<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserLikedResource;
use App\Models\UserVideoStatus;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Resources\Api\VideoResource;
use App\Http\Resources\Api\UserVideosResource;
use App\Http\Requests\Api\VideoCommentRequest;

use App\Http\Resources\Api\VideoCommentResource;
use App\Http\Resources\Api\CreateVideoCommentResource;


use App\User;
class VideoController extends Controller
{
    public function index()
    {
       $videos = Video::with(
            'user:id,first_name,last_name,profile_pic,fb_id',
            'music',
            'likes'
            )
           ->withCount(['likeable', 'comments'])
           ->paginate(15);
        return (  new VideoResource( $videos) )
                    ->response()
                    ->setStatusCode(200);

    }

    public function userVideos($fbId)
    {

        $userVideos = User
        ::with(
            'video',
            'video.music',
            'video.comments',
            'video.likeable',
            'followers'
        )
        ->where('fb_id', $fbId)->get();
        return (  new UserVideosResource( $userVideos) )
                    ->response()
                    ->setStatusCode(200);
    }


    /**
     * $_GET["p"]=="likeDislikeVideo"
     */
    public function updateVideoStatus($fbId, $videoId, Request $request)
    {
        $status = $request->action;
        $userId = User::where('fb_id', $fbId)->first()->id;
        $video = Video::with('user', 'likeable')->find($videoId);
        if ( $video->likeable->isNotEmpty()) {
            $video->likeable()->delete();
            $msg = "video unlike";

        } else  {
            $video->likeable()
                    ->create([ 'user_id' => $userId ]);
            $msg = "actions success";
        }
        return response(["msg" => $msg ?? '']);
    }

    /**
     * $_GET["p"]=="postComment"
     * Post comment
     */
    public function comment(VideoCommentRequest $request)
    {
        $this->validate($request,[
            'body'=>'required',
            'user_id'=>'required',
            'video_id' => 'required'
         ]);
// https://blog.logrocket.com/polymorphic-relationships-in-laravel/
    $video = Video::findOrFail($request->video_id);
    $input = $request->only('body', 'user_id');
    $comment = $video->comments()->create( $input);
    return ( new CreateVideoCommentResource( $comment))
            ->response()
            ->setStatusCode(200);

    }

    /**
     * $_GET["p"]=="showVideoComments"
     * // showVideoComments
     */

    public function videoComment($videoId)
    {
        $video = Video::with('comments', 'comments.user:id,first_name,last_name,profile_pic,fb_id')->findOrFail($videoId);
        // dd($video->toArray());
        return new VideoCommentResource($video);
    }

    /**
     * $_GET["p"]=="my_liked_video"
     * @param $userId
     */
    public function userLikedVideos($userId)
    {
//      $user =  User::with('likeable','likedVideos', 'likedVideos.music')
//                ->where('fb_id', $userId)->first();
        $user =  User::with('likedVideos', 'commetableVideos')
            ->where('fb_id', $userId)->first();
        return ( new UserLikedResource($user))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * SearchByHashTag
     */
    public function search($searchItem = null)
    {
      $videos =   Video::query()
                    ->inRandomOrder()
                    ->whereLike('description', $searchItem)
                    ->get() ;
      $videos ->load(['user', 'music', 'likes']);
        return (  new VideoResource( $videos) )
            ->response()
            ->setStatusCode(200);
    }

    /**
     * $_GET["p"]=="updateVideoView"
     * post
     */
    public function view(Request $request)
    {
        Video::find($request->id)->increment('view');
        return response(['msg' =>
            [
                array(
                    "response" =>"success"
                )
            ]
        ]);

    }


}
