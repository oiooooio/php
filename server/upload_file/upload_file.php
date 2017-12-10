<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/5/2
 * Time: 23:23
 */

require_once "../return_template.php";
require_once "upload_file_error_code.php";

//上传的目录，相对路径
static $g_upload_dir = "../../upload_file/";



$ret = array();

do{
    if(!isset($_FILES["file"]))
    {
        $ret["error"] = "内部错误，上传失败！";
        break;
    }
    $f = $_FILES["file"];

    if ($f["error"] > 0)
    {
        $ret["error"] = convert_code_to_describe($f["error"]);
        break;
    }

    $ret["file name"] = $f["name"];
//    $ret["file tmp name"] = $f["tmp_name"];
    $ret["file type"] = $f["type"];
    $ret["file size"] = sprintf("%.3f kbs", $f["size"]/1024);

    $full_path = $g_upload_dir . $f["name"];
//    $ret["[D]full path"] = $full_path;

    if (file_exists($full_path))
    {
        $ret["result"] = "文件已存在";
        break;
    }

    if(move_uploaded_file($f["tmp_name"], $full_path) == false)
    {
        $ret["result"] = "上传失败";
        break;
    }

    $ret["result"] = "上传成功";
}while(false);

echo get_return_html_text($ret);

?>