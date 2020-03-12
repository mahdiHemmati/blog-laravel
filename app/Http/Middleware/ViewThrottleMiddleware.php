<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class ViewThrottleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        $posts = $this->getViewedPosts();

        if ( ! is_null($posts))
        {
            $posts = $this->cleanExpiredViews($posts);

            $this->storePosts($posts);
        }

        return $next($request);
    }

    private function getViewedPosts()
    {
        return $this->session->get('viewed_posts', null);
    }

    private function cleanExpiredViews($posts)
    {
        $time = time();

        $throttleTime = 3600;


        return array_filter($posts, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storePosts($posts)
    {
        $this->session->put('viewed_posts', $posts);
    }


}
