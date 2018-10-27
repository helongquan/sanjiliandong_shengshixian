<?php require("mysqldb.php");
$mydb=new MysqliDB();
$pid=$_POST['pid'];
$sql="select * from cn_area where parentid=$pid;"; 
// echo $sql;exit;
$datas=$mydb->select($sql);
echo json_encode($datas);