<?php

return [
    "MediaTypeServices" => [
        "image" => [
            "extensions" => [
                    "png", "jpg", "jpeg"
            ],
            "handler" => \Nrz\Media\Services\ImageFileService::class
        ],
        "video" => [
            "extensions" =>[
                "avi", "mp4", "mkv"
            ],
            "handler" => \Nrz\Media\Services\VideoFileService::class,
        ],
        "zip" => [
            "extensions" => [
                "zip", "rar", "tar"
            ],
            "handler" => \Nrz\Media\Services\ZipFileService::class
        ],
        "doc" => [
            "extensions" => [
                "pdf", "docx"
            ],
            "handler" => \Nrz\Media\Services\DocFileService::class
        ]
    ]
];
