<?php

namespace Yatin\FullCalendar\Http\Middleware;

use Yatin\FullCalendar\FullCalendar;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(FullCalendar::class)->authorize($request) ? $next($request) : abort(403);
    }
}
