<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2017/5/3
 * Time: 21:23
 */

function convert_code_to_describe($code)
{
    switch ($code)
    {
        case 0:
            return "没有错误发生，文件上传成功";
        case 1:
            return "上传的文件超过了 PHP.ini中upload_max_filesize(默认情况为2M) 选项限制的值";
        case 2:
            return "上传文件的大小超过了 HTML表单中MAX_FILE_SIZE选项指定的值";
        case 3:
            return "文件只有部分被上传";
        case 4:
            return "没有文件被上传";
        case 5:
            return "传文件大小为0";
    }

    return sprintf("未知错误:%d", $code);
}


?>