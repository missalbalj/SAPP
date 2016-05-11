<?php

	$dbName = 'dbName';
	include(dirname(__FILE__)."/../Connect.php");

		$qry_create = "INSERT INTO ".$TableName." (".$FieldName.") VALUES ".$Value;
	
	echo $qry_create. "<br>";
	$result = mysqli_query($con,$qry_create);

	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}	
	if(!$result){
		echo "<br>INSERT error<br>";
		$error_message="Duplicate Entry";
		header('location:'.$previous.'&error='.$error_message);
	}else{
		echo "<br>INSERT successful<br>";
		header('location:http://'.$_SERVER['HTTP_HOST'].'/SAPP/main/CRUD/AjaxSearch/SearchController.php/?table='.$Redirect.'&message='.$message);
	}
?>
