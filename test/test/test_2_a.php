<?php
/**
 * Created by PhpStorm.
 * User: oiooooio
 * Date: 2016/8/7
 * Time: 12:58
 */
$n1 = $_REQUEST["n1"];
$n2 = $_REQUEST["n2"];
$n3 = $_REQUEST["n3"];

echo "$n1"."<br>";
echo "$n2"."<br>";
echo "$n3"."<br>";

echo "<hr>";
echo "创建一个数组，数组内容rand，并且排序输出:"."<br>";

$tmp_a = [$n1, $n2, $n3];

for ($i = 0; $i < 10; ++$i){
    array_unshift($tmp_a, rand(1, 999));
}
sort($tmp_a);

for ($i = 0; $i < count($tmp_a); ++$i){
    echo "$tmp_a[$i]"."<br>";
}


?>

