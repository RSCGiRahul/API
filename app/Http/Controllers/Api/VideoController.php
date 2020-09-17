<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
 
        // https://laracasts.com/discuss/channels/general-discussion/how-do-i-seed-many-to-many-polymorphic-relationships?page=1
       $videos = Video::with(
            'user:id,first_name,last_name,profile_pic,fb_id',
            'music',
            'likes'
            )->paginate(15);
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
            'video.likes',
            'followers'
        )
        ->where('fb_id', $fbId)->get();
        return (  new UserVideosResource( $userVideos) )
                    ->response()
                    ->setStatusCode(200);
    }
    
    /**
     * Post comment
     */
    public function comment(VideoCommentRequest $request)
    {
// https://blog.logrocket.com/polymorphic-relationships-in-laravel/
    $video = Video::findOrFail($request->video_id);
    $input = $request->only('body', 'user_id');   
    $comment = $video->comments()->create( $input);
    return ( new CreateVideoCommentResource( $comment))
            ->response()
            ->setStatusCode(200);

    }

    /**
     * // showVideoComments
     */
    
    public function videoComment($videoId)
    {
        $video = Video::with('comments', 'comments.user:id,first_name,last_name,profile_pic,fb_id')->findOrFail($videoId);
        // dd($video->toArray());
        return new VideoCommentResource($video);
    }

   
}
