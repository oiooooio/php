<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/11/13
 * Time: 20:01
 */

function convert_error_code_to_des($error_code){
    switch ($error_code) {
        case 0:return "ok";
        case 1:return "未知错误";
        case 2:return "内容错误";
    }
    return "unknown error code";
}

function filter($str){
    return strip_tags($str);
}

function core_check($str, $length){
    $tmp = filter($str);
    if(strlen($tmp) > $length){
        return false;
    }
    return true;
}

function check_content($content){
    static $content_from_max_len = 1000;
    return core_check($content, $content_from_max_len);
}



?>