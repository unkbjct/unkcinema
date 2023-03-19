<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Episode;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class HelpController extends Controller
{
    public function uploadLargeFiles(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file

            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $contentTitle = str_replace(" ", "-", Content::find($request->contentId)->title_eng);

            $finalPath = storage_path("app/public/contents/" . $contentTitle . "/");

            $file->move($finalPath, $fileName);
            if ($request->isVideo == 'true') {
                $video = Video::where("content", $request->contentId)->first();
                if ($video) {
                    $video->url = "public/storage/contents/" . $contentTitle . "/" . $fileName;
                    $video->save();
                } else {
                    $video = new Video();
                    $video->content = $request->contentId;
                    $video->url = "public/storage/contents/" . $contentTitle . "/" . $fileName;
                    $video->save();
                }
            } else {
                Log::debug($request->isVideo);
                $episode = Episode::find($request->episodeId);
                $episode->url = "public/storage/contents/" . $contentTitle . "/" . $fileName;
                $episode->save();
            }

            // if (file_exists($file->getPathname())) unlink($file->getPathname());
            return [
                'path' => asset('public/storage/contents/' . $contentTitle . "/" . $fileName),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
