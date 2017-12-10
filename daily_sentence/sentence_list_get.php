<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/11/20
 * Time: 10:33
 */


require_once "../server/config.php";
require_once "../login/get_user_info.php";
require_once "check.php";


function return_val($error_code, $return_v){
    echo json_encode(array('code' => convert_error_code_to_des($error_code)));
    return $return_v;
}

function get_sentence_total_count($db, $user_id){
    static $query_cmd = <<<eof
SELECT COUNT(1) as total_count FROM tb_sentence WHERE user_id = %d;
eof;

    $cmd = sprintf($query_cmd, $user_id);
    $result = $db->query($cmd);
    $row_num = $result->num_rows;

    if($row_num != 1){
        $result->free();
        return null;
    }

    $row = $result->fetch_assoc();
    $count = $row["total_count"];
    $result->free();
    return $count;
}

function get_sentence_list($db, $user_id, $start_id, $limit_num){
    static $query_cmd = <<<eof
SELECT
t1.id,
t1.book_name,
t1.title,
DATE(t1.create_date) as date,
t1.author,
LEFT(t1.content,50) as content,
t2.sentence_type AS type1,
t3.sentence_type AS type2
FROM
tb_sentence AS t1
LEFT JOIN tb_sentence_type1 AS t2 ON t1.type1 = t2.id
LEFT JOIN tb_sentence_type2 AS t3 ON t1.type2 = t3.id
WHERE t1.user_id = %d AND t1.`id` %s %d
ORDER BY id DESC
LIMIT %d;
eof;

    $cmd = sprintf($query_cmd, $user_id, $start_id == 0 ? ">" : "<", $start_id, $limit_num);
    $result = $db->query($cmd);
    $row_num = $result->num_rows;

    if($row_num == 0){
        $result->free();
        return null;
    }

    $ret = array();
    while ($row = $result->fetch_assoc()){
        array_push($ret, json_encode($row));
    }
    return json_encode($ret);
}

function get(){

    if(!isset($_POST["md5"], $_POST["index"], $_POST["is_pc"])){
        return return_val(4, 0);
    }

    $md5 = $_POST["md5"];
    $index = $_POST["index"];
    $is_pc = $_POST["is_pc"];

    $index_r = null;
    $is_pc_r = null;
    try{
        $index_r = intval($index);
        $is_pc_r = (strcmp($is_pc, "true") == 0);
    }
    catch (Exception $e){
        return return_val(4, 0);
    }

    $db = get_mysql_con("daily_sentence");
    if(!$db){
        error_log("get mysql connection failed.");
        return false;
    }

    if(!check_md5($md5)){
        $db->close();
        return return_val(5, 0);
    }

    $user_id = get_user_id($md5);
    if(!$user_id){
        $db->close();
        return return_val(5, 0);
    }

    $sentence_total_c = get_sentence_total_count($db, $user_id);
    if($sentence_total_c == null or $sentence_total_c == 0){
        $db->close();
        echo "";
        return return_val(0, 0);
    }

    $t_list = get_sentence_list($db, $user_id, $index_r, $is_pc_r ? 20 : 10);
    $t_arr = array("total_count" => $sentence_total_c, "list" => $t_list);
    echo json_encode($t_arr);
    $db->close();
}

get();


?>