<?php


namespace Nrz\Media\Services;


use Illuminate\Support\Facades\Storage;
use Nrz\Media\Contracts\FileServiceContract;

class ImageFileService extends DefaultFileService implements FileServiceContract
{

    public static function upload($file, $filename, $dir): array
    {
        Storage::putFileAs($dir, $file, $filename . "." . $file->getClientOriginalExtension());
        return ['original' => $filename . "." . $file->getClientOriginalExtension()];
    }

//    public static function getFilename()
//    {
//        return (static::$media->is_private
//                ? 'private/' . static::$media->subDir . "/"
//                : 'public/' . static::$media->subDir . "/")
//            . static::$media->files['original'];
//    }



}
