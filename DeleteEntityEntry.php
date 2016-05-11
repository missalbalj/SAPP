<?php

    $dbName = '2_sbm_auto_pro';
	include(dirname(__FILE__)."/../Connect.php");

    $qry_delete = "DELETE FROM ".$TableName." WHERE ".$Condition;
    
    $result = mysqli_query($con,$qry_delete);	
	if(!$result){		
		echo "<br>Error in DELETE<br>";
	}else{
		echo "<br>DELETE successful<br>";
	}

?>