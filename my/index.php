<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="../js/jquery/jquery.min.js" type="application/javascript"></script>
    <script src="../js/extend_inner_obj_attr.js" type="application/javascript"></script>

    <script>
        function is_pc() {
            var userAgentInfo = navigator.userAgent;
            var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPod", "iPadMini"]; //"iPad",
            var flag = true;
            for (var v = 0; v < Agents.length; v++) {
                if (userAgentInfo.indexOf(Agents[v]) > 0) {
                    flag = false;
                    break;
                }
            }
            return flag;
        }

        function show_style_by_screen() {
            if(is_pc()){
                window.location.href = "index_widescreen.php";
            }
            else{
                window.location.href = "./index_portraitscreen.php";
            }
            //alert("width:"+w+". height:"+h);
        }

        function start_timedown() {
            var total_time = 11;
            var handle = window.setInterval(function () {
                total_time -= 1;
                $("#hint").html("页面将在 {0}秒 后跳转...".format(total_time));

                if(total_time == 0){
                    window.clearInterval(handle);
                    show_style_by_screen();
                }
            }, 1000);
        }
    </script>
</head>

<body>

<div>
    <p>使用流量朋友：接下来主页需要加载5MB左右的资源，并且切换歌曲也需要流量</p>
    <p id="hint">页面将在10秒后自动跳转</p>
    <a href="#hint" onclick="show_style_by_screen()">点击链接立即跳转</a>
</div>

<script>
    start_timedown();
</script>
</body>

</html>
