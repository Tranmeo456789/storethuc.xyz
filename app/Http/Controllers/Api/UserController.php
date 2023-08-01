<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use App\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function list(Request $request)
    {
        //$headers = apache_request_headers(); cua php
        // $token = $headers['token'];
        // trong laravel
        //$token = $request->header('token');
        $token = $request->header('Authorization');
        $tokenDeBear = trim($token,'Bearer');
        $tokenDeBear = trim($tokenDeBear,' ');
        $checkTokenIsValid = SessionUser::where('token', $tokenDeBear)->first();
        if (empty($token)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header",
                ],
                401
            );
        } elseif (empty($checkTokenIsValid)) {
            $data = [
                [
                    "id" => 1,
                    "name" => 'token khong hop le',
                    "price" => 1,
                    "thumbnail" => 'tokenkhonghople'
                ]
            ];
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token khong hop le",
                    'data' => $data
                ],
                401
            );
        } else {
            $users = UserModel::select('id','name','email','status_user')->get();
            foreach($users as $k=>$user) {
                $nameRole = $user->roleUser->toArray();
                $users[$k]['role'] = $nameRole[0]['display_name']??null;
            }
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $users
            ], 200);
        }
    }
    public function delete(Request $request){
        $params['id'] = $request->idUser;
        UserModel::where('id', $params['id'])->delete();
        return response()->json([
            'code' => 200,
            'message' => "OK",
            'data' => 'xóa thành công user'
        ], 200);

    }
}
