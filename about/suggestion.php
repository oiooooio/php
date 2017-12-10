<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/11/13
 * Time: 19:52
 */

require "./check.php";
require "../server/config.php";
require "../login/get_user_info.php";



function return_val($error_code, $return_v)
{
    echo json_encode(array('code' => convert_error_code_to_des($error_code)));
    return $return_v;
}


function suggestion(){
    //1:建议
    //2:投诉
    $con_type = null;
    $content = null;
    $md5 = null;

    if(isset($_POST["content"], $_POST["con_type"], $_POST["md5"])){
        $content = $_POST["content"];
        $con_type = $_POST["con_type"];
        $md5 = $_POST["md5"];

        switch ($con_type){
            case 1:$con_type = "suggestion"; break; //建议
            case 2:$con_type = "complaint"; break;  //投诉
            default:$con_type = "unknown";
        }
    }
    else{
        return return_val(1, 0);
    }

    if(!check_content($content)){
        return return_val(2, 0);
    }

    $user_id = 0;
    if(strlen($md5) > 0){
        $user_id = get_user_id($md5);
        if(!$user_id){
            $user_id = 0;
        }
    }

    static $insert_cmd = <<<eof
INSERT INTO `user_center`.`tb_suggestion` (
	`con_type`,
	`content`,
	`user_id`
)
VALUES
	('%s', '%s', %d);
eof;

    $cmd = sprintf($insert_cmd, $con_type, $content, $user_id);

    $db = get_mysql_con("user_center");
    if(!$db){
        return return_val(1, 0);
    }

    $result = $db->query($cmd);
    $db->close();

    if(!$result){
        return return_val(1, 0);
    }
    return return_val(0, 0);
}

suggestion();

?>