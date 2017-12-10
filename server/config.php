<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/9
 * Time: 11:52
 */


function is_use_local_config(){
    return true;
}

function get_mysql_host(){
    if(is_use_local_config())
        return "localhost";
    else
       return "192.168.1.188";
}

function get_redis_host(){
    if(is_use_local_config())
        return "127.0.0.1";
    else
        return "192.168.1.188";
}


function get_mysqlcon_usercenter(){
    return new mysqli(get_mysql_host(), 'user_center', 'SAS24234#ajf3', 'user_center');
}

function get_mysqlcon_xinlulicheng(){
    return new mysqli(get_mysql_host(), 'xin_lu_li_cheng', 'Adf@jghj_ds31df', 'xin_lu_li_cheng');
}

function get_mysqlcon_dailysentence(){
    return new mysqli(get_mysql_host(), 'daily_sentence', 'D4ddfs#s1S4f', 'daily_sentence');
}

function get_mysql_con($db_name){
    @ $db = null;

    if($db_name == "user_center")
        $db = get_mysqlcon_usercenter();
    elseif ($db_name == "xin_lu_li_cheng")
        $db = get_mysqlcon_xinlulicheng();
    elseif ($db_name == "daily_sentence")
        $db = get_mysqlcon_dailysentence();

    $code = mysqli_connect_errno();
    if($code){
        error_log(sprintf("mysql connect fail. error code: %d, %s", $code, mysqli_connect_error()));
        return null;
    }

    mysqli_set_charset($db, "utf8");
    return $db;
}

function get_redis_con(){
    $redis = new redis();
    if(!boolval($redis->connect(get_redis_host(), 6379))){
        error_log($redis->getLastError());
        return null;
    }
    if(!$redis->auth("fg45@dfD45F64#fg")){
        error_log($redis->getLastError());
        $redis->close();
        return null;
    }

    return $redis;
}

?>