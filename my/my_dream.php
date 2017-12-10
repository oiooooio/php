<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>欢迎来到oiooooio!</title>

    <link href="../icon/icon.png" rel="icon" type="image/x-icon">
    <link href="../css/global.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/bootsrtap-buttons.css" rel="stylesheet" type="text/css">
    <link href="my.css" rel="stylesheet" type="text/css">
    <script src="music.js"></script>

    <style>
        .play_area {
            height: 10em;
            width: 20em;
            margin-right: 5em;
            margin-bottom: 5em;
        }

        .title_ex {
            color: #EEAD0E;
            line-height: 2em;
            font-weight: bold;
            font-family: my_font_daimwwt, serif;
            padding-left: 2em;
            margin-top: 2em;
        }
    </style>
</head>

<body>
<h1 class="title_ex">欢迎来到 oiooooio 的世界！</h1>

<script>clear_local_music();</script>
<?php
require("./read_resource.php");
$music_names = get_theme_music();
for ($i = 0; $i < count($music_names); ++$i) {
    echo "<script type='text/javascript'>store_music_name(\"$music_names[$i]\")</script>";
}
?>

<div class="stars">
</div>

<!--<div class="right_footer play_area" style="text-align: center;">-->
<!--    <p id="music_name" class="music_name" style="margin-top: 12%">这是歌名</p>-->
<!--    <button class="button_radius bt_play" name="bt_switch_music" onclick="switch_music('audio', 'bt_switch_music')"></button>-->
<!--    <button class="button_radius bt_next" name="bt_next_music" onclick="next_music_and_set_text('../resource/theme_music/', 'audio', 'bt_switch_music', 'music_name');"></button>-->
<!--</div>-->
<!---->
<!--<audio onended="next_music_and_set_text('../resource/theme_music/', 'audio', 'music_name');" style="border: 2px #A4D3EE solid" id="audio" controls preload="none" autoplay hidden>-->
<!--    Audio content can't played-->
<!--</audio>-->
<!---->
<!--<script>-->
<!--    next_music_and_set_text("../resource/theme_music/", "audio", "music_name");-->
<!--</script>-->

</body>
</html>
