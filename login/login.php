<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/6
 * Time: 19:14
 */

require_once "../server/config.php";
require_once "check_user_info.php";
require_once "get_user_info.php";


static $select_user_by_email = <<<eof
SELECT t1.*, t2.lev as code_lev
FROM `tb_user` as t1, tb_invite_code as t2
WHERE `user_email` = '%s' and `is_del` = 0 AND t2.account_used = t1.user_email;
eof;

static $select_user_by_name = <<<eof
SELECT *
FROM `tb_user`
WHERE `user_name` = '%s' and `is_del` = 0;
eof;

static $update_last_login_date = <<<eof
UPDATE `tb_user` SET `last_login_date` = now() WHERE `id` = %d;
eof;


function return_val($error_code, $return_v){
    echo json_encode(array('code' => convert_error_code_to_des($error_code)));
    return $return_v;
}

function write_user_info_to_redis($key, $value, $ttl){
    if(gettype($key) != "string" or gettype($value) != "string"){return;}

    $redis = get_redis_con();
    if(!$redis){
        error_log("get redis connection failed.");
        return;
    }

    if(!$redis->set(strval($key), strval($value), $ttl)){
        error_log($redis->getLastError());
    }
    $redis->close();
}

function sqlcmd_get_user_info($user_name, $is_email){
    global $select_user_by_email;
    global $select_user_by_name;
    if($is_email)return sprintf($select_user_by_email, $user_name);
    else return sprintf($select_user_by_name, $user_name);
}

function sqlcmd_update_last_login_date($id){
    global $update_last_login_date;
    return sprintf($update_last_login_date, $id);
}

function login(){
    $user_name = null;
    $user_pwd = null;
    $is_auto_save = null;
    $ip = null;
    $is_email = false;
    $is_use_md5 = false;

    if(isset($_POST["md5"])){
        $tmp_array = get_user_info_from_redis($_POST["md5"]);
        if($tmp_array != null){
            global $user_name, $user_pwd, $is_auto_save, $ip, $is_use_md5;
            $user_name = $tmp_array->user_name;
            $user_pwd = $tmp_array->user_pwd;
            $is_auto_save = isset($_POST["is_auto_save"]) ? $_POST["is_auto_save"] : $tmp_array->is_auto_save == "true";
            $ip = isset($_POST["ip"]) ? $_POST["ip"] : $tmp_array->ip;
            $is_use_md5 = true;
        }
    }

    if(!$is_use_md5){
        if (isset($_POST["user_name"], $_POST["user_pwd"], $_POST["is_auto_save"], $_POST["ip"])){
            global $user_name, $user_pwd, $is_auto_save, $ip;
            $user_name = $_POST["user_name"];
            $user_pwd = $_POST["user_pwd"];
            $is_auto_save = $_POST["is_auto_save"];
            $ip = $_POST["ip"];
        }
        else{
            return return_val(4, 0);
        }
    }

    if(!check_email($user_name)){
        $check_ret = check_user_info($user_name, $user_pwd);
        if($check_ret != 0){
            return return_val($check_ret, 0);
        }
    }

    $db = get_mysql_con("user_center");
    if(!$db){
        return return_val(3, 0);
    }

    $query_cmd = sqlcmd_get_user_info($user_name, $is_email);
    $result = $db->query($query_cmd);
    $row_num = $result->num_rows;

    function release_db_and_return(& $db, & $result, $error_code)
    {
        $result->free();
        $db->close();
        return return_val($error_code, 0);
    }

    if($row_num == 0){
        return release_db_and_return($db, $result, 5);
    }
    if($row_num != 1) {
        return release_db_and_return($db, $result, 3);
    }

    $row = $result->fetch_assoc();
    if($row["user_pwd"] != $user_pwd){
        return release_db_and_return($db, $result, 2);
    }
    $result->free();
    //更新登陆日期
    $db->query(sqlcmd_update_last_login_date( $row['id']));

    //calculate md5
    $row["md5"]=md5($user_name.$row["user_name"]);
    //记录用户的配置
    $row["is_auto_save"]=$is_auto_save;
    //记录客户端的ip
    if(check_ip_is_valid($ip)){$row["ip"]=trim($ip);}
    //write to redis
    write_user_info_to_redis($row["md5"], json_encode($row), $is_auto_save ? 3600 * 24 * 7 : 3600);
    //发给客户端
    $arr = array('code' => "ok", "md5" => $row["md5"], "last_login_date" => $row["last_login_date"],
        "nick_name" => $row["nick_name"]);
    $res = json_encode($arr);

    $db->close();
    echo $res;
}

login();

?>
