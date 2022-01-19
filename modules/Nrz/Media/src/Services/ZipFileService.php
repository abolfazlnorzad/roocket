<?php


namespace Nrz\Media\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Nrz\Media\Contracts\FileServiceContract;

class ZipFileService extends DefaultFileService implements FileServiceContract
{

    public static function upload(UploadedFile $file, string $filename, string $dir): array
    {
        Storage::putFileAs($dir, $file, $filename . "." . $file->getClientOriginalExtension());
        return ['original' => $filename . "." . $file->getClientOriginalExtension()];
    }
}
