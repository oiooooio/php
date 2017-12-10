<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/11/5
 * Time: 8:34
 */

require_once "../server/config.php";


function result($val1, $val2){
    echo json_encode(array("table_name_1" => $val1, "table_name_2" => $val2));
    return true;
}

// ds:daily_sentence
static $redis_table_name_1 = "ds_tb_sentence_type1";
static $redis_table_name_2 = "ds_tb_sentence_type2";

function get_constant_data_from_redis(){
    $redis = get_redis_con();
    if(!$redis){
        error_log("get redis connection failed.");
        return false;
    }

    global $redis_table_name_1, $redis_table_name_2;
    $val1 = $redis->get($redis_table_name_1);
    $val2 = $redis->get($redis_table_name_2);
    $redis->close();

    if(!$val1 || !$val2){
        return false;
    }
    return result(json_decode($val1), json_decode($val2));
}

function write_to_redis($val1, $val2){
    $redis = get_redis_con();
    if(!$redis){
        error_log("get redis connection failed.");
        return;
    }

    $tmp1 = json_encode($val1);
    $tmp2 = json_encode($val2);
    global $redis_table_name_1, $redis_table_name_2;

    $redis->set($redis_table_name_1, $tmp1);
    $redis->set($redis_table_name_2, $tmp2);
    $redis->close();
}

function get_kv_from_mysql($db, $query_cmd){
    $result = $db->query($query_cmd);

    if($result->num_rows == 0){
        $result->free();
        return null;
    }

    $tmp = array();
    while ($row = $result->fetch_assoc()) {$tmp[$row["id"]] = $row["sentence_type"];}

    $result->free();
    return $tmp;
}

function get_constant_data_from_mysql(){
    static  $table_name_1 = "SELECT * FROM tb_sentence_type1;";
    static  $table_name_2 = "SELECT * FROM tb_sentence_type2;";

    $db = get_mysql_con("daily_sentence");
    if(!$db){
        error_log("get mysql connection failed.");
        return null;
    }

    $val1 = get_kv_from_mysql($db, $table_name_1);
    $val2 = get_kv_from_mysql($db, $table_name_2);

    $db->close();
    if($val1 && $val2){write_to_redis($val1, $val2);}

    return result($val1, $val2);
}

function get_constant_data(){
    if(get_constant_data_from_redis()){return true;}
    return get_constant_data_from_mysql();
}

return get_constant_data();

?>