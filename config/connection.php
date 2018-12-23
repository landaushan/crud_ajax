<?php 

	$connect = new mysqli("localhost","root","","ajax");

	if(!$connect){
		echo "Connection error";
		exit();
	}

 ?>