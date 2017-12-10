<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/11/13
 * Time: 13:22
 */

require_once "../server/config.php";

function my_random($count){
    mt_srand((double)microtime()*1000000*getmypid());
    return mt_rand() % $count;
}

function get_count($db){
    static $query_cmd = <<<eof
SELECT COUNT(1) as `count` FROM tb_sentence;
eof;

    $result = $db->query($query_cmd);
    $row_num = $result->num_rows;

    if($row_num == 0){
        $result->free();
        return 999;
    }

    $row = $result->fetch_assoc();
    $count = $row["count"];

    $result->free();
    return $count;
}

function get_from_mysql($db, $id){
    static $query_cmd = <<<eof
SELECT
t1.id,
t1.title,
date(t1.create_date) as `create_date`,
t1.book_name,
t1.author,
t1.content,
t2.sentence_type AS type1,
t3.sentence_type AS type2
FROM
tb_sentence AS t1
LEFT JOIN tb_sentence_type1 AS t2 ON t1.type1 = t2.id
LEFT JOIN tb_sentence_type2 AS t3 ON t1.type2 = t3.id
WHERE t1.id = %d
eof;
    $result = $db->query(sprintf($query_cmd, $id));
    $row_num = $result->num_rows;

    if($row_num == 0){
        $result->free();
        return null;
    }

    $row = $result->fetch_assoc();
    $tmp = json_encode($row);
    $result->free();
    return $tmp;
}

function get(){
    $db = get_mysql_con("daily_sentence");
    if(!$db){
        error_log("get mysql connection failed.");
        return false;
    }

    $count = my_random(get_count($db));
    if($count < 14){
        //数据库起始id为14
        $count += 14;
    }

    $tmp = get_from_mysql($db, $count);
    echo $tmp;
    $db->close();
}

get();
?>