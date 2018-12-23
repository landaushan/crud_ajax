<?php 

include_once("config/connection.php");

$queryResult = $connect->query("SELECT * FROM product");
$result = array();

while($fetchData = $queryResult->fetch_assoc()){
	$result[] = $fetchData;
}

$arraybaru = array_values($result);


echo json_encode($result);



 ?>