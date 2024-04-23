<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Support\Str;
use App\Models\Video;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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
            $fileName = Str::slug(str_replace('.' . $extension, '', $file->getClientOriginalName())); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $contentTitle = Content::find($request->contentId)->title_eng;

            $finalPath = storage_path("app/public/contents/" . $contentTitle . "/");

            $file->move($finalPath, $fileName);
            $video = Video::where("content", $request->contentId)->first();
            if (!$video) {
                $video = new Video();
                $video->content = $request->contentId;
            };
            Storage::disk('local')->delete("public/contents/" . $contentTitle . "/" . array_reverse(explode("/", $video->url))[0]);
            $video->url = "public/storage/contents/" . $contentTitle . "/" . $fileName;
            $video->duration = 123;
            $video->extension = $extension;
            $video->save();
            // $qwe = FFMpeg::fromDisk('local')
            //     ->open("public/contents/" . $contentTitle . "/" . $fileName)->getDurationInSeconds();
            $getID3 = new getID3;
            $remotefilename = asset("public/storage/contents/" . $contentTitle . "/" . $fileName);
            if ($fp_remote = fopen($remotefilename, 'rb')) {
                $localtempfilename = tempnam('/tmp', 'getID3');
                if ($fp_local = fopen($localtempfilename, 'wb')) {
                    while ($buffer = fread($fp_remote, 8192)) {
                        fwrite($fp_local, $buffer);
                    }
                    fclose($fp_local);
                    // Initialize getID3 engine
                    $getID3 = new getID3;
                    $ThisFileInfo = $getID3->analyze($localtempfilename);
                    // Delete temporary file
                    Log::debug($ThisFileInfo);
                    unlink($localtempfilename);
                }
                fclose($fp_remote);
            }

            // $qwe = getI::fromDiskAndPath('local', "public/contents/" . $contentTitle . "/" . $fileName);
            // Log::debug(json_encode($qwe->analyze()));
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
