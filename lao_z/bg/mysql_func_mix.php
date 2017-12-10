<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/10/3
 * Time: 17:36
 */


function get_mysql_connection_info(){
    return ["localhost", "root", "wang@2012", "lao_z", 3306];
}

function get_mysql_connection(){
    //http://php.net/manual/zh/class.mysqli.php
    $con_str = get_mysql_connection_info();
    $con = new mysqli($con_str[0], $con_str[1], $con_str[2], $con_str[3], $con_str[4]);
    return $con;
}

function set_mysql_read_utf8($con){
    if(!$con)
        return;
    $con->query("set character set 'utf8'");//读库
}

function set_mysql_write_utf8($con){
    if(!$con)
        return;
    $con->query("set names 'utf8'");//写库
}

/**
 * @param $db_con mysqli
 * @param $query_cmd string cmd
 * @return array|null
 */
function select($db_con, $query_cmd){
    $err_code = 0;
    $ret = null;
    do{
        set_mysql_read_utf8($db_con);
        $result = $db_con->query($query_cmd);
        if(!$result){
            $err_code = 10002; break;
        }

        //得到数据库里现有的标签
        $ret = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_row()){
                array_push($ret, $row);
            }
        }
        $result->close();//不要忘记关闭结果集
    }while(false);
    return array($err_code, $ret);
}


/**
 * @param $db_con mysqli
 * @param $stmt mysqli->prepare()
 * @return array|null
 */
function select_stmt($db_con, $stmt){
    $err_code = 0;
    $ret = null;
    do{
        set_mysql_read_utf8($db_con);
        $stmt->execute();
        $result = $stmt->get_result();
        if(!$result){
            $err_code = 10002; break;
        }

        //得到数据库里现有的标签
        $ret = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_row()){
                array_push($ret, $row);
            }
        }
        $result->close();//不要忘记关闭结果集
    }while(false);
    return array($err_code, $ret);
}

/**
 * @param $arr array
 * @return bool|string 根据数组元素类型把数组格式化成mysql值逗号分隔的字符串
 */
function format_sql_values($arr){
    $sql_values = "";
    while(list($key, $v)= each($arr)){
        if(gettype($v) == "string"){
            $sql_values .= sprintf("'%s',", $v);
        }
        else{
            $sql_values .= sprintf("%d,", $v);
        }
    }
    $sql_values = substr($sql_values, 0, strlen($sql_values)-1);
    return $sql_values;
}

/**
 * @param $arr array
 * @return bool|string 根据数组元素类型把数组格式化成多个值:(x1),(x2),..
 */
function format_sql_values_2($arr){
    $sql_values = "";
    while(list($key, $v)= each($arr)){
        if (!$v)
            continue;
        if(gettype($v) == "string"){
            $sql_values .= sprintf("('%s'),", $v);
        }
        else{
            $sql_values .= sprintf("(%d),", $v);
        }
    }
    $sql_values = substr($sql_values, 0, strlen($sql_values)-1);
    return $sql_values;
}




?>