<?php
class MysqliDB {
private $conn;
function __construct(){
	$conn=mysqli_connect('localhost','root','','test');
	if(!$conn){
		die("连接失败".mysqli_connect_error());
	}
	mysqli_query($conn,'set names utf8');
	$this->conn=$conn;
}
function select($sql){
	$result=mysqli_query($this->conn,$sql);
	$data=array();
	// var_dump($result);exit;
	while( $arr=mysqli_fetch_assoc($result) ){
		$data[]=$arr;
	}
	mysqli_close($this->conn);
	return $data;
}
}
?>