<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;





class LoginController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
      return [
      new Middleware('auth.basic.once'),
      ];
    }

    public function login()
    {
        $accessTokenResult = Auth::user()->createToken('Access Token');
    
        
        $accessToken = $accessTokenResult->accessToken;
    
        return response(['User' => new UserResource(Auth::user()), 'Access Token' => $accessToken]);
    }
    

    

}
