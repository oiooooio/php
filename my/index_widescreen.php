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
            width: 20em;
            margin-right: 4em;
            margin-bottom: 5em;
            /*background-color: rgba(68, 90, 255, 0.2);*/
        }

        .title_ex{
            color: #EEAD0E;
            line-height: 2em;
            font-weight: bold;
            font-family: my_font_daimwwt, serif;
            padding-left: 2em;
            margin-top: 2em;
        }
    </style>
</head>

<body style="background-image:url('../resource/theme_pics/wide/paper.png'); margin: auto 0;" class="theme_bg_image">
    <h1 class="title_ex">欢迎来到 oiooooio 的世界！</h1>

    <script>clear_local_music();</script>
    <?php
        require ("./read_resource.php");
        $music_names = get_theme_music();
        for ($i = 0; $i < count($music_names); ++$i){
            echo "<script type='text/javascript'>store_music_name(\"$music_names[$i]\")</script>";
        }
    ?>

    <div class="div">
        <div class="div_inner">
            <span id="wangli"></span>
            <br>
            <span id="log" style="visibility: hidden;"></span>
        </div>
    </div>

    <div style="width: 70%; margin-left: 0">
        <a href="./my_dream.php" style="float: right; font-family: my_font_daimwwt; font-style: italic">每个人都有一个梦想</a>
        <br>
        <hr>
    </div>

    <script src='../3rdlib/effect_typewriter/theater.js' type='text/javascript'></script>
    <script src="../3rdlib/effect_typewriter/typewriter.js"></script>

    <div class="right_footer play_area" style="text-align: center;">
        <p id="music_name" class="music_name" style="margin-top: 12%"></p>
        <button class="button_radius bt_play" name="bt_switch_music" onclick="switch_music('audio', 'bt_switch_music');"></button>
        <button class="button_radius bt_next" name="bt_next_music" onclick="next_music_and_set_text('../resource/theme_music/', 'audio', 'bt_switch_music', 'music_name');"></button>
    </div>

    <audio onended="next_music_and_set_text('../resource/theme_music/', 'audio', 'bt_switch_music', 'music_name');" style="border: 2px #A4D3EE solid" id="audio" controls preload="none" autoplay hidden>
        Audio content can't played
    </audio>

    <script>
        next_music_and_set_text('../resource/theme_music/', 'audio', 'bt_switch_music', 'music_name');
    </script>

</body>
</html>
