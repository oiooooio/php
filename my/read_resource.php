<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/9/10
 * Time: 21:30
 */

function get_theme_music()
{
    require("../server/core/read_file.php");
    require("../server/core/filter.php");
    require("../server/core/format_to_str.php");
    $theme_musics = get_files("../resource/theme_music");
    $theme_musics = equal_filter_array_item_copy($theme_musics, array(".", ".."));
    $theme_musics = find_filter_array_item_copy($theme_musics, array("mp4"));
//    return get_str_from_array($theme_musics, '<br>');
    return $theme_musics;
}

?>