<?php 

include_once("config/connection.php");

$productID = $_GET['productID'];

$queryResult = $connect->query("SELECT * FROM product WHERE productID = $productID");
$result = array();

$fetchData = $queryResult->fetch_assoc();

$result = $fetchData;

echo json_encode($result);


 ?>