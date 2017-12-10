<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>欢迎来到oiooooio!</title>
    <link href="../icon/icon.png" rel="icon" type="image/x-icon">
    <link href="../css/global.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/bootsrtap-buttons.css" rel="stylesheet" type="text/css">
    <link href="my.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/effect_typewriter/typewriter.css" rel="stylesheet" type="text/css">
    <script src="music.js"></script>

    <style>
        .play_area{
            height: 10em;
            width: 30em;
            margin-right: 5em;
            margin-bottom: 25em;
            /*background-color: rgba(68, 90, 255, 0.91);*/
        }

        .button_amplification{
            border-radius: 100%;
            width: 10em;
            height: 10em;
            border: none;
            z-index: -1;
        }

        .title_amplification{
            margin-top: 0.5em;
            color: #EEAD0E;
            line-height: 4em;
            font-weight: bold;
            font-family: my_font_daimwwt, serif;
            font-size: 3em;
            white-space: pre;
            text-indent: 2em;
        }

        .music_name_amplification {
            color: #CD00CD;
            font-family: my_font_daimwwt, serif;
            font-size: 2em;
            letter-spacing: 0.2em;
            font-weight: bold;
        }

        .next_page {
            position: absolute;
            bottom: 0;
            margin-bottom: 7em;
            width: 100%;
        }
    </style>

</head>

<body style="background-image: url('../resource/theme_pics/portrait/portrait_1.jpeg')" class="theme_bg_image">
<div>
    <h1 class="title_amplification">欢迎来到 oiooooio 的世界！</h1>
</div>

<div class="div">
    <div class="div_inner">
        <span id="wangli" style="font-size: 2em"></span>
        <br>
        <span id="log" style="visibility: hidden;"></span>
    </div>
</div>

<script src='../3rdlib/effect_typewriter/theater.js' type='text/javascript'></script>
<script src="../3rdlib/effect_typewriter/typewriter.js"></script>

<script>clear_local_music();</script>
<?php
require ("./read_resource.php");
$music_names = get_theme_music();
for ($i = 0; $i < count($music_names); ++$i){
    echo "<script type='text/javascript'>store_music_name(\"$music_names[$i]\")</script>";
}
?>

<div class="right_footer play_area" style="text-align: center;">
    <p id="music_name" class="music_name_amplification" style="margin-top: 12%">这是歌名</p>
    <button class="button_amplification bt_play" name="bt_switch_music" onclick="switch_music('audio', 'bt_switch_music');"></button>
    <button class="button_amplification bt_next" name="bt_next_music" onclick="next_music_and_set_text('../resource/theme_music/', 'audio', 'bt_switch_music', 'music_name');"></button>
</div>

<audio onended="next_music_and_set_text('../resource/theme_music/', 'audio', 'bt_switch_music', 'music_name');" style="border: 2px #A4D3EE solid" id="audio" controls preload="none" autoplay hidden>
    Audio content can't played
</audio>

<div class="next_page">
    <pre>
        <a href="./my_dream.php" style="float: right; font-family: my_font_daimwwt,serif; font-style: italic; font-size: 3em;">每个人都有一个梦想&emsp;</a>
    </pre>
    <hr>
</div>

<script>
    next_music_and_set_text('../resource/theme_music/', 'audio', 'bt_switch_music', 'music_name');
</script>

</body>

</html>
