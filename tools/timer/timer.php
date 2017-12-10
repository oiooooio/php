<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/2
 * Time: 9:27
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./icon.png" rel="icon" type="image/x-icon">
    <link href="../../css/global.css" rel="stylesheet" type="text/css">
    <link href="../../3rdlib/bootsrtap-buttons.css" rel="stylesheet" type="text/css">

    <script src="../../js/jquery/jquery.min.js" type="application/javascript"></script>
    <script src="../../js/extend_inner_obj_attr.js" type="application/javascript"></script>
    <script src="timer.js" type="application/javascript"></script>
    <title>定时器</title>

    <style>
        .div {
            height: 90%;
            width: 95%;
            margin-left: 2.5%;
            margin-top: 3%;
            padding: 0;
        }

        .div_container {
            float: left;
            margin-left: 5em;
            overflow-y: auto;
            height: 90%;
            width: 75%;
        }

        .div_container table {
            margin-top: 2em;
            font-size: 1em;
            color: #999999;
        }

        .div_container table th{
            width: 8em;
            height: 2em;
            text-align: left;
        }

        .div_container table tr{
            height: 2.5em;
        }

        .p_timer {
            font-size: 2em;
        }

        .button_size {
            font-size: 1.5em;
            width: 4em;
            padding: 0;
        }

    </style>

</head>

<body>

<div class="div">
    <div style="float: left">
        <p id="p_timer" class="p_timer">00:00:00:000</p>
        <button class="button button-caution button-pill button_size" onclick="start()">开始</button>
        <button class="button button-caution button-pill button_size" onclick="reset()">复位</button>
    </div>

    <div class="div_container" id="div_container">
        <table id="tb_container">
            <tr>
                <th>ID</th>
                <th>开始时差</th>
                <th>上次时差</th>
                <th style="width: 13em">当前时间</th>
            </tr>
        </table>
    </div>

</div>

<?php
    require ("../footer.php");
?>
</body>
</html>

