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
<!--注册第二步，输入手机验证码以及区域-->
    <div id="register_2" class="div_framework">
        <table class="table">
            <tr>
                <td class="table_td_1">&emsp;验证码</td>
                <td><input class="form-control input"/></td>
            </tr>
            <tr>
                <td class="table_td_1">选择省份</td>
                <td>
                    <select class="form-control select select-primary select-block mbl input" style="padding: 0; margin: 0; margin-right: 3.5em">
                        <option value="0">选择省份</option>
                        <option value="1">江苏省</option>
                        <option value="2">上海市</option>
                        <option value="3">陕西省</option>
                        <option value="4">浙江省</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="table_td_1">选择市区</td>
                <td>
                    <select class="form-control select select-primary select-block mbl input" style="padding: 0; margin: 0; margin-right: 3.5em">
                        <option value="0">选择省份</option>
                        <option value="1">太仓市</option>
                        <option value="2">昆山市</option>
                        <option value="3">上海市</option>
                        <option value="4">其他城市</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="table_td_1">详细地址</td>
                <td><input class="form-control input"/></td>
            </tr>

            <tr>
                <td class="table_td_1">店铺名称</td>
                <td><input class="form-control input"/></td>
            </tr>
        </table>


        <div style="margin-top: 2em">
            <button class="btn btn-primary btn-wide" style="width: 15em; height: 5em">完成注册</button>
        </div>
    </div>

    <script>
        $("select").select2({dropdownCssClass: 'dropdown-inverse'});
    </script>

</body>
</html>

