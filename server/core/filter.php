<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/9/10
 * Time: 21:09
 */

/**
 * @param $arr type is array
 * @param $arr_filter type is array contains filter item
 * @return a new array with not $arr_filter item
 */
function equal_filter_array_item_copy(& $arr, $arr_filter)
{
    if($arr == null || count($arr) == 0){return $arr;}
    if($arr_filter == null || count($arr_filter) == 0){return $arr;}

    $new_arr = array();
    for ($j = 0; $j < count($arr); ++$j)
    {
        $item = $arr[$j];
        $is_has = false;
        for ($i = 0; $i < count($arr_filter); ++$i)
        {
            $filter = $arr_filter[$i];
            if($item == $filter){
                $is_has = true;
                break;
            }
        }

        if(false == $is_has){
            array_push($new_arr, $item);
        }
    }
    return $new_arr;
}

function find_filter_array_item_copy(& $arr, $arr_filter)
{
    if($arr == null || count($arr) == 0){return $arr;}
    if($arr_filter == null || count($arr_filter) == 0){return $arr;}

    $new_arr = array();
    for ($j = 0; $j < count($arr); ++$j)
    {
        $item = $arr[$j];
        $is_has = false;
        for ($i = 0; $i < count($arr_filter); ++$i)
        {
            $filter = $arr_filter[$i];
            if(strstr($item,$filter)){
                $is_has = true;
                break;
            }
        }

        if(false == $is_has){
            array_push($new_arr, $item);
        }
    }
    return $new_arr;
}

?>