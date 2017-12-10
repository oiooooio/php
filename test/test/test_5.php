<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>哈哈，小测试</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />

    <script src="../../js/jquery/jquery.min.js" type="application/javascript"></script>

    <style>
        .div {
            margin-top: 10%;
            width: 100%;
            height: 80%;
            text-align: center;
            vertical-align: middle;
        }

        table {
            margin-left: 13%;
            border: solid 1px rgba(50, 50, 50, 0.20);
            font-size: 1em;
            color: #999999;
            border-collapse:collapse;
            overflow: hidden;
        }

        /*调整间距*/
        table tr{
            height: 2em;
        }

        /*调整列*/
        table td {
            border: solid 1px rgba(22, 54, 113, 0.33);
            text-align: left;
            vertical-align: middle;
            padding-left: 0.5em;
            padding-right: 0.5em;
        }

        /*调整按钮*/
        button{
            margin-left: 10px;
            height: 3em;
            width: 7em;
        }
    </style>

    <script>
        var _g_all_equations = {};
        var _g_index = 0;

        /** 格式化输入字符串**/
        //用法: "hello{0}".format('world')；返回'hello world'
        String.prototype.format= function(){
            var args = arguments;
            return this.replace(/\{(\d+)\}/g,function(s,i){
                return args[i];
            });
        };

        /**
         * @return {number}
         */
        function random(x, y) {
            var v = Math.floor(Math.random() * y);
            if(v < x)
                return x+v;
            return v;
        }

        //    添加到表格
        function ui_add_item(id, des) {
            var template_format = "<tr><td>{0}</td><td><form action=\"\"><input type=\"text\" id=\"_input_{1}\"></form></td></tr>";
            $("#_table_1").append(template_format.format(des, id)); //控件id
        }

        //    添加算式
        //    分别是，符号左值，右值，以及结果，des是字符串如 "a+b=ret"
        function add_equation(a, b, ret, des) {
            var equation = {};
            equation.a = a;
            equation.b = b;
            equation.ret = ret;
            equation.des = des;
            equation.id = ++_g_index;
            _g_all_equations[equation.id] = equation;

            ui_add_item(equation.id, des);
        }

        //        随机生成公式
        function generate_equation(min_v, max_v, count) {
            for (var i = 0; i < count; ++i){
                var a = random(10, 20);
                var b = random(1, 9);

                if(a > b)
                    add_equation(a, b, a-b, "{0}-{1} =".format(a,b));
                else
                    add_equation(a, b, a+b, "{0}+{1} =".format(a,b));
            }
        }

        //        按钮事件:重来
        function reset() {
            location.replace(location.href);
        }

        //        按钮事件：计算分数
        function calc_ret() {
            var score = 100;
            for(var key in _g_all_equations){
                var equation = _g_all_equations[key];
                var ret = -99999;
                if($("#_input_{0}".format(key)).val())
                    ret = Number($("#_input_{0}".format(key)).val());
                if(equation.ret !== ret){
                    score -= 10;
                    $("#_input_{0}".format(key)).css("background-color","#ffa1ad");
                }
                else
                    $("#_input_{0}".format(key)).css("background-color","#008f42");
            }
            $("#_p_1").text("得分为：{0}".format(score));
        }
    </script>
</head>

<body>

<div class="div">
    <table id="_table_1">
        <tr>
            <td>公式</td>
            <td>请输入答案</td>
        </tr>
    </table>
    <p id="_p_1">加油哦!</p>
</div>

<div style="margin: auto 0; vertical-align: middle; text-align: center">
    <button onclick="reset()">重来</button>
    <button onclick="calc_ret()">计算</button>
</div>

<script>
    generate_equation(10, 30, 10);
</script>

</body>

</html>
