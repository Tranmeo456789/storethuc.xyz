<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\ProductModel;
use App\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function count(Request $request)
    {
        $token = $request->header('Authorization');
        $checkTokenIsValid = SessionUser::where('token', $token)->first()->toArray();
        if (empty($token)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header"
                ],
                401
            );
        } elseif (empty($checkTokenIsValid)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token khong hop le"
                ],
                401
            );
        } else {
            unset($checkTokenIsValid['refresh_token'], $checkTokenIsValid['token_expried'],$checkTokenIsValid['refresh_token_expried'],$checkTokenIsValid['info_product'],$checkTokenIsValid['id'],$checkTokenIsValid['token'],$checkTokenIsValid['created_at'],$checkTokenIsValid['updated_at']);
            $respon['user_id']=strval($checkTokenIsValid['user_id']);
            $respon['total_cart']=(int)$checkTokenIsValid['total_cart'];
            if($respon['total_cart']==0){
                $respon=null;
            }
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $respon
            ], 200);
        }
    }
    public function add(Request $request)
    {
        $token = $request->header('Authorization');
        $checkTokenIsValid = SessionUser::where('token', $token)->first()->toArray();
        if (empty($token)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header"
                ],
                401
            );
        } elseif (empty($checkTokenIsValid)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token khong hop le"
                ],
                401
            );
        } else {
            $productAdd = $request->product;
            $productAddStr=json_encode($productAdd);
            $productAddAr = json_decode($productAddStr, true);
            
            if(empty($checkTokenIsValid['info_product'])){
                $productOfUser=null;
            }else{
                $productOfUser = json_decode($checkTokenIsValid['info_product'], true);
            }
            if(empty($productOfUser)){
                $productOfUser[]=$productAddAr;
            }else{
                $checkExitProduct = false;
                foreach($productOfUser as $k=>$val){
                    if((int)$val['id'] == (int)$productAddAr['id']){
                        $productOfUser[$k]['quantity']++;
                        $checkExitProduct = true;
                    }
                }
                if(!$checkExitProduct){
                    $productOfUser[]=$productAddAr;
                }
            }
            $productOfUserStr = json_encode($productOfUser);
            $userSession = SessionUser::where('token',$token)->update([
                                'info_product'=>$productOfUserStr,
                                'total_cart'=>(int)$checkTokenIsValid['total_cart'] + 1
                            ]);
             $checkTokenIsValid['total_cart']=(int)$checkTokenIsValid['total_cart'];

             $respon['user_id']=strval($checkTokenIsValid['user_id']);
             $respon['total_cart']=(int)$checkTokenIsValid['total_cart']+1;
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $respon
            ], 200);
        }
    }
    public function detail(Request $request)
    {
        $token = $request->header('Authorization');
        $checkTokenIsValid = SessionUser::where('token', $token)->first()->toArray();
        if (empty($token)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header"
                ],
                401
            );
        } elseif (empty($checkTokenIsValid)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token khong hop le"
                ],
                401
            );
        } else {
           // $respon['user_id']=(int)$checkTokenIsValid['user_id'];
           
            $respon['total']=0;
            $respon['items']=json_decode($checkTokenIsValid['info_product'], true);
            foreach($respon['items'] as $val){
                $respon['total']+=((double)$val['price']*$val['quantity']);
            }
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $respon
            ], 200);
        }
    }
    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $checkTokenIsValid = SessionUser::where('token', $token)->first()->toArray();
        if (empty($token)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header"
                ],
                401
            );
        } elseif (empty($checkTokenIsValid)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token khong hop le"
                ],
                401
            );
        } else {
            $productId = (int)$request->productId;
            $quantity = (int)$request->quantity;
            $listProductArr = json_decode($checkTokenIsValid['info_product'], true);
            $totalCart=0;
            $respon['total']=0;
            foreach($listProductArr as $k=>$val){
                if($productId==(int)$val['id']){
                    $listProductArr[$k]['quantity']=$quantity;
                    $totalCart+=$quantity;
                    $respon['total']=((double)$val['price']*$quantity);
                }else{
                    $totalCart+=(int)$val['quantity'];
                    $respon['total']=((double)$val['price']*$val['quantity']);
                }
            }
            $listProductStr=json_encode($listProductArr);
            $userSession = SessionUser::where('token',$token)->update([
                'info_product'=>$listProductStr,
                'total_cart'=>(int)$totalCart
            ]);
            $respon['items']=json_decode($listProductStr, true);
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $respon
            ], 200);
        }
    }
    public function confirm(Request $request)
    {
        $token = $request->header('Authorization');
        $checkTokenIsValid = SessionUser::where('token', $token)->first()->toArray();
        if (empty($token)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token chua duoc gui tren header"
                ],
                401
            );
        } elseif (empty($checkTokenIsValid)) {
            return response()->json(
                [
                    'code' => 401,
                    'message' => "token khong hop le"
                ],
                401
            );
        } else {
            
            $userSession = SessionUser::where('token',$token)->update([
                'info_product'=>'',
                'total_cart'=>(int)0
            ]);
            // $respon['items']=[];
            // $respon['total']=null;
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => null
            ], 200);
        }
    }
}
