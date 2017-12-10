<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/11/13
 * Time: 20:14
 */

require_once "../server/config.php";

/*
 * \return array
 */
function get_user_info_from_redis($md5){
    $redis = get_redis_con();
    if(!$redis){
        return null;
    }

    $tmp = $redis->get($md5);
    if(!$tmp){
        return null;
    }

    $tmp_array = json_decode($tmp);
    $redis->close();
    return $tmp_array;
}

function get_user_id($md5){
    $tmp = get_user_info_from_redis($md5);
    if(!$tmp){
        return null;
    }
    return $tmp->id;
}

?>