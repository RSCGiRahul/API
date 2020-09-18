<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VideoResource extends ResourceCollection
{
    public static $wrap = 'msg';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return ['msg' => $this->collection];
        // // {"code":"200","msg":[
    //     {
    //     "id":"459",
    //     "fb_id":"2116444511990803",
    //     "user_info":
    //      {
    //      "first_name":"Kamijaliya",
    //      "last_name":"Hitesh",
    //      "profile_pic":"https:\/\/graph.facebook.com\/2116444511990803\/picture?width=500&width=500"
    //      },
    //      "count":
    //       {
    //       "like_count":"0",
    //       "video_comment_count":"0"
    //       },
    //       "liked":"0",
    //       "video":"upload\/video\/178179033_789552345.mp4",
    //       "thum":"upload\/thum\/178179033_789552345.jpg",
    //       "gif":"upload\/gif\/178179033_789552345.gif",
    //       "description":"",
    //       "sound":
    //       {
    //       "id":null,
    //       "audio_path":
    //       {
    //        "mp3":"http:\/\/domain.com\/API\/\/upload\/audio\/.mp3",
    //        "acc":"http:\/\/domain.com\/API\/\/upload\/audio\/.aac"
    //      },
    //      "sound_name":null,
    //      "description":null,
    //      "thum":null,
    //      "section":null,
    //      "created":null
    //      },
    //      "created":"2019-08-31 08:42:39"
    //          }
    //         ]
    //    }
    $data =  $this->collection->transform ( function ($data) {
        return [
            "id" => $data->id,
            "fb_id" => $data->user->fb_id,
            'user_info' => $data->user,
            'count' => [
                "like_count" => $data->likeable_count,
                "video_comment_count" => $data->comments_count,
            ],
            "liked" =>  $data->likeable_count,
            "video" => $data->video,
            "thum"=> $data->thum,
            "gif"=> $data->gif,
            "description"=> $data->description,
            "sound" =>  array_merge(
                $data->music ? $data->music->toArray() : []
                ,
                [
                    "audio_path" => [
                        "mp3" => $data->music ? $data->music->id . '.mp3' : null ,
                        "acc" => $data->music ? $data->music->id. '.acc' : null
                    ],
                ]
                ),
            "created_at" => $data->created_at,

         ];
    });
        return  $data;
    }
}
