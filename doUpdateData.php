<?php 

include_once("config/connection.php");


$productID = $_POST['productID'];
$productDescription = $_POST['productDescription'];
$productPrice = $_POST['productPrice'];
$productName = $_POST['productName'];

$result = array();

$queryUpdate = $connect->query("UPDATE product SET productName = '$productName', productDescription = '$productDescription', productPrice = '$productPrice' WHERE productID = '$productID' ");

if($queryUpdate){
	$result["message"] = "Record has been updated!";
	echo json_encode($result);
}else {
	$result["message"] = "Record failed to delete";
	echo json_encode($result);
}



 ?>