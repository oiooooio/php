<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/30
 * Time: 20:53
 */

require_once "check.php";
require_once "../server/config.php";

function return_val($error_code, $return_v){
    echo json_encode(array('code' => convert_error_code_to_des($error_code)));
    return $return_v;
}

function get_user_info_from_redis($md5){
    $redis = get_redis_con();
    if(!$redis){
        error_log("get redis connection failed.");
        return false;
    }

    $tmp = $redis->get($md5);
    if(!$tmp){
        error_log("get user info failed. md:".$md5);
        return false;
    }
    $redis->close();

    return json_decode($tmp);
}

function write_sentence_to_mysql($query_cmd){
    $db = get_mysql_con("daily_sentence");
    if(!$db){
        error_log("get mysql connection failed.");
        return false;
    }


    $result = $db->query($query_cmd);
    if(!$result){
        error_log("insert to mysql error, info:".mysqli_error($db));
        $db->close();
        return false;
    }

    $db->close();
    return true;
}

function backg(){
    if(!isset($_POST["taken_from"], $_POST["author"], $_POST["content"], $_POST["title"],
        $_POST["md5"], $_POST["sentence_type_1"], $_POST["sentence_type_2"])){
        return return_val(4, 0);
    }

    $taken_from = $_POST["taken_from"];
    $author = $_POST["author"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $md5 = $_POST["md5"];
    $sentence_type_1 = $_POST["sentence_type_1"];
    $sentence_type_2 = $_POST["sentence_type_2"];

    if(!check_taken_from($taken_from)){return return_val(1, 0);}
    if(!check_author($author)){return return_val(2, 0);}
    if(!check_title($title)){return return_val(3, 0);}
    if(!check_content($content)){return return_val(3, 0);}
    if(!check_md5($md5)){return return_val(5, 0);}
    if(!intval($sentence_type_1)){return return_val(6, 0);}
    if(!intval($sentence_type_2)){return return_val(6, 0);}

    $user_info = get_user_info_from_redis($md5);
    if(!$user_info){return return_val(5, 0);}

    static $insert_cmd = <<< eof
INSERT INTO `daily_sentence`.`tb_sentence` (
	`user_id`,
	`book_name`,
	`title`,
	`author`,
	`content`,
	`type1`,
	`type2`
)VALUES(%s, '%s', '%s', '%s', '%s', %d, %d);
eof;

    $tmp = sprintf($insert_cmd, $user_info->id,
        $taken_from, $title, $author, $content, $sentence_type_1, $sentence_type_2);

    if(!write_sentence_to_mysql($tmp)){
        error_log("write to mysql error. cmd:".$tmp);
        return return_val(4, 0);
    }
    return return_val(0, 0);
}

backg();

?>