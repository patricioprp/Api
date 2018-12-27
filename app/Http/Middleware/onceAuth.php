<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;

class onceAuth Implements Middleware{

    protected $auth;

    public function __construct(Guard $auth)
    {
      $thhis->auth =$auth;
    }

    public function handle($request, Closure $next)
    {
     return $this->auth->onceBasic() ?: $nest($request);
    }

}