<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Content_attribute;
use App\Models\Content_category;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function create(Request $request)
    {
        $image = $request->file('image');
        $path = $image->store('contents/' . str_replace(" ", "-", $request->title_eng) . '/', 'public');
        $content = new Content();
        $content->title_rus = $request->title_rus;
        $content->title_eng = str_replace(" ", "-", $request->title_eng);
        $content->image = 'public/storage/' . $path;
        $content->type = $request->type;
        $content->year = $request->year;
        if ($request->has('description') && $request->description) $content->year = $request->year;
        $content->save();

        if ($request->has("attributes")) {
            foreach ($request->input("attributes") as $id => $value) {
                $newAttr = new Content_attribute();
                $newAttr->content = $content->id;
                $newAttr->attribute = $id;
                $newAttr->value = $value;
                $newAttr->save();
            }
        }

        if ($request->has("categories")) {
            foreach ($request->categories as $category) {
                $newCategory = new Content_category();
                $newCategory->content = $content->id;
                $newCategory->category = $category;
                $newCategory->save();
            }
        }

        // $type = Type::find($request->type);
        // if (!$type->is_one_video) {
        //     if ($request->file("episodes")) {
        //         foreach ($request->file("episodes") as $numberSeason => $episodes) {
        //             $season = new Season();
        //             $season->number = $numberSeason;
        //             $season->content = $content->id;
        //             $season->save();
        //             foreach ($episodes as $episodeNumebr => $file) {
        //                 $newEpisode = new Episode();
        //                 $newEpisode->season = $season->id;
        //                 $newEpisode->number = $episodeNumebr;
        //                 $path = $file->store('contents/' . str_replace(" ", "-", $request->title_eng) . '/', 'public');
        //                 $newEpisode->url = 'public/storage/' . $path;
        //                 $newEpisode->save();
        //             }
        //         }
        //     }
        // } else {
        //     if ($request->file("video")) {
        //         $path = $request->file("video")->store('contents/' . str_replace(" ", "-", $request->title_eng) . '/', 'public');
        //         $video = new Video();
        //         $video->content = $content->id;
        //         $video->url = 'public/storage/' . $path;
        //         $video->save();
        //     }
        // }

        return redirect()->route('admin.contents')->with(['success' => 'Контент создан успешно!']);
    }
}
