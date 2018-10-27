<?php
header("Content-type: text/html; charset=utf-8");
require("mysqldb.php");
$mydb=new MysqliDB();
//print_r($_POST);exit; 
$sql="select * from cn_area where id IN(".$_POST['pro'].",".$_POST['city'].",".$_POST['county'].");";
// echo $sql;exit; 
$datas=$mydb->select($sql);
// echo "<pre>"; 
// print_r($datas);exit; 
$addr="";
foreach( $datas as $v){
	$addr .= $v['areaname'];
}
echo "您选则的地址为：".$addr."<br/>";
echo "<a href='#' onclick='window.history.back();'>点击返回</a>";