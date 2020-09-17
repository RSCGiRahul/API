<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicResponse extends JsonResource
{
    public static $wrap = "msg";
    // public static $wrap = 'msg';
// 
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this-> favorites);
       $res = $this->favorites->transform( function ($data) {
               return [ 
                "id" => 1,
                "audio_path" => [
                    "map" => "1.mp3",
                    "acc" => "acc.acc"
                ],
                "sound_name" => $data->name,
                "description" => $data->description,
                "section" => \App\Models\Section::find($data->section_id)->name,
                "thum" => $data->thumb,
                "created" => "232",
               
               ];

        });

       return $res->toArray();
    }
}
