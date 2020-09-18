<?php

namespace App\Http\Resources\Service;

class VideoResourceService
{
    public function __invoke( $videoFlatten )
    {
        if (!$videoFlatten) {
           return [];
        } 
        return [
            'id' => $videoFlatten->id,
            'video' => $videoFlatten->video,
            'thum' => $videoFlatten->thumb,
            'description' => $videoFlatten->description,
            'gif' => $videoFlatten->gif,
            'liked' => $videoFlatten->liked,
            'created' => DateFormatService::dateFormat($videoFlatten->created_at)
        ];
    }
}
