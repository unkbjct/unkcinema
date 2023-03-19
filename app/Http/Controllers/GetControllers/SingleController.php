<?php

namespace App\Http\Controllers\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function search()
    {
        $contentsList = Content::where("published", 1)
            ->get();
        // dd($contentsList);
        return view('search', [
            'contentsList' => $contentsList,
        ]);
    }

    public function content(Content $content)
    {
        $content->type = Type::find($content->type);
        if ($content->type->is_one_video) {
            $content->video = Video::where("content", $content->id)->first();
        } else {
            $content->seasons = Season::where("content", $content->id)->get();
            if ($content->seasons->isNotEmpty()) {
                $content->seasons->transform(function ($item) {
                    $item->episodes = Episode::where("season", $item->id)->get();
                    return $item;
                });
            }
            $content->thisSeason = Season::where("content", $content->id)->first();
            $content->thisEpisode = Episode::where("season", $content->thisSeason->id)->first();
        }

        return view('content', [
            'content' => $content,
        ]);
    }

    public function login()
    {
        return view('login');
    }

    function signUp()
    {
        return view('sign-up');
    }
}
