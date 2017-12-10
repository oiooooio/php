<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/10/3
 * Time: 17:39
 *
 * 操作指令：
 * type
 *  get 获取值
 *  set 设置值
 *      value_del 设置删除值
 *      value_del 设置增加值
 *
 */
include "mysql_func_mix.php";
include "err_code.php";

function convert_multi_rows_to_one_row($arr){
    if(!$arr)
        return array();
    if(gettype($arr) != "array")
        return array();

    $had_flags = array();
    for ($i=0; $i<count($arr); ++$i){
        $item = $arr[$i];
        if(count($item) < 1){
            continue;
        }
        array_push($had_flags, $item[0]);
    }
    return $had_flags;
}

function split_str_to_array($str, $sep){
    if(!$str)
        return array();
    if(gettype($str) != "string")
        return array();
    if (strlen($str) == 0)
        return array();

    $arr = array();
    $t_arr = explode($sep, $str);//按分号分离字符串
    while(list($key, $v)= each($t_arr)){
        if(!$v || strlen($v) == 0)
            continue;
        array_push($arr, $v);
    }
    return $arr;
}

function mysql_kv_table_op($table_name, $value_name)
{
    $return_val = array();

    do {
        //操作指令
        static $_G_GLOBAL_OP_CMD = array("get", "set");

        //类型检查
        if (isset($_POST["type"]) == false) {
            $err_code = 20001;
            break;
        }

        //类型检查
        $t_type = $_POST["type"];
        $has = false;
        for ($i = 0; $i < count($_G_GLOBAL_OP_CMD); ++$i) {
            if ($_G_GLOBAL_OP_CMD[$i] == $t_type) {
                $has = true;
                break;
            }
        }
        if ($has == false) {
            $err_code = 20001;
            break;
        }

        //获取要增加或者删除的值
        $value_del = "";
        $value_add = "";
        if (isset($_POST["value_del"])) {
            $value_del = $_POST["value_del"];
        }
        if (isset($_POST["value_add"])) {
            $value_add = $_POST["value_add"];
        }

        //得到要修改的数组
        $adds = array();
        $dels = array();
        if ($t_type == $_G_GLOBAL_OP_CMD[1]) { //1:set
            $add_str_len = strlen($value_add);
            $del_str_len = strlen($value_del);
            if (($add_str_len == 0 or $del_str_len > 1024) and ($del_str_len == 0 or $del_str_len > 1024)) {
                //add和del字符串都是空的
                $err_code = 20002;
                break;
            }

            $adds = split_str_to_array($value_add, ";");//按分号分离字符串
            $dels = split_str_to_array($value_del, ";");//按分号分离字符串

            if (count($dels) == 0 and count($adds) == 0) {
                $err_code = 20002;
                break;
            }
        }

        //得到db连接
        $db_con = get_mysql_connection();
        if ($db_con == null) {
            $err_code = 10001;
            break;
        }

        //得到数据库里现有的标签
        $sql_get = sprintf("select `%s` from `%s`", $value_name, $table_name);
        $tmp_v = select($db_con, $sql_get);
        $err_code = $tmp_v[0];
        if ($err_code > 0) {
            break;
        }
        $had_flags = convert_multi_rows_to_one_row($tmp_v[1]);

        //如果是get，则返回json
        if ($t_type == $_G_GLOBAL_OP_CMD[0]) { //get
            $return_val = $had_flags;
            $db_con->close();
            break;
        }

        //http://php.net/manual/en/mysqli-stmt.bind-param.php
        function _exe_sql($db_con, $sql, $arr){
            $exe_count = 5;
            while(list($key, $v)= each($arr)){
                $stmt = $db_con->prepare($sql);
                $stmt->bind_param('s', $v);
                $stmt->execute();
                $stmt->close();
                if(--$exe_count < 0)
                    break;
            }
        }

        //set命令
        $adds = array_diff($adds, $had_flags);
        $dels = array_intersect($dels, $had_flags);
        //执行set
        $sql = sprintf("delete from `%s` where `%s`=?", $table_name, $value_name);
        _exe_sql($db_con, $sql, $dels);
        $sql = sprintf("insert into `%s` (`%s`) values (?)", $table_name, $value_name);
        _exe_sql($db_con, $sql, $adds);

        $tmp_v = select($db_con, $sql_get);
        $err_code = $tmp_v[0];
        $return_val = convert_multi_rows_to_one_row($tmp_v[1]);
        $db_con->close();
    } while (false);

    $result = array("ec" => get_err_msg($err_code), "ret" => $return_val);
    return $result;
}

?>


