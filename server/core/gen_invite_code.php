<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/15
 * Time: 13:18
 *
 * 生成邀请码
 */

require_once "../server/config.php";

$invite_code_lev = 1;
$gen_count = 100;

function my_random($len=8, $format='ALL'){
    $is_abc = $is_number = 0;
    $password = $tmp ='';
    switch($format){
        case 'ALL':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'CHAR':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'NUMBER':
            $chars='0123456789';
            break;
        default :
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }
    mt_srand((double)microtime()*1000000*getmypid());
    while(strlen($password)<$len){
        $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
        if(($is_number <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
            $is_number = 1;
        }
        if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
            $is_abc = 1;
        }
        $password.= $tmp;
    }
    if($is_number <> 1 || $is_abc <> 1 || empty($password) ){
        $password = my_random($len,$format);
    }
    return $password;
}

$query_cmd_template = "INSERT INTO `user_center`.`tb_invite_code` (`code`,`lev`)VALUES('%s',%d);";

@ $db = get_mysql_con("user_center");
$success_count = 0;

for($i = 0 ; $i < $gen_count; $i++)
{
    $tmp = sprintf($query_cmd_template, my_random(5,'ALL'), 1);
    $result = $db->query($tmp);
    if($result){
        $success_count = $success_count + 1;
    }
}
$db->close();

if($success_count == $gen_count){
    echo "生成成功";
    echo "<br>";
    echo "生成数量：".strval($gen_count);
    echo "<br>";
    echo "邀请码等级：".strval(1);
}
else{
    echo "生成失败";
    echo "<br>";
    echo "生成成功数量：".strval($success_count);
    echo "<br>";
    echo "需要生成数量：".strval($gen_count);
}


?>