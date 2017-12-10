<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/30
 * Time: 21:25
 */

function convert_error_code_to_des($error_code){
    switch ($error_code) {
        case 0:return "ok";
        case 1:return "‘摘自’错误";
        case 2:return "‘作者’错误";
        case 3:return "‘内容’错误";
        case 4:return "未知错误";
        case 5:return "用户信息错误";
        case 6:return "‘类型’错误，请选择正确的下拉选项";
        case 7:return "‘标题’错误";
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


function check_taken_from($taken_from){
    static $taken_from_max_len = 64;
    return core_check($taken_from, $taken_from_max_len);
}

function check_title($title){
    static $title_max_len = 64;
    return core_check($title, $title_max_len);
}

function check_author($author){
    static $author_from_max_len = 32;
    return core_check($author, $author_from_max_len);
}

function check_content($content){
    static $content_from_max_len = 5000;
    return core_check($content, $content_from_max_len);
}

function check_md5($md5){
    static $md5_max_len = 32;
    return core_check($md5, $md5_max_len);
}

?>