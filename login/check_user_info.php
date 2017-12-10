<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/22
 * Time: 11:45
 *
 * @param $error_code
 * 0: ok
 * 1: user_name error
 * 2: user_pwd error
 * 3: db error
 * 4: 不存在的项
 * 5: 不存在的用户
 *
 * @return string
 */

function convert_error_code_to_des($error_code){
    switch ($error_code) {
        case 0:return "ok";
        case 1:return "用户名错误";
        case 2:return "密码错误";
        case 3:return "内部错误";
        case 4:return "用户名或密码错误";
        case 5:return "用户不存在";
        case 6:return "邮箱不正确";
        case 7:return "邀请码不正确";
        case 8:return "昵称不正确";
        case 9:return "用户已存在";
        case 10:return "创建账户成功但是使用邀请码失败";
    }
    return "unknown error code";
}

function check_email($email){
    if(preg_match("/(^[0-9a-zA-Z_.+-]+)@([a-zA-Z_-]+).([a-zA-Z]{2,4}$)/i", $email)){
        //这是一个邮箱
        return true;
    }
    return false;
}

function check_user_info($user_name, $user_pwd){
    if(!preg_match("/^[a-zA-Z][a-zA-Z0-9_]{3,12}$/", $user_name)){return 1;}
    if(!preg_match("/^[a-zA-Z0-9!@#$%^&*()_+=-]{6,12}$/", $user_pwd)){return 2;}
    return 0;
}

function check_invite_code($invite_code){
    if(preg_match("/^[a-zA-Z0-9!@#$%^&*()_+=-]{5,5}$/", $invite_code)){
        return true;
    }
    return false;
}

/**
 * @param $ip
 * @return bool true表示ip正确
 */
function check_ip_is_valid($ip){
    if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',$ip)) {
        return true;
    } else {
        return false;
    }
}


/**
 * @param $is bool字符串或者数字
 * @return bool true是字符串形式"true"或者!=0的数字
 */
function check_bool($is){
    if(gettype($is) == "integer" && $is != 0){return true;}

    $tmp = trim($is);
    if(strcmp($tmp, "true") == 0 ||
        (is_numeric($is) && intval($is) != 0)){
        return true;
    }

    return false;
}


?>