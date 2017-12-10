<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../resource/icon/icon_1.png" rel="icon" type="image/x-icon">
    <link href="../3rdlib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/flat-ui-master/dist/css/flat-ui.min.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/bootsrtap-buttons.css" rel="stylesheet" type="text/css">
    <link href="../css/global.css" rel="stylesheet" type="text/css">

    <script src="../3rdlib/tether-1.3.3/dist/js/tether.min.js" type="application/javascript"></script>
    <script src="../js/jquery/jquery.min.js" type="application/javascript"></script>
    <script src="../3rdlib/bootstrap/js/bootstrap.min.js" type="application/javascript"></script>
    <script src="../3rdlib/flat-ui-master/dist/js/flat-ui.min.js" type="application/javascript"></script>
    <script src="../js/extend_inner_obj_attr.js" type="application/javascript"></script>
    <script src="../3rdlib/layer-master/layer.js" type="application/javascript"></script>
    <script src="../js/log.js" type="application/javascript"></script>
    <script src="../login/login.js" type="application/javascript"></script>
    <script src="../js/mix.js" type="application/javascript"></script>

    <title>每日一句-后台</title>

    <style>
        .bg{
            margin: 0 auto;
            vertical-align: middle;
            background-color: rgba(204, 204, 250, 0.5);
        }

        .div{
            margin-left: 1em;
            width: 95%;
        }

        .div_content{
            overflow-y: auto;
            height: 60%;
            margin-top: 1em
        }

        .my_input_box_title{
            width: 20em;
        }

        .my_input_box_content{
            width: 30em;
            height: 7em;
        }

        .my_button{
            width: 8em;
            vertical-align: bottom;
        }

        .my_button_small{
            padding: 0;
            width: 5em;
            height: 2em;
            margin-left: 1em;
        }

        #login_ret {
            font-size: 0.8em;
            color: #0099CC;
            font-style: italic;
        }

        .select{
            background: rgba(204, 204, 204, 0.5);
            height: 2em;
            display: block;
            border-radius: 0.2em;
        }

        .select option{
            display: inline-block;
            background: #CCCCFA;
            line-height: 3em;
        }

    </style>

    <script>
        function change_style(ctl_id, class_name, is_add) {
            if(is_add){$(ctl_id).addClass(class_name);}
            else {$(ctl_id).removeClass(class_name);}
        }

        function check() {
            change_style("#taken_from", "error_input_box", false);
            change_style("#author", "error_input_box", false);
            change_style("#content", "error_input_box", false);
            $("#error_hint").html("");

            if(!get_user_md5()){
                $("#error_hint").html("抱歉，你不能提交页面，因为读取不到用户信息");
                return false;
            }

            var s1 = $("#sentence_type_1").val();
            var s2 = $("#sentence_type_2").val();
            if(s1 == null || s1 <= 0 ||
                    s2 == null || s2 <= 0){
                $("#error_hint").html("请选择一个选项");
                return false;
            }

            var tmp = $("#taken_from").val().length;
            if(tmp > 64 || tmp == 0){
                change_style("#taken_from", "error_input_box", true);
                $("#error_hint").html("摘自必填，但不能超过 64 个字符");
                return false;
            }

            tmp = $("#author").val().length;
            if(tmp > 32 || tmp == 0){
                change_style("#author", "error_input_box", true);
                $("#error_hint").html("作者必填，但不能超过 32 个字符");
                return false;
            }

            tmp = $("#content").val().length;
            if(tmp > 1000 || tmp == 0){
                change_style("#content", "error_input_box", true);
                $("#error_hint").html("内容必填，但不能超过 1000 个字符");
                return false;
            }

            return true;
        }
        
        function commit() {
            if(!check()){return;}

//            enabled_button("bt_commit", true);
//            countdown_for_ctl("bt_commit", 10, true, function () {
//            });

            $.ajax({
                method: "POST",
                url: "./backg_submit.php",
                data: {
                    md5: get_user_md5(),
                    taken_from: $("#taken_from").val(),
                    author: $("#author").val(),
                    content: $("#content").val(),
                    title: $("#title").val(),
                    sentence_type_1: $("#sentence_type_1").val(),
                    sentence_type_2: $("#sentence_type_2").val()
                },
                dataType: "html",

                success: function (data) {
                    var tmp = JSON.parse(data);
                    if(tmp["code"] == "ok"){
                        alert("很高兴你完成了一次录入");
                        $("#content").val("");
                        $("#title").val("");
                    }
                    else{
                        $("#error_hint").html(tmp["code"]);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("{0}, {1}, {2}".format(jqXHR, textStatus, errorThrown));
                }
            });
        }

        function get_constant_data() {
            $.ajax({
                method: "POST",
                url: "./read_constant_data.php",

                success: function (data) {
                    var root = JSON.parse(data);
                    var val1 = root["table_name_1"];
                    var val2 = root["table_name_2"];
                    var ctl1 = $("#sentence_type_1");
                    var ctl2 = $("#sentence_type_2");

                    for (var i in val1) {
                        var option = $("<option>").val(i).text(val1[i]);
                        ctl1.append(option);
                    }
                    for (var i in val2) {
                        var option = $("<option>").val(i).text(val2[i]);
                        ctl2.append(option);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("{0}, {1}, {2}".format(jqXHR, textStatus, errorThrown));
                }
            });
        }
        
        function my_clear() {
            $("#taken_from").val("");
            $("#title").val("");
            $("#author").val("");
            $("#create_date").val("");
            $("#content").val("");
            $("#sentence_type_1").val(0);
            $("#sentence_type_2").val(0);
        }
    </script>

</head>
<body class="bg">

<?php require "header.html";?>

<div id="main_div" class="div">

    <select id="sentence_type_1"  tabindex="4" class="select" style="margin-top: 1em">
        <option value="0">请选择一个吧</option>
    </select>
    <br>
    <select id="sentence_type_2"  tabindex="5" class="select" style="margin-top: 0.8em">
        <option value="0">请选择一个吧</option>
    </select>

    <input id="taken_from" tabindex="1" type="text" placeholder="摘自《书名》" class="form-control my_input_box_title" style="display: inline-block;margin-top: 1.3em"/>
    <br>
    <input id="title" tabindex="2" type="text" placeholder="标题" class="form-control my_input_box_title" style="display: inline-block; margin-top: 1em"/>
    <br>
    <input id="author" tabindex="2" type="text" placeholder="作者" class="form-control my_input_box_title" style="display: inline-block; margin-top: 1em"/>
    <br>
    <input id="create_date" disabled type="date" class="form-control my_input_box_title" style="display: inline-block; margin-top: 1em"/>

    <div class="div_content">
        <textarea id="content" tabindex="3" cols="20" rows="10" placeholder="内容, 最多5000字" class="form-control my_input_box_content"></textarea>
    </div>
    <br>
    <button id="bt_commit" tabindex="6" class="btn btn-primary my_button" onclick="commit();">提交</button>
    <button id="bt_clear" class="btn btn-primary my_button_small" onclick="my_clear();">清空</button>
    <p>您添加的内容会被随机分享给其他朋友，请勿提交与自己隐私相关的任何文字，也请不要提交 黄、赌、毒、政治 相关内容，谢谢！</p>
    <p id="error_hint" class="p_error_hint"></p>
</div>

<script>
    //设置时间
    document.getElementById("create_date").valueAsDate = new Date();

    function is_login() {
        var tmp = get_user_info();
        if(tmp){
            get_constant_data();
            return;
        }
        pop_window();
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
    is_login();

    if(!is_pc()){
        $("#main_div").css("margin-left", "0.5em");
    }

</script>
</body>
</html>