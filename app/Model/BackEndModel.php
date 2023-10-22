<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use Session;
use Illuminate\Support\Facades\Auth as Auth;

class BackEndModel extends Model
{
    public $timestamps = false;
    protected $controllerName   = '';
    protected $table            = '';
    protected $folderUpload     = '' ;
    protected $fieldSearchAccepted   = [
      'name'
    ];

    protected $crudNotAccepted = [
        '_token',
    ];

    public function prepareParams($params){
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
    public function setCreatedHistory(&$params){
      $params['created_at']    = date('Y-m-d H:i:s');
      // if(Auth::check()){
      //   $params['created_by'] = Auth::user()->id;
      // }
      
    }
    public function setModifiedHistory(&$params){
      $params['updated_at']    = date('Y-m-d H:i:s');
      // if(Auth::check()){
      //   $params['updated_by'] = Auth::user()->id;
      // }
    }
    public function getMaxCode($params = null, $options = null){
      $member =  DB::table('generated_code')
                    ->select('max_code')
                    ->where('type',$params['type'])
                    ->where('value',$params['value'])
                    ->first();
      if ($member){
          $member_id = $member->max_code + 1;
          DB::table('generated_code')
              ->where('type',$params['type'])
              ->where('value',$params['value'])
              ->update(['max_code' => $member_id]);
      }else{
          $params['max_code'] = 1;
          DB::table('generated_code')
              ->insert($params);
          $member_id = 1;
      }
      return $member_id;
    }
    public function uploadFile($fileObj) {
      if (!is_array($fileObj)){
         $tmpObj[] = $fileObj;
         $fileObj = $tmpObj;
      }
      $arrFileAttach = array();
      $arrFileHash = array();

      if (isset($fileObj[0]) && ($fileObj[0] != '')){
        foreach($fileObj as $fileItem){
          $fileName       = Str::random(10) . '.' . $fileItem->clientExtension();
          $fileItem->move(public_path("fileUpload/" . $this->folderUpload), $fileName );
          $arrFileHash[] = $fileName;
          $name = basename($fileItem->getClientOriginalName(), '.'. $fileItem->getClientOriginalExtension());
          $arrFileAttach[] = Str::slug($name ,'-') . '.' . $fileItem->clientExtension();;
        }
      }
      $arrFileHash = array_filter($arrFileHash);
      $arrFileAttach  = array_filter($arrFileAttach);
      $arrFileHash = (count($arrFileHash) > 0)?implode('|',$arrFileHash):'';
      $arrFileAttach = (count($arrFileAttach) > 0)?implode('|',$arrFileAttach):'';

      return [
        'fileAttach' =>$arrFileAttach,
        'fileHash'  => $arrFileHash
      ];
  }
  public function updateFileUpload($item,&$params,$key=''){
      $fileDel = $params['file-del'];
      $keyAttach = 'fileAttach';
      $keyHash = 'fileHash';
      if ($key != ''){
          $keyAttach = $key;
          $keyHash = $key . 'Hash';
      }
      $fileAttachOld = $item[$keyAttach];
      $fileHashOld   = $item[$keyHash];

      //So sánh File đã xóa với File hiện tại có
      $fileDel       = ($fileDel != '')?explode('|', $fileDel):[];
      $fileAttachOld = ($fileAttachOld!= '')?explode('|', $fileAttachOld):[];
      $fileHashOld   = ($fileHashOld != '')?explode('|', $fileHashOld):[];

      $fileHashOld   = array_diff($fileHashOld,$fileDel);
      $fileAttachOld = array_intersect_key($fileAttachOld,$fileHashOld);
      $fileUpload    = isset($params[$keyAttach])?$params[$keyAttach]:'';

      if ($fileUpload != ''){
          $resultFileUpload     = self::uploadFile($fileUpload);
          $params[$keyAttach] = array_merge($fileAttachOld,explode('|',$resultFileUpload['fileAttach']));
          $params[$keyHash ]   = array_merge($fileHashOld,explode('|',$resultFileUpload['fileHash']));
      }else{
          $params[$keyAttach] = $fileAttachOld;
          $params[$keyHash]   = $fileHashOld;
      }

      $params[$keyAttach] = array_filter($params[$keyAttach]);
      $params[$keyHash] = array_filter($params[$keyHash]);
      $params[$keyAttach] = (count($params[$keyAttach]) > 0)?implode("|",$params[$keyAttach]):'';
      $params[$keyHash] = (count($params[$keyHash]) > 0)?implode("|",$params[$keyHash]):'';
      // foreach($fileDel as $val){
      //   self::deleteFile($val);
      // }
  }
  public function deleteFile($fileName){
    Storage::disk('shop_storage')->delete($this->folderUpload . '/' .$fileName);
  }
}
