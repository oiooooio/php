<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/10/2
 * Time: 17:02
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./icon.png" rel="icon" type="image/x-icon">
    <link href="../css/global.css" rel="stylesheet" type="text/css">
    <link href="../3rdlib/bootsrtap-buttons.css" rel="stylesheet" type="text/css">

    <script src="../js/jquery/jquery.min.js" type="application/javascript"></script>
    <script src="../js/extend_inner_obj_attr.js" type="application/javascript"></script>
    <title>TOOLS</title>

    <style>
        .div {
            height: 70%;
            width: 70%;
            margin-left: 12%;
            margin-top: 7%;
            padding: 0;
        }

        .div table {
            margin-top: 2em;
            font-size: 1em;
            color: #999999;
        }

        .div table td{
            height: 6em;
            width: 6em;
            text-align: center;
            vertical-align: middle;
        }

        .div table td div{
            height: 6em;
            width: 6em;
            background-size: cover;
            background-image: url('./timer/icon.png');
        }
    </style>
</head>

<body>

<div class="div">
    <table>
        <tr>
            <td>
                <a href="./timer/timer.php">
                    <div></div>
                </a>
                <p>定时器</p>
            </td>
        </tr>
    </table>
</div>


<?php
    require ("./footer.php");
?>
</body>
</html>

