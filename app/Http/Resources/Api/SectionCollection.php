<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Service\DateFormatService;
use App\Http\Resources\Service\MusicResourceService;
use App\Http\Resources\Service\UserInfoResourceService;
use App\Http\Resources\Service\VideoResourceService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SectionCollection extends ResourceCollection
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
//        dd($this->collection->video);
        // section ---> music --> video --> how many likes in this video


        $msg = $this->collection->transform( function ($data) {
            $videoFlatten = $data->video;
            $userInfo = [];
            $musicInfo = [];
            $videos = [];

        if ($videoFlatten) {
            $Res = $videoFlatten->each( function ($data) use (&$userInfo, &$musicInfo, &$videos) {
                $userInfo[] = (new UserInfoResourceService())($data->user) ;
                $musicInfo[] = (new MusicResourceService())($data->music);
                $videos[] = (new VideoResourceService())($data);
//                $videos[]['like_count'] = optional($data->likeable)->count();

            });

        }
            return [
                "section_name" => $data->name,
                "section_video" =>
                    [
                    $videos  ? array_values($videos) : [],
                    'user_info' => $userInfo ?? [],
                    'sound' => $musicInfo ?? [],
                    "count" => [
                      'like_count' => $data->like_count ?? 0,
                      'video_comment_count' => 2,
                      'view' => 400
                    ],
                ]
    //                'created' => DateFormatService::dateFormat($data->created_at)
            ];

        });
        return [ $msg ];
    }
}
