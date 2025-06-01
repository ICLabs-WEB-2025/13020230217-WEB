<?php

   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Support\Facades\Log;

   class Admin
   {
       public function handle(Request $request, Closure $next)
       {
           if (Auth::check() && Auth::user()->isAdmin()) {
               return $next($request);
           }
           Log::info('Non-admin attempted admin access: ' . Auth::user()->email);
           return redirect()->route('user.dashboard');
       }
   }