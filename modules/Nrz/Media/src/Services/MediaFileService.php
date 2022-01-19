<?php

namespace Nrz\Media\Services;

use Nrz\Media\Contracts\FileServiceContract;
use Nrz\Media\Models\Media;

class MediaFileService
{
    private static $file;
    private static $dir;
    private static $subDir;
    private static $isPrivate;

    public static function privateUpload($file, $subDir)
    {
        self::$subDir = $subDir;
        self::$dir = 'private/' . self::$subDir . "/";
        self::$isPrivate = true;
        self::$file = $file;
        return self::upload();
    }

    public static function publicUpload($file, $subDir)
    {
        self::$subDir = $subDir;
        self::$dir = 'public/' . self::$subDir . "/";
        self::$isPrivate = false;
        self::$file = $file;
        return self::upload();
    }

    public static function upload()
    {
        $extension = self::normalizeExtension(self::$file);
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if (in_array($extension, $service['extensions'])) {
                return self::uploadByHandler($type, new $service['handler']);
            }
        }

    }


    static function stream(Media $media){
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::stream($media);
            }
        }
    }

    public static function delete($media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::delete($media);
            }
        }
    }

    /**
     * @param $file
     * @return string
     */
    protected static function normalizeExtension($file): string
    {
        return strtolower($file->getClientOriginalExtension());
    }

    private static function filenameGenerator(): string
    {
        return uniqid();
    }


    private static function uploadByHandler($key, FileServiceContract $handler): Media
    {
        $media = new Media();
        $media->type = $key;
        $media->user_id = auth()->id() ?? 1;
        $media->files = $handler::upload(self::$file, self::filenameGenerator(), self::$dir);
        $media->filename = self::$file->getClientOriginalName();
        $media->is_private = self::$isPrivate;
        $media->subDir = self::$subDir;
        $media->save();
        return $media;
    }

}
