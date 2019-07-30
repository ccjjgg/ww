<?php
// 创建一个新cURL资源
$ch = curl_init();

// 设置URL和相应的选项
curl_setopt($ch, CURLOPT_URL, "https://news.baidu.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//$preg = "#.*<a href=\".*\" target=\".*\" mon=\".*\">(.*)</a>.*#isU";
$preg = "#.*<div class=\"l-left-col\" alog-group=\"focus-top-left\">.*<ul class=\"ulist focuslistnews\">.*<li>.*<a href=\".*\" target=\".*\">(.*)</a>.*</li>.*</ul>.*</div>.*#isU";
// 抓取URL并把它传递给浏览器
$res = curl_exec($ch);
preg_match_all($preg,$res,$arr);

$sql = "insert into fool VALUES ";
foreach ($arr as $key => $value){
    $sql.= "('null','$key','null','null','null'),";
}
$sql = substr($sql,0,-1);
include('pdo.class.php');
$dbh = new PDO('mysql:host=127.0.0.1;dbname=1704phpa', 'root', 'root');
$stmt = $dbh->exec($sql);

