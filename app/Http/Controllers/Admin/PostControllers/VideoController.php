<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function seasonCreate(Request $request)
    {
        $season = new Season();
        $season->content = $request->input('contentId');
        $season->number = $request->input('seasonNumber');
        $season->save();
        return $season->id;
    }

    public function seasonRemove(Request $request)
    {
        $season = Season::find($request->seasonId);
        Episode::where("season", $season->id)->delete();
        $contentId = $season->content;
        $season->delete();
        $allSeasons = Season::where("content", $contentId)->get();
        if ($allSeasons->isNotEmpty()) {
            for ($i = 0; $i < $allSeasons->count(); $i++) {
                $allSeasons[$i]->number = $i + 1;
                $allSeasons[$i]->save();
            }
        }
        return 'sucecss';
    }

    public function episodeCreate(Request $request)
    {
        $thisNumber = (Episode::where("season", $request->seasonId)->orderByDesc('id')->first())
            ? Episode::where("season", $request->seasonId)->orderByDesc('id')->first()->number + 1 : 1;
        $episode = new Episode();
        $episode->season = $request->seasonId;
        $episode->number = $thisNumber;
        $episode->save();
        return $episode->id;
    }

    public function episodeRemove(Request $request)
    {
        $episde = Episode::find($request->episodeId);
        $seasonId = $episde->season;
        $episde->delete();
        $allEpisodes = Episode::where("season", $seasonId)->get();
        for ($i = 0; $i < $allEpisodes->count(); $i++) {
            $allEpisodes[$i]->number = $i + 1;
            $allEpisodes[$i]->save();
        }
        return 'succescs';
    }

    public function episodeEdit( Request $request)
    {
        $episode = Episode::find($request->episodeId);
        if($request->startOpening) $episode->start_opening = $request->startOpening;
        if($request->endOpening) $episode->end_opening = $request->endOpening;
        if($request->startFinish) $episode->start_finish = $request->startFinish;
        $episode->save();
        return 123;
        # code...
    }
    //
}
