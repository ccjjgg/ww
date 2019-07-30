<?php
$page = isset($_GET['page'])?$_GET['page']:1;
$size = 3;
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
if(file_exists($redis)){
    $redis->get($data,"prev=>$prev,next=>$next,sumpage=>$sumpage,data=>$data,page=>$page");
    json_encode($reslut);
}else{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=1704phpa', 'root', 'root');
    $dbh->exec("set names utf8");
    $sql = "select * from user";
    $countstmt = $dbh->query($sql);
    $countpage = $countstmt->rowCount();
    $sumpage = celi($countpage/$size);
    $prev = ($page-1)<1?1:$page-1;
    $next = ($page+1)>$sumpage?$sumpage:$page+1;
    $limit = ($page-1)*$size;
    $sql = "select * from user limit $limit,$size";
    $stmt = $dbh->query($sql);
    $data = $stmt->fetchAll(2);
    $reslut = $redis->set($data,"prev=>$prev,next=>$next,sumpage=>$sumpage,data=>$data,page=>$page");
    json_encode($reslut);
}
