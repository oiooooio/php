<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/9/10
 * Time: 21:24
 */

/**
 * @param $arr
 * @param $item_suffix
 * @return string
 */
function get_str_from_array(& $arr, $item_suffix)
{
    $str = "";

    for ($i = 0; $i < count($arr); ++$i)
    {
        $str .= "$arr[$i]".$item_suffix;
    }
    return $str;
}

?>


