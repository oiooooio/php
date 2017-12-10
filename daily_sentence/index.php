<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016-10-9
 * Time: 21:32:02
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../resource/icon/icon_1.png" rel="icon" type="image/x-icon">
    <link href="../css/global.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/bootsrtap-buttons.css" rel="stylesheet" type="text/css">

    <script src="../js/jquery/jquery.min.js" type="application/javascript"></script>
    <script src="../js/extend_inner_obj_attr.js" type="application/javascript"></script>
    <title>每日一句</title>

    <style>
        .bg {
            background-color: #CCCCFF;
            margin: auto 0;
            vertical-align: middle;
            text-align: center;
            padding: 0;
            overflow: hidden;
        }

        .div {
            font-family: 'my_font_mnjxls', serif;
            height: 100%;
            width: 95%;
            margin-left: 2.5%;
            padding: 0;
            overflow-y: auto;
            line-height: 1.5em;
        }

        .p {
            line-height: 2em;
            text-align: left;
            /*text-indent: 2em;*/
        }

        .p_right{
            text-align: right;
            margin: 0;
        }

    </style>
</head>

<body class="bg">
<?php require "header.html";?>

<div class="div">
    <h5 id="title" class="p" style="text-align: center; margin-top: 0"></h5>
    <div id="content">
    </div>
    <p class="p_right" id="book_name" style="margin-top: 2em"></p>
    <p class="p_right" id="author"></p>
    <p class="p_right" id="type_"></p>
    <p class="p_right" id="create_time" style="color: #999999;"></p>
</div>

<script>
    $.ajax({
        method: "POST",
        url: "./index_get.php",
        data: {
        },
        dataType: "html",

        success: function (data) {
            if(data.length == 0){
                return;
            }
            var tmp = JSON.parse(data);
            $("#title").html(tmp["title"]);
            $("#content").html(tmp["content"]);
            $("#book_name").html(tmp["book_name"]);
            $("#author").html(tmp["author"]);
            $("#type_").html(tmp["type1"] + " " + tmp["type2"]);
            $("#create_time").html(tmp["create_date"]);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("{0}, {1}, {2}".format(jqXHR, textStatus, errorThrown));
        }
    });
</script>

</body>
</html>

