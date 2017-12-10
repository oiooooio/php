<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/9/10
 * Time: 20:59
 */


/**
 * read file name from a special directory
 * @param str with directory path
 * @note if $dir_path is null return a array with a string:"Illegal args."
 * @return array
 */
function get_files($dir_path)
{
    $files = array();

    if(null == $dir_path){
        return array("Illegal args.");
    }

    $handle = null;
    if (false == ($handle = opendir($dir_path))){
        return array("Illegal args.");
    }

    while (false != ($file = readdir($handle))){
        array_push($files, $file);
    }
    return $files;
}



?>