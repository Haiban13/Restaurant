<?php

namespace App\Http\Middleware;

use App\Http\Controllers\orderController;
use App\Models\order;
use App\Models\UserCookie;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckForCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        
        if(!$request->hasCookie('user_session')){
            $cookie=Cookie::make('user_session',uniqid(),90);
            
            $response=$next($request);

            $user_cookie = new UserCookie();
            $user_cookie->cookie=$cookie->getValue();
            $user_cookie->save();
            if ( session("cart") == null) {
                // If not, initialize an empty array
                 session()->put($key="cart",$value=array('user_id'=>$user_cookie->id));
                
            }
            $order=new order();
            $order->user_id=$user_cookie->id;
            $order->save();
            
            return $response->withCookie($cookie);
            
        }
         
        return $next($request);
    }
}
