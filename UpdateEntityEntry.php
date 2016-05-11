<?php	

	$dbName = '2_sbm_auto_pro';
	include(dirname(__FILE__)."/../Connect.php");
	
	echo "inside here";
	$qry_update = "UPDATE ".$TableName." SET ".$FieldName." =" .$Value."";
	
	if ($Condition != " "){
		$qry_update.= " WHERE ".$Condition;
	}	

	echo "<br>";

//Error checking and staying in same page to paste error message
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}
    
	echo $qry_update;
    $result = mysqli_query($con,$qry_update);
	if(!$result){		
		echo "<br>Error in UPDATE<br>";
		$error_message="Duplicate Entry";
		header('location:'.$previous.'&error='.$error_message);
	}else{
		// header('location:http://'.$_SERVER['HTTP_HOST'].'/SAPP/main/CRUD/AjaxSearch/SearchController.php/?table='.$Redirect.'&message='.$message);				
	}
	

?>