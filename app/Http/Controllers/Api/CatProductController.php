<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\CatProductModel;
use App\SessionUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatProductController extends Controller
{
    public function list(Request $request)
    {
        $typeGetCat= $request->type;
        if($typeGetCat){
            if($typeGetCat=='all'){
                $catProducts = CatProductModel::select('id', 'name','slug','parent_id')->where('parent_id', 1)->orderBy('id', 'asc')->get();
            }
        }else{
            return response()->json(
                [
                    'code' => 401,
                    'message' => "tham so thieu hoac sai"
                ],
                401
            );
        }
        
        return response()->json([
            'code' => 200,
            'message' => "OK",
            'data' => $catProducts
        ], 200);
    }
    
}
