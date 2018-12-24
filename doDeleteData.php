<?php

include_once("config/connection.php");

$result = array();
$productID = $_POST['productID'];

$queryResult = $connect->query("DELETE FROM product WHERE productID = $productID");


if($queryResult){
	$result["message"] = "Data successfully deleted !";
	echo json_encode($result);
}else {
	$result["message"] = "Data failed to delete";
	echo json_encode($result);
}


 ?>