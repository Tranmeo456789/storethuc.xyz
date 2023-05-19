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
            $checkTokenIsValid['user_id']=(int)$checkTokenIsValid['user_id'];
            $checkTokenIsValid['total_cart']=(int)$checkTokenIsValid['total_cart'];
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $checkTokenIsValid
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

             $respon['user_id']=$checkTokenIsValid['user_id'];
             $respon['total_cart']=(int)$checkTokenIsValid['total_cart']+1;
            return response()->json([
                'code' => 200,
                'message' => "OK",
                'data' => $respon
            ], 200);
        }
    }
}
