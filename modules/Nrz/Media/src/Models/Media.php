<?php

namespace Nrz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\Media\Services\MediaFileService;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        'files',
        'type',
        'filename',
        'is_private',
        "subDir"
    ];

    protected $casts =[
      "files"=>"json"
    ];

    protected static function booted()
    {
        static::deleting(function ($media) {
            MediaFileService::delete($media);
        });
    }
}
