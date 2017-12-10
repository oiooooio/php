<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/9/27
 * Time: 22:33
 *
 * 操作指令：
 * type
 *  get 获取值
 *  set 设置值
 *      value_del 设置删除值，每个值用逗号分开
 *      value_del 设置增加值，每个值用逗号分开
 */

include "db_kv_table.php";

function get_kvs(){
    do{
        if(!isset($_POST["id"])){
            $err_code = 20005; break;
        }
        $id = $_POST["id"];

        $con = get_mysql_connection();
        if(!$con){
            $err_code = 10001; break;
        }

        //http://php.net/manual/en/mysqli-stmt.bind-param.php
        $stmt = $con->prepare("SELECT `table_name`, `table_field_name` FROM t_fy_const_info WHERE `id`=?");
        $stmt->bind_param('i', $id);
        $tmp_v = select_stmt($con, $stmt);
        $stmt->close();
        $con->close();

        $err_code = $tmp_v[0];
        $ret = $tmp_v[1];
        if($err_code != 0){
            break; //出错了
        }
        if(count($ret) != 1 || count($ret[0]) != 2){ //没有数据
            $err_code = 20006; break;
        }

        $ret = $ret[0];
        $t = mysql_kv_table_op($ret[0], $ret[1]);
        echo json_encode($t);
        return;
    }while(false);

    $result = array("ec" => get_err_msg($err_code), "ret" => []);
    echo json_encode($result);
}

get_kvs();

?>

