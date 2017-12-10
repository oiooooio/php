<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/7
 * Time: 16:51
 */

require_once "check_user_info.php";
require_once "../server/config.php";

function return_val($error_code, $return_v)
{
    echo json_encode(array('code' => convert_error_code_to_des($error_code)));
    return $return_v;
}

function check_user_exists($db, $user_name, $user_email){
    static $query_cmd = <<<eof
SELECT * FROM tb_user
WHERE user_name = '%s' OR user_email = '%s';
eof;

    $cmd = sprintf($query_cmd, $user_name, $user_email);
    $result = $db->query($cmd);
    $row_num = $result->num_rows;

    $result->free();
    return $row_num > 0;
}

function check_invite_code_valid($db, $invite_code){
    static $query_cmd = <<<eof
SELECT * FROM tb_invite_code
WHERE `code` = '%s' AND `is_used` = 0 AND UNIX_TIMESTAMP(`generate_date`) + `expiration_time` > UNIX_TIMESTAMP(NOW());
eof;

    $cmd = sprintf($query_cmd, $invite_code);
    $result = $db->query($cmd);
    $row_num = $result->num_rows;

    $result->free();
    return $row_num > 0;
}

function update_invite_code($db, $invite_code, $user_email){
    static $query_cmd = <<<eof
UPDATE tb_invite_code
SET is_used = 1, account_used = '%s', use_date = NOW() WHERE `code` = '%s';
eof;

    $cmd = sprintf($query_cmd, $user_email, $invite_code);
    return $db->query($cmd);
}

if(isset($_POST["user_name"], $_POST["user_pwd"], $_POST["user_email"],
    $_POST["invite_code"]))
    //, $_POST["user_nickname"]
{
    $user_name = $_POST["user_name"];
    $user_pwd = $_POST["user_pwd"];
    $user_email = $_POST["user_email"];
    $invite_code = $_POST["invite_code"];
    //$user_nickname = $_POST["user_nickname"];

    if(!check_email($user_email)){
        return return_val(6, 0);
    }

    $check_ret = check_user_info($user_name, $user_pwd);
    if($check_ret != 0){
        return return_val($check_ret, 0);
    }

    if(strlen($invite_code) > 0){
        if(!check_invite_code($invite_code)){
            return return_val(7, 0);
        }
    }

    $db = get_mysql_con("user_center");
    if(!$db){
        return return_val(3, 0);
    }

    if(check_user_exists($db, $user_name, $user_email)){
        return return_val(9, 0);
    }

    if(strlen($invite_code) > 0){
        if(!check_invite_code_valid($db, $invite_code)){
            return return_val(7, 0);
        }
    }

    $insert_cmd = <<<eof
INSERT INTO `user_center`.`tb_user` (
	`user_name`,
	`user_pwd`,
	`user_email`,
	`invite_code`
)
VALUES
	(
		'%s',
		'%s',
		'%s',
		'%s'
	);
eof;

    $cmd = sprintf($insert_cmd, $user_name, $user_pwd, $user_email, $invite_code);
    $result = $db->query($cmd);

    if(!$result){
        return return_val(3, 0);
    }

    if(strlen($invite_code) > 0){
        if(!update_invite_code($db, $invite_code, $user_email)){
            $db->close();
            return return_val(10, 0);
        }
    }

    $db->close();
    return return_val(0, 0);
}
else{
    return return_val(3, 0);
}



?>