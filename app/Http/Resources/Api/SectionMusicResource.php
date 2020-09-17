<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SectionMusicResource extends ResourceCollection
{
    public static $wrap = 'msg';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    // "section_name":"Remix",
    // "sections_sounds":[
    //     {
    //         "id":"2",
    //             "audio_path":
    //                 {
    //                     "mp3":"http:\/\/domain.com\/API\/\/upload\/audio\/2.mp3",
    //                     "acc":"http:\/\/domain.com\/API\/\/upload\/audio\/2.aac"
    //                 },
    //                 "sound_name":"OrignalSong",
    //                 "description":"by hero",
    //                 "section":"Remix",
    //                 "thum":"",
    //                 "created":"2019-05-23 13:31:17"
    //                 },
    public function toArray($request)
    {
        // dd('dfd');
        return $this->collection->transform( function ($section) {
            $sectionsSounds = [];
            $section->music->each( function ($music) use ($section, &$sectionsSounds) {
                $sectionsSounds[] = [
                    "id" =>  $music->id,
                    "audio_path" => [
                        "mp3" => "1.mp3",
                        "acc" => "1.acc",
                    ],
                    "sound_name" => $music ->name,
                    "description" => $music ->description,
                    "section" => $section->name,
                    "thum" => $music->thumb,
                    "created" => "2019-05-23 13:31:17"
                ];
            });
            return [
                'section_name' => $section->name,
                'sections_sounds' => $sectionsSounds
            ];
        });
    }
}
