<?php

namespace App\Http\Middleware;

use App\SessionUser;
use Closure;

class CheckTokenRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (empty($token)){
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header"
                ],
                401
            );
        }else{
            $tokenDeBear = trim($token,'Bearer');
            $tokenDeBear = trim($tokenDeBear,' ');
            $checkTokenIsValid = SessionUser::where('token', $tokenDeBear)->first();
            if(empty($checkTokenIsValid)){
                return response()->json(
                    [
                        'code' => 401,
                        'message' => "token khong hop le",
                    ],
                    401
                );
            }
        }
        
        return $next($request);
    }
}
