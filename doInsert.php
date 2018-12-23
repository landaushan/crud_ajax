<?php 

include_once("config/connection.php");

$result = array();
$result["message"] = "";

$productName        = $_POST['productName'];
$productDescription = $_POST['productDescription'];
$productPrice       = $_POST['productPrice'];

if($productName == ""){
	$result["message"] = "Product Name must be filled!";
}else if($productDescription == ""){
	$result["message"] = "Product Description must be filled!";
}else if($productPrice == ""){
	$result["message"] = "Product Price must be filled!";
}else {
	$queryResult = $connect->query("INSERT INTO product VALUES 
					('','$productName','$productDescription','$productPrice')");

	if($queryResult){
		$result["message"] = "Successfully inserted new data";
	}else {
		$result["message"] = "Failed add new data";
	}
}

echo json_encode($result);

 ?>