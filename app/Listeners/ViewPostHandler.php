<?php

namespace App\Listeners;

use App\Events\ViewPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Post;
use Illuminate\Session\Store;

class ViewPostHandler
{

    private $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  ViewPost  $event
     * @return void
     */
    public function handle(ViewPost $event)
    {
        if (isset($event->post))
        {
            $post = $event->post;
            if ( ! $this->isPostViewed($post))
            {
                $post->increment('view_counter');
//                $post->view_counter += 1;

                $this->storePost($post);
            }
        }
    }

    private function isPostViewed($post)
    {
        // Get all the viewed posts from the session. If no
        // entry in the session exists, default to an
        // empty array.
        $viewed = $this->session->get('viewed_posts', []);

        // Check the viewed posts array for the existance
        // of the id of the post
        return array_key_exists($post->id, $viewed);
    }

    private function storePost($post)
    {
        $key = 'viewed_posts.' . $post->id;

        $this->session->put($key, time());
    }
}
