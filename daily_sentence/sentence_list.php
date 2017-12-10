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
    <link href="../3rdlib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/flat-ui-master/dist/css/flat-ui.min.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/bootsrtap-buttons.css" rel="stylesheet" type="text/css">

    <script src="../3rdlib/tether-1.3.3/dist/js/tether.min.js" type="application/javascript"></script>
    <script src="../js/jquery/jquery.min.js" type="application/javascript"></script>
    <script src="../3rdlib/bootstrap/js/bootstrap.min.js" type="application/javascript"></script>
    <script src="../3rdlib/flat-ui-master/dist/js/flat-ui.min.js" type="application/javascript"></script>
    <script src="../3rdlib/layer-master/layer.js" type="application/javascript"></script>
    <script src="../js/extend_inner_obj_attr.js" type="application/javascript"></script>
    <script src="../login/login.js" type="application/javascript"></script>
    <script src="../js/mix.js" type="application/javascript"></script>
    <script src="../js/log.js" type="application/javascript"></script>
    <script src="./template_sentence_list_pc_tb_row.js" type="application/javascript"></script>
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

        .div table{
            width: 100%;
          }

        .div table tr{
            height: 4em;
        }

        .td_column_1 {
            width: 5%;
        }

        .td_column_2 {
            text-align: left;
            width: 20%;
        }

        .td_column_3 {
            text-align: left;
            width: 18%;
        }

        .td_column_4 {
            text-align: left;
            width: 52%;
        }

        .td_tel{
            text-align: left;
            width: 95%;
        }

        .p_title{
            color: #999999;
            display: inline;
        }

    </style>

    <script>
        var g_is_tel = false;
        var g_index = 0;
        var g_once_read_count = 20;
        var g_total_count = 0;

        if(!is_pc()){
            g_is_tel = true;
            g_once_read_count = 10;
        }

        function show_next_page_bt(is_show) {
            if(is_show){
                $("#bt_next_page").css("visibility", "visible");
            }
            else{
                $("#bt_next_page").css("visibility", "hidden");
            }
        }

        function get_sentence_list() {
            $.ajax({
                method: "POST",
                url: "./sentence_list_get.php",
                data: {
                    md5:get_user_md5(),
                    index:g_index,
                    is_pc:!g_is_tel
                },
                dataType: "html",

                success: function (data) {
                    if(data.length == 0){
                        return;
                    }

                    var t_arr = JSON.parse(data);
                    var t_list = JSON.parse(t_arr["list"]);
                    var t_count = 0;
                    var t_total_count = t_arr["total_count"];

                    tel_show_total_count(t_total_count);

                    if(!t_list){
                        return;
                    }

                    t_list.forEach(function (item) {
                        ++t_count;
                        add_item(JSON.parse(item), g_total_count + t_count, t_total_count);
                    });

                    if((t_total_count > g_once_read_count)
                        && ((g_total_count + g_once_read_count) < t_total_count)){
                        g_total_count += g_once_read_count;
                        show_next_page_bt(true);
                    }
                    else{
                        g_total_count = t_total_count;
                        show_next_page_bt(false);
                    }
                },

                error: function (jqXHR, textStatus, errorThrown) {
                    alert("{0}, {1}, {2}".format(jqXHR, textStatus, errorThrown));
                }
            });
        }

        function add_item(item, count, total_count) {
            var row = null;
            g_index = item["id"];
            if(g_is_tel){
                row = tb_row_tel.get_multi_lines().format(
                    item["book_name"],
                    item["author"],
                    item["title"],
                    item["content"],
                    g_index
                );
                $("#tb_content").append(row);
            }
            else{
                row = tb_row_pc.get_multi_lines().format(
                    item["book_name"],
                    item["author"],
                    item["type1"],
                    item["type2"],
                    item["date"],
                    item["title"],
                    item["content"],
                    count,
                    total_count,
                    g_index
                );
                $("#tb_content").append(row);
            }

            if(count % 2 == 0){
                $("#"+g_index).css("background-color", "rgba(153, 153, 255, 0.35)");
            }
            else{
                $("#"+g_index).css("background-color", "rgba(153, 204, 153, 0.35)");
            }
        }

        function tel_show_total_count(total_count) {
            if(g_is_tel){
                var t_p = tel_total_nums.get_multi_lines().format(total_count);
                $("#total_num_tel").empty();
                $("#total_num_tel").append(t_p);
            }
        }
        
        function next_page() {
            get_sentence_list();
        }

        //检查登录
        function pop_window() {
            //提示登录
            layer.open({
                type: 2,
                offset: 0,
                shift: 6,
                area: ['400px', '500px'],
                fix: false, //不固定
                maxmin: true,
                content: '../login/index.html?arg1=auto_close',
                cancel: function () {
                    if(!get_user_info()){
                        alert("本页面必须先登录才能进行后续操作，否则请关闭页面");
                        is_login();
                    }
                    else{
                        location.reload();
                    }
                }
            });
        }

        function is_login() {
            var tmp = get_user_info();
            if (tmp) {
                get_sentence_list();
                return;
            }
            pop_window();
        }
    </script>
</head>

<body class="bg">
<?php require "header.html";?>

<div class="div">
    <div id="total_num_tel">
    </div>
<table id="tb_content"></table>
</div>
<button id="bt_next_page" class="btn btn-default" style="margin-top: 0.5em; width: 10em; visibility: hidden" onclick="next_page();">下一页</button>

<script>
    is_login();
</script>

</body>
</html>

