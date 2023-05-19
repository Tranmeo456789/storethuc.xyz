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
        //$token = $request->header('token');
        $token = $request->header('Authorization');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (empty($token)) {
            $data = [
                [
                    "id" => 1,
                    "name" => 'token chua duoc gui tren header',
                    "price" => 1,
                    "thumbnail" => 'token chua duoc gui tren header'
                ]
            ];
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header",
                    'data'=> $data
                ],
                401
            );
            // $products = ProductModel::select('id', 'name', 'thumbnail', 'price')->limit(1)->get();
            // foreach($products as $k=>$item){
            //     $products[$k]['price']=(int)$item['price'];
            // }
            // return response()->json([
            //     'code' => 200,
            //     'message' => "OK",
            //     'data' => $products
            // ], 200);
            
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
            $products = ProductModel::select('id', 'name', 'thumbnail', 'price')->limit(2)->get();
            foreach($products as $k=>$item){
                $products[$k]['id']=(int)$item['id'];
                $products[$k]['price']=(int)$item['price'];
                $products[$k]['quantity'] = 1;
            }
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $products
            ], 200);
        }
    }
}
