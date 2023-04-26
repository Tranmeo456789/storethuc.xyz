<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\ProductModel;
use App\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //$headers = apache_request_headers(); cua php
        // $token = $headers['token'];
        // trong laravel
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (empty($token)) {
            // return response()->json(
            //     [
            //         'code' => 401,
            //         'message' => "token chua duoc gui tren header"
            //     ],
            //     401
            // );
            $products = ProductModel::select('id', 'name', 'thumbnail', 'price')->get();
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $products
            ], 200);
            
        } elseif (empty($checkTokenIsValid)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token khong hop le"
                ],
                401
            );
        } else {
            $products = ProductModel::select('id', 'name', 'thumbnail', 'price')->get();
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $products
            ], 200);
        }
    }
}
