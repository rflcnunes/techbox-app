<?php

namespace App\Listeners;

use App\Events\PostHistoryEvent;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Enums\PostActions;

class StorePostHistoryListener
{

    private $postRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostHistoryEvent  $event
     * @return void
     */
    public function handle(PostHistoryEvent $event)
    {
        $post = $event->post->id;

        $post_details = $this->postRepository->getById($post);

        Log::info($post_details);
    
        $options = [
            PostActions::CreatedPost,
            PostActions::UpdatedPost,
            PostActions::DeletedPost,
            PostActions::CustomAction,
        ];

        $option = $options[array_rand($options)];


        DB::table('post_history')->insert([
            'post_id' => $post_details->id,
            'action' => $option,
            'date' => Carbon::now()
        ]);
    }
}
