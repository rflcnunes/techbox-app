<?php

namespace App\Observers;

use App\Models\Post;
use App\Events\PostHistoryEvent;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        Log::info('PostObserver.created', ['post' => $post]);
        event(new PostHistoryEvent($post));
    }
}
