<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/10/4
 * Time: 16:56
 */

include "mysql_func_mix.php";
include "err_code.php";



function read_fy_const_info(){
    $ret = null;

    do{
        $con = get_mysql_connection();
        if(!$con){
            $err_code = 10001; break;
        }

        $tmp_v = select($con, "SELECT `id`, `des` FROM t_fy_const_info");
        $err_code = $tmp_v[0];
        $ret = $tmp_v[1];
    }while(false);

    $v = array("ec" => get_err_msg($err_code), "ret" => $ret);
    echo json_encode($v);
}

read_fy_const_info();
?>