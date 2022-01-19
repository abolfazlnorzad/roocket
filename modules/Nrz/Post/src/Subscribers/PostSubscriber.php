<?php

namespace Nrz\Post\Subscribers;

use Nrz\Post\Events\PostImageDeleteEvent;

class PostSubscriber
{

    public function subscribe($events)
    {
        return [
            PostImageDeleteEvent::class => "handleDeletePostMedia"
        ];
    }

    public function handleDeletePostMedia($event)
    {
        if ($event->post->media) {
            return $event->post->media->delete();
        }
    }

}
