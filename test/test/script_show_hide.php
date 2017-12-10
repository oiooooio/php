<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/8/13
 * Time: 13:32
 */
?>


<html>
<head>
    <title>script test</title>
    <script>
        var show_hide_control_switch = function(){
            var control_label = document.getElementById("label_test");
            var control_bt = document.getElementById("bt_toggle");
            if(control_label.hasAttribute("hidden")){
                control_label.removeAttribute("hidden");
                control_bt.innerText = "显示";
            }
            else{
                control_label.setAttribute("hidden", "hidden");
                control_bt.innerText = "隐藏";
            }
        }
    </script>
</head>
<body>

<br>
<button id="bt_toggle" onclick="show_hide_control_switch()">隐藏或者显示</button>
<br>
<br>
<label id="label_test" hidden>this is a test.</label>
<br>
<br>

<?php
    echo "好吧，证明PHP确实在运行!\n";
?>

</body>
</html>