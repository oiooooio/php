<?php
/**
 * Created by PhpStorm.
 * User: wangli
 * Date: 2017/11/19
 * Time: 15:50
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="../3rdlib/flat-ui-master/dist/css/flat-ui.css">
    <script src="../js/jquery/jquery.min.js" type="application/javascript"></script>
    <script src="../3rdlib/flat-ui-master/dist/js/flat-ui.min.js" type="application/javascript"></script>

    <style>
        .div_framework {
            margin-top: 20%;
            width: 90%;
            margin-left: 5%;
            height: 60%;
            text-align: center;
            vertical-align: middle;
        }

        .div_item {
            margin-top: 1em;
        }

        .input{
            width: 23em;
            height:3em;
        }

        .select{
            width: 21em;
            height:5em;
        }

        .table{
            margin-left: 13%;
        }

        .table tr{
            height: 4em;
        }

        .table td{
            margin-right: 1em;
            vertical-align: middle;
        }

        .table_td_1{
            width: 10em;
        }
    </style>

</head>
<body>
<!--输入用户名和手机号码-->
    <div id="register_1" class="div_framework">
        <div class="div_item">
            姓&emsp;&emsp;名&emsp;<input class="form-control input"/>
        </div>
        <div class="div_item">
            手机号码&emsp;<input class="form-control input"/>
        </div>

        <div style="margin-top: 2em">
            <button class="btn btn-primary btn-wide" style="width: 15em; height: 5em" onclick="on_register_1();">注&emsp;&emsp;册</button>
        </div>
    </div>

    <script>
        $("select").select2({dropdownCssClass: 'dropdown-inverse'});
        
        function on_register_1() {
            location.href = "./register_2.php";
        }
    </script>

</body>
</html>

