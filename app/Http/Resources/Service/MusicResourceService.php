<?php

namespace App\Http\Resources\Service;

class MusicResourceService
{
   public function __invoke( $data )
   {
    if (!$data) {
      return [];
    }     
     return [
                "id" => $data->id,
                "audio_path" => [
                      "map" => $data->id.".mp3",
                      "acc" => $data->id.".acc"
                ],
                "sound_name" => $data->name,
                "description" => $data->description,
//                "section" => \App\Models\Section::find($data->section_id)->name,
                "thum" => $data->thumb,
                "created" => DateFormatService::dateFormat($data->created_at)
              ];
   }
}
