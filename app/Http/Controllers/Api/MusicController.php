<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Music;
use App\Models\Section;
use App\User;
use App\Http\Resources\Api\MusicResponse;
use App\Http\Resources\Api\SectionMusicResource;
class MusicController extends Controller
{
    /**
     * $_GET["p"]=="allSounds"
     */
    public function index()
    {
        $sectionMusic = Section::with('music')->get();
        return (new SectionMusicResource($sectionMusic))
                ->response()
                ->setStatusCode(200);
    }

// if($_GET["p"]=="fav_sound")
// insert
    public function favorites(Request $request)
    {
        // make validation here for user_id and sound_id
        $this->validate($request,[
            'fb_id'=>'required',
            'sound_id' => 'required'
         ]);
        $user = User::where('fb_id', $request->fb_id)->first();
        $user->favorites()->attach($request->sound_id);
        $sound = Music::find($request->sound_id);
        $array[] = [
            "id" => $request->sound_id,
            "audio_path" => [
                "mp3" => "a.mp3",
                "acc" => "a.acc",
            ],
            "sound_name" => $sound->name,
            "description" => $sound->description,
            "thum" => $sound->thum,
            "section" => $sound->section->name,
            "created" => "232",
        ];
        // dd($json);
        return response()->json(['msg'=> ["response" => $array]]);

    }


    /**
     * my_FavSound
     */

     public function userFavoriteMusic($userFbId)
     {
        $user = User::with("favorites")->where('fb_id', $userFbId)->first();
        // dd($user);
        return (new MusicResponse($user))->response() ;

     }
}
