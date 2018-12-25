<?php 

include_once("config/connection.php");

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : false;

$search = "WHERE productName LIKE '%$keyword%' OR productDescription LIKE '%$keyword%'";

$queryResult = $connect->query("SELECT * FROM product $search");
$result = null;
$result = array();

while($fetchData = $queryResult->fetch_assoc()){
	$result[] = $fetchData;
}

$hasil = array_values($result);

echo json_encode($hasil);
 ?>