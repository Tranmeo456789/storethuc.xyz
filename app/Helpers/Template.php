<?php
namespace App\Helpers;
use Config;
use Illuminate\Support\Facades\Auth as Auth;

use Illuminate\Support\Facades\Storage;
class Template {
    public static function showImagePreviewFileManager ($filePath,$fileAlt, $options = array()) {
        $path = '';
        if ($filePath != ''){
            $path = asset("$filePath");
        }else{
            return '';
        }
        $strAttr = '';
        if (isset($options['attr'])){
            foreach($options['attr'] as $key => $attr){
                $strAttr .= " $key ='$attr' ";
            }
        }
        $class = isset($options['class'])?$options['class']:'';
        $xhtml = sprintf("<img class='img-fluid img-thumb' src='%s' alt='%s'  $strAttr />",$path,$fileAlt);
        return $xhtml;
    }
    public static function showTabFilter ($controllerName, $itemsStatusCount, $currentFilterStatus, $params,$column='status') { // $currentFilterStatus active inactive all
        $xhtml = null;
        $tmplStatus = Config::get('myconfig.template.column.' .$column);

        if (count($tmplStatus) > 0) {
            array_unshift($itemsStatusCount , [
                "$column"  => 'all',
                'count'   => array_sum(array_column($itemsStatusCount, 'count'))
            ]);

            $xhtml =  "<ul class='nav nav-tabs bar_tabs'>";
            foreach ($tmplStatus as $keyStatus => $itemStatus) {  // $item = [count,status]
               // $statusValue = $item["$column"];  // active inactive block
                $count = in_array($keyStatus,array_column($itemsStatusCount,$column))?$itemsStatusCount[array_search($keyStatus,array_column($itemsStatusCount,$column))]['count']:0;

                $currentTemplateStatus = $tmplStatus[$keyStatus]; // $value['status'] inactive block active
                $link = route($controllerName) . "?filter_" . $column ."=" .  $keyStatus;
                $paramsSearch = (isset($params['search']))?$params['search']:[];
                $paramsFilter = (isset($params['filter']))?$params['filter']:[];

                if(isset($paramsSearch['value']) && $paramsSearch['value'] !== ''){
                    $link .= "&search_field=" . $paramsSearch['field'] . "&search_value=" .  $paramsSearch['value'];
                }
                if (count($paramsFilter) > 0){
                    foreach($paramsFilter as $keyFilter => $valueFilter) {
                        if ($keyFilter == $column) continue;
                        $link .= "&filter_" . $keyFilter ."=" .  $valueFilter ;
                    }
                }
                $class  = ($currentFilterStatus == $keyStatus) ? 'btn-primary':'';
                //$class = '';
                $xhtml  .= sprintf('<li class="%s">
                                        <a data-href="%s" class="btn btn-filter" role="tab">
                                            %s <span class="badge bg-white ml-1">%s</span>
                                        </a>
                                    </li>',$class , $link,  $currentTemplateStatus['name'], $count);
            }
            $xhtml .= '</ul>';
        }
        return $xhtml;
    }
    public static function showTabFilterAdmin ($controllerName, $itemsStatusCount, $currentFilterStatus, $params,$column='status') { // $currentFilterStatus active inactive all
        $xhtml = null;
        $tmplStatus = Config::get('myconfig.template.column.' .$column);

        if (count($tmplStatus) > 0) {
            array_unshift($itemsStatusCount , [
                "$column"  => 'all',
                'count'   => array_sum(array_column($itemsStatusCount, 'count'))
            ]);

            $xhtml =  "<ul class='nav nav-tabs bar_tabs'>";
            foreach ($tmplStatus as $keyStatus => $itemStatus) { 
                $count = in_array($keyStatus,array_column($itemsStatusCount,$column))?$itemsStatusCount[array_search($keyStatus,array_column($itemsStatusCount,$column))]['count']:0;
                $currentTemplateStatus = $tmplStatus[$keyStatus]; // $value['status'] inactive block active
                $link = route('admin.'.$controllerName.'.list') . "?filter_" . $column ."=" .  $keyStatus;
                $paramsSearch = (isset($params['search']))?$params['search']:[];
                $paramsFilter = (isset($params['filter']))?$params['filter']:[];

                if(isset($paramsSearch['value']) && $paramsSearch['value'] !== ''){
                    $link .= "&search_field=" . $paramsSearch['field'] . "&search_value=" .  $paramsSearch['value'];
                }
                if (count($paramsFilter) > 0){
                    foreach($paramsFilter as $keyFilter => $valueFilter) {
                        if ($keyFilter == $column) continue;
                        $link .= "&filter_" . $keyFilter ."=" .  $valueFilter ;
                    }
                }
                $class  = ($currentFilterStatus == $keyStatus) ? 'btn-primary':'';
                //$class = '';
                $xhtml  .= sprintf('<li class="%s">
                                        <a data-href="%s" class="btn btn-filter" role="tab">
                                            %s <span class="badge bg-white ml-1">%s</span>
                                        </a>
                                    </li>',$class , $link,  $currentTemplateStatus['name'], $count);
            }
            $xhtml .= '</ul>';
        }
        return $xhtml;
    }
    public static function showImageAttachPreview ($controllerName, $fileName, $fileHash, $id,$options = array()) {
        if ($fileName != ''){
            $fileName= explode('|', $fileName);
            $fileHash= explode('|', $fileHash);
        }

        if (is_array($fileName)){
            $xhtml = "<ul class='list-unstyled list-file'>";
            foreach ($fileName as $keyFile => $valFile) {
                $params = ['id'=>$id,'stt'=>$keyFile,'fileName'=>$fileHash[$keyFile]];
                if (isset($options['subFolder'])) $params['subFolder'] = $options['subFolder'];

                $label = $valFile;
                $path = "public/" . config("myconfig.folderUpload.mainFolder") . "/" . $controllerName . "/";
                $filePath = asset($path . $fileHash[$keyFile]);
                $xhtml .= sprintf("<li>
                                    <img src='%s' class='img-fuild' style='margin-top:5px; max-height:100px;'>
                                    <span class='float-right'>
                                    ",$filePath);

                if (isset($options['btn']) && ($options['btn'] == 'delete')){
                    $xhtml .= sprintf("<a href='javascript:void(0)' data-toggle='tooltip' data-placement='top'
                                        data-original-title='Xóa bỏ: {$label}'
                                        data-href='{$fileHash[$keyFile]}'
                                        class='btn btn-danger btn-sm'
                                        name='btnDeleteFile'  id='btnDeleteFile'>
                                        <i class='fa fa-trash'></i>
                                    </a>");
                }
                $xhtml .= '</span></li>';
            }
            $xhtml .= '</ul>';
            return $xhtml;
        }
    }
    public static function showNestedSetName($name,$level){
        $xhtml = str_repeat(config("myconfig.template.char_level"),$level-1);
        $xhtml  .=  "<strong>$name</strong>";
        return $xhtml;
    }
    public static function showNestedSetUpDown($controllerName,$id,$item){
        $upButton = sprintf('
            <a href="%s" type="button" class="btn btn-primary btn-sm mb-0" data-toggle="tooltip" title="" data-original-title="Lên">
                <i class="fas fa-arrow-up"></i>
            </a>',route("$controllerName.move",['id'=>$id,'type'=>'up']));

        $downButton = sprintf('
            <a href="%s" type="button" class="btn btn-primary btn-sm mb-0" data-toggle="tooltip" title="" data-original-title="Xuống">
                <i class="fas fa-arrow-down"></i>
            </a>',route("$controllerName.move",['id'=>$id,'type'=>'down']));

        if (empty($item->getPrevSibling()) || empty($item->getPrevSibling()->parent_id)) $upButton = '';
        if (empty($item->getNextSibling())) $downButton='';

        $xhtml = '
            <span style="width:36px;display:inline-block;float:left">' . $upButton . '</span>
            <span style="width:36px;display:inline-block;float:right">' . $downButton . '</span>';
        return $xhtml;
    }
    public static function createFileManager($name,$filePath='',$params=[]){
        $btn = 'btn-' . $name;
        $thumb = $name . '-thumb';
        $src = ($filePath)?asset($filePath):'';

        $xhtml = "
            <div class='input-group'>
                <span class='input-group-btn'>
                    <a id='$btn' data-input='$name' data-preview='$thumb' class='btn btn-primary'>
                        <i class='fa fa-picture-o'></i> Chọn ảnh
                    </a>
                </span>
                <input id='$name' class='form-control' name='$name' type='hidden' value='$filePath'>
            </div>
            <img id='$thumb' style='margin-top:15px;max-height:100px;' src='$src'>
        ";
        return $xhtml;
    }
    public static function showImagePreview ($controllerName, $fileName,$fileAlt,$options = array()) {
        if (isset($options['subFolderUpload'])){
            $fileName = $options['subFolderUpload']. '/' . $fileName;
        }
        $folderUpload = Config::get('myconfig.folderUpload.mainFolder') ;
        $link = asset("public/$folderUpload/$controllerName/$fileName");
        $strAttr = '';
        if (isset($options['attr'])){
            foreach($options['attr'] as $key => $attr){
                $strAttr .= " $key ='$attr' ";
            }
        }
        $class = isset($options['class'])?$options['class']:'';
        $xhtml = sprintf("<img src='%s' alt='%s'  $strAttr />",$link,$fileAlt);
        return $xhtml;
    }
    public static function showAreaSearch ($controllerName, $paramsSearch) {
        $xhtml = null;
        $tmplField         = config('myconfig.template.search');
        $fieldInController = config('myconfig.config.search');
        $controllerName = (array_key_exists($controllerName, $fieldInController)) ? $controllerName : 'default';
        $xhtmlField = null;

        foreach($fieldInController[$controllerName] as $field)  {// all id
            $xhtmlField .= sprintf('<a href="#" class="select-field dropdown-item" data-field="%s">%s</a>', $field, $tmplField[$field]['name']);
        }
        if (count($fieldInController[$controllerName]) == 1){
            $searchField = $fieldInController[$controllerName][0];
        }else{
            $searchField = (in_array($paramsSearch['field'],$fieldInController[$controllerName] )) ? $paramsSearch['field'] : "all";
        }
        $xhtml = sprintf('
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-info dropdown-toggle btn-active-field" data-toggle="dropdown">
                            %s
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            %s
                        </div>
                    </div>
                    <input type="text" name="search_value" value="%s" class="form-control" >
                    <input type="hidden" name="search_field" value="%s">
                    <div class="input-group-prepend">
                        <button id="btn-clear-search" type="button" class="btn btn-danger" style="margin-right: 0px"><i class="fa fa-times" aria-hidden="true"></i></button>
                        <button id="btn-search" type="button" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>',$tmplField[$searchField]['name'], $xhtmlField, $paramsSearch['value'],$searchField
        );
        return $xhtml;
    }
}
