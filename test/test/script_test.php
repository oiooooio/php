<html>
<head>
    <title>script test</title>

    <script type="text/javascript">
        function test_1() {
            document.writeIn("call test_1() func.");
        }
    </script>

    <style media="screen AND (max-width:1024px)" type="text/css">
        body {
            background-color: #ad87ff;
        }
    </style>

    <style media="screen AND (min-width:1366px)" type="text/css">
        body {
            background-color: #7bc7ff;
        }
    </style>

    <style>
        div {
            border: #ff42bc dotted;
        }

        div > p {
            background-color: aliceblue;
        }

        div > p > code {
            font-size: 2em;
        }
    </style>
</head>
<body>
<button onclick="test_1()">点我</button>

<figure>
    <p>
        <code>
            A struct cannot be abstract and is always implicitly sealed.
            <br>
            struct不能为abstract，而应始终为隐式sealed。
        </code>
    </p>
</figure>

<br>
<br>

<div>
    div-123
    <p>
        p-123
        <code>
            <br>
            code:
            <br>
            A struct cannot be abstract and is always implicitly sealed.
            <br>
            struct不能为abstract，而应始终为隐式sealed。
        </code>
    </p>

    <code>
        this is a test
    </code>

    <br>
    <br>
    <hr>
    <form onsubmit="return false"
        oninput="res.value = a.valueAsNumber * b.valueAsNumber">
        <input type="number" id="a" name="a"/> *
        <input type="number" id="b" name="b"/> =
        <output for="a name" id="res" name="res"/>
        <!-- 不能正常运行，这段代码!-->
    </form>

</div>

</body>
</html>