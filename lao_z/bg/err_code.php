<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/10/3
 * Time: 17:47
 */


function get_err_msg($err_code){
    static $_G_ERR_CODE = array(
        0 => "success",

        10001 => "connect mysql fail",
        10002 => "not found table",
        10003 => "not found result set",

        20001 => "args:type error",
        20002 => "no value to set or value too longer",
        20003 => "add fail",
        20004 => "del fail",
        20005 => "args:id error",
        20006 => "no data",
    );

    return $_G_ERR_CODE[$err_code];
}

?>

