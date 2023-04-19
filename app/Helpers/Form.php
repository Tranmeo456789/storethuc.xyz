<?php

namespace App\Helpers;

class Form
{
    public static function show($elements, $params = array())
    {
        $xhtml = null;
        foreach ($elements as $element) {
            $xhtml .= self::formGroup($element, $params);
        }
        return $xhtml;
    }
    public static function showElement($element, $params = array())
    {
        return self::formGroup($element, $params);
    }
    public static function formGroup($element, $params = array())
    {
        $type = isset($element['type']) ? $element['type'] : "input";
        $widthInput =  isset($element['widthInput']) ? $element['widthInput'] : (isset($params['widthInput']) ? $params['widthInput'] : "col-md-9 col-sm-9 col-xs-12");
        $widthElement = isset($element['widthElement']) ? $element['widthElement'] : "col-12";
        $xhtml = null;
        $imageSelect=isset($element['imageSelect']) ? $element['imageSelect'] : '';
        $styleFormGroup = isset($element['styleFormGroup']) ? $element['styleFormGroup'] : '';
        $start=isset($element['start']) ? $element['start'] : '';
        $linkService = isset($element['linkService']) ? $element['linkService'] : "";
        switch ($type) {
            case 'input':
                $xhtml .= sprintf(
                    "<div class='%s'>
                        <div class='form-group row $styleFormGroup'>
                            %s
                            <div class='%s'>
                                %s
                                <span class='help-block'></span>
                            </div>
                        </div>
                    </div>",
                    $widthElement,
                    $element['label'],
                    $widthInput,
                    $element['element']
                );
                break;
                case 'select':
                    $xhtml .= sprintf(
                        "<div class='%s'>
                            <div class='form-group $styleFormGroup'>
                                %s
                                <div class='%s'>
                                    %s
                                </div>
                            </div>
                        </div>",
                        $widthElement,
                        $element['label'],
                        $widthInput,                    
                        $element['element']
                    );
                    break;
                case 'input-border-radius-blue':
                    $xhtml .= sprintf(
                        "<div class='%s'>
                            <label>%s <span class='text-danger'>$start</span></label>
                            <div class='form-group $styleFormGroup'>                           
                                <div class='wp-input'>
                                    %s                                  
                                </div>
                            </div>
                        </div>",
                        $widthElement, 
                        $element['label'],            
                        $element['element']
                    );
                    break;
            case 'inline':
                $xhtml .= sprintf(
                    "<div class='%s'>
                        <div class='form-group $styleFormGroup'>
                            %s
                            %s
                        </div>
                    </div>",
                    $widthElement,
                    $element['label'],
                    $element['element']
                );
                break;
            case 'input-group-addon-image-before':
                $xhtml = sprintf(
                    "
                    <div class='%s'>
                        <div class='form-group row $styleFormGroup'>
                            %s
                            <div class='%s'>
                                <div class='input-group align-self-center'>
                                    <div class='input-icon'>
                                        <img src='%s'>
                                    </div>
                                    %s
                                </div>
                            </div>
                        </div>
                    </div>",
                    $widthElement,
                    $element['label'],
                    $widthInput,
                    $element['image'],
                    $element['element']
                );
                break;
            case 'input-password':
                $xhtml = sprintf(
                    "
                        <div class='%s'>
                            <div class='form-group row $styleFormGroup'>
                                %s
                                <div class='%s'>
                                    <div class='input-group align-self-center'>
                                        %s
                                        <span class='help-block error-password'></span>
                                        <div class='input-group-append'>
                                            <span class='input-group-text changeTypePassword'><i class='fa fa-eye'></i></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>",
                    $widthElement,
                    $element['label'],
                    $widthInput,
                    $element['element']
                );
                break;
            case 'password-with-image-before':
                $xhtml = sprintf(
                    "
                            <div class='%s'>
                                <div class='form-group row $styleFormGroup'>
                                    %s
                                    <div class='%s'>
                                        <div class='input-group align-self-center'>
                                            <div class='input-group-prepend'>
                                                <span class='input-group-text'><img src='%s'></span>
                                            </div>
                                            %s
                                            <div class='input-group-append'>
                                                <span class='input-group-text changeTypePassword'><i class='fa fa-eye'></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>",
                    $widthElement,
                    $element['label'],
                    $widthInput,
                    $element['image'],
                    $element['element']
                );
                break;
            case 'inline-text-right':
                $xhtml .= sprintf(
                    "<div class='%s'>
                                <div class='form-group text-justify $styleFormGroup d-inline-flex'>
                                    %s
                                    %s
                                </div>
                            </div>",
                    $widthElement,
                    $element['element'],
                    $element['label']
                );
                break;
                case 'input-file-show':
                    $xhtml .= sprintf(
                        "<div class='%s'>
                        <div class='form-group row'>
                            %s
                            <div class='%s'>
                                %s
                                <div class='col-12 col-md-4 mt-1'><img src='%s' id='image-thumbnail' class='border img-fluid'></div>
                            <span class='help-block'></span>
                        </div>
                    </div>
                 </div>",
                    $widthElement,
                    $element['label'],
                    $widthInput,
                    $element['element'],
                    $imageSelect
                );
                    break;
            case 'fileAttachPreview':
                $fileAttach = ($element['fileAttach'] == null) ? null : $element['fileAttach'];
                $xhtml .= sprintf(
                    "<div class='%s'>
                            <div class='form-group row'>
                                %s
                                <div class='%s'>
                                    $fileAttach
                                    %s
                                </div>
                            </div>
                        </div>",
                    $widthElement,
                    $element['label'],
                    $widthInput,
                    $element['element']
                );
                break;
            case 'btn-submit-center':
                $xhtml .= sprintf(
                    '<div class="%s">
                                <div class="form-group d-flex justify-content-center">
                                <div class="%s text-center" >
                                    %s
                                </div>
                            </div>
                        </div>',
                    $widthElement,
                    $widthInput,
                    $element['element']
                );
                break;

            case 'tag-a-link-service':
                $xhtml .= sprintf(
                    '<div class="%s">
                            <a href="%s" target="_blank"><small>Xem trạng thái đơn hàng của dịch vụ</small></a>
                        </div>',
                    $widthElement,
                    $linkService
                    );
                 break;
        }
        return $xhtml;
    }
}
