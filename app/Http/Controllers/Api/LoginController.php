<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\SessionUser;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use JWTAuth;
use JWTAuthException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataCheckLogin = [
            "email" => $request->email,
            "password" => $request->password
        ];
        // xac thuc user co tai khoan chua

        if (auth()->attempt($dataCheckLogin)) {
            $checkTokenExit = SessionUser::where('user_id', Auth::id())->select('token', 'user_id')->first();
            if (empty($checkTokenExit)) {
                $credentials = $request->only('email', 'password');
                $token = JWTAuth::claims(['username' => $request->email])->attempt($credentials);
                $userSession = SessionUser::create(
                    [
                        'token' => $token,
                        'refresh_token' => Str::random(40),
                        'token_expried' => date('Y-m-d H:i:s', strtotime('+30 day')),
                        'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+360 day')),
                        'user_id' => (int)Auth::id()
                    ]
                );
                unset($userSession['refresh_token'], $userSession['token_expried'], $userSession['refresh_token_expried']);
            } else {
                $checkTokenExit['user_id'] = (int)$checkTokenExit['user_id'];
                $userSession = $checkTokenExit;
            }
            $userSession['userId'] = $userSession['user_id'];
            unset($userSession['user_id']);
            return response()->json(
                [
                    'code' => 200,
                    'mesage' => 'OK',
                    'data' => $userSession
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'code' => 401,
                    'message' => 'username hoặc pass không đúng'
                ],
                401
            );
        }

        //tao token luu local-store
    }
    public function refreshToken(Request $request)
    {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            if ($checkTokenIsValid->token_expried < time()) {
                $checkTokenIsValid->update([
                    'token' => Str::random((40)),
                    'refresh_token' => Str::random(40),
                    'token_expried' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+360 day'))

                ]);
            }
        }
        $dataSession = SessionUser::find($checkTokenIsValid->id);
        return response()->json([
            'code' => 200,
            'message' => 'refresh token success',
            'data' => $dataSession
        ], 200);
    }
    public function deleteToken(Request $request)
    {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $checkTokenIsValid->delete();
        }

        return response()->json([
            'code' => 200,
            'message' => 'delete token success'
        ], 200);
    }
    public function reactjsReload(Request $request)
    {
        $token = $request->header('Authorization');
        $tokenDeBear = trim($token,'Bearer');
        $tokenDeBear = trim($tokenDeBear,' ');
        $checkTokenIsValid = SessionUser::where('token', $tokenDeBear)->first();
        if (!empty($checkTokenIsValid)) {
            $infoUserLogin = UserModel::where('id', $checkTokenIsValid['user_id'])->first();
            unset($infoUserLogin['password']);
            $infoUserLogin['username']=$infoUserLogin['email'];
            return response()->json(
                [
                    'code' => 200,
                    'info_user' => $infoUserLogin
                ],
                200
            );
        }else{
            return response()->json(
                [
                    'code' => 401,
                    'token'=>$tokenDeBear,
                    'message' => 'token sai'
                ],
                401
            );
        }
    }
}
