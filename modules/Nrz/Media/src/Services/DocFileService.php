<?php

namespace Nrz\Media\Services;

use Illuminate\Support\Facades\Storage;
use Nrz\Media\Contracts\FileServiceContract;

class DocFileService extends DefaultFileService implements FileServiceContract
{
    public static function upload($file, $filename, $dir): array
    {
        Storage::putFileAs($dir, $file, $filename . "." . $file->getClientOriginalExtension());
        return ['original' => $filename . "." . $file->getClientOriginalExtension()];
    }
}
