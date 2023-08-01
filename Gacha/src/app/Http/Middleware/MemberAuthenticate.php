<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class MemberAuthenticate extends Middleware
{
  protected function redirectTo($request)
  {
    return route('login.index');
  }
}