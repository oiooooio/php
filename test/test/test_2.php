<html>
<head>
    <title>test 2</title>

    <style type="text/css">
        body {
            background-color: #ad87ff;
        }

        input {
            width: 15em;
            height: 2em;
        }
    </style>

    <script>
        function func_calc() {
            try{
                var n1_val = document.getElementsByName("n1").value;
                var n2_val = document.getElementsByName("n2").value;
                var n3_val = document.getElementsByName("n3").value;
                var control_r = document.getElementById("label_r");
                document.writeln("111");//+parseInt(n2_val)+parseInt(n3_val)
                control_r.innerHTML = (n1_val + n2_val + n3_val);
            }
            catch(ex){
                alert(ex)
            }
        }
    </script>

</head>
<body class="global">

<!--action="test_2_a.php"-->
<form name="my_form" method="post" >
    <label>number 1:<input type="number" name="n1"></label>
    <br>
    <br>
    <label>number 2:<input type="number" name="n2"></label>
    <br>
    <br>
    <label>number 3:<input type="number" name="n3"></label>
    <br>
    <br>
    <label id="label_r">结果集</label>
    <br>
    <br>
</form>
<button onclick="func_calc()">提交</button>

<table>
    <tr> 1 </tr>
    <tr> 1 </tr>
    <tr> 1 </tr>
</table>


</body>
</html>

