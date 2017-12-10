<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/5/2
 * Time: 23:35
 */

function get_header()
{
    static $header = <<<header
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        .table {
            border-collapse: collapse;
            border: solid 1px #CCCCCC;
        }

        .table th{
            border: solid 1px #CCCCCC;
            text-align: left;
            color: #999999;
        }

        .table tr{
            height: 2em;
            border: solid 1px #CCCCCC;
        }

        .table td{
            border: solid 1px #CCCCCC;
        }
    </style>
</head>
<body>
    <p>结果：</p>
    <table id="tb_container" class="table">
        <tr>
            <th style="width: 2em">ID</th>
            <th style="width: 8em">描述</th>
            <th style="width: 20em">值</th>
        </tr>
    
header;

    return $header;
}

function get_ender()
{
    static $ender = <<<ender

    </table>
</body>
</html>
ender;

    return $ender;
}

function add_row($id, $des, $v){
    static $row = <<<row
    <tr>
        <td>%d</td>
        <td>%s</td>
        <td>%s</td>
    </tr>%s
row;

    return sprintf($row, $id, $des, $v, "\n");
}


function get_return_html_text($arr)
{
    $html = get_header();

    $index = 1;
    foreach($arr as $key=>$value){
        $html .= add_row($index, $key, $value);
        $index += 1;
    }

    $html .= get_ender();
    return $html;
}

?>