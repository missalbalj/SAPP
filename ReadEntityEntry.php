<?php
	
    $dbName = '2_sbm_auto_pro';
	include(dirname(__FILE__)."/../Connect.php");


    ///* get field name variable
	$FieldName = $_GET['field_1'];	
    //construct $Condition using $FieldName
	$query_read = "SELECT * from {$TableName}";
    

	if($Condition != " "){
		$query_read .= " where {$Condition}";
	}
	if($Order != " "){
		$query_read .= " ORDER BY {$Order}";
	}
	// echo $query_read."<br>";

	if(($has_subquery == 1)){
		if($TableName == "machine"){
			//echo "<br>MACHINE:";
			$SubTableName = "rel_machine_machine_type";
			$SubFieldName = "MACHINE_TYPE_ID";
			$SubFieldName2 = "MACHINE_ID";
			$SubConditionValue = $id_fetch;
		}
		if($TableName == "machine_type"){
			//echo "<br>MACHINE TYPE:";
			$SubTableName = "rel_competitor_machine_type";
			$SubFieldName = "COM_ID";
			$SubFieldName2 = "MACHINE_TYPE_ID";
			$SubConditionValue = $com_id;
		}
		if($TableName == "2_sbm_cps.address"){
			//echo "<br>MACHINE TYPE:";
			$SubTableName = "2_sbm_cps.rel_client_address_phone_branch";
			$SubFieldName = "CLIENT_ID";
			$SubFieldName2 = "ADDRESS_ID";
			$SubConditionValue = $com_id;
		}

		$sub_query_read = "SELECT * from $SubTableName WHERE $SubFieldName like $SubConditionValue";
		$query_read = "SELECT A.* FROM $TableName A Inner Join ($sub_query_read) B on A.ID = B.{$SubFieldName2} ";			
	}
	// echo $query_read."<br>";
	$result = mysqli_query($con,$query_read);	       
	if(!$result){
			echo "Something's wrong with ".$query_read."<br>";
	}
	//echo $input_type;
    if($input_type == "dropdown"){     		
	        while($row = mysqli_fetch_array($result)){		       
                $dropdown_values .= '<option value='.$row['ID'].'>'.$row['NAME'].'</option>';    		                
        }
	}else if($input_type == "dropdown_select"){ 
		$i=0;
	    	while($row = mysqli_fetch_array($result)){	    		    	
	    	if($is_multiple == "YES"){
	    		// echo "<br>".$row['ID'].":".$id_fetch_mul[$i];	    		
	    		if($row['ID'] == $id_fetch_mul[$i]){	    			
	    			$dropdown_values .= '<option selected value='.$row['ID'].'>'.$row['NAME'].'</option>';    			    				    				    		
	    			// echo "selected";
	    			$i++;
	    		}else{
	    			$dropdown_values .= '<option value='.$row['ID'].'>'.$row['NAME'].'</option>';    		
	    		}	    			    	
	    	}else{	    		
	    		if($row['ID'] == $id_fetch){
	    			$dropdown_values .= '<option selected value='.$row['ID'].'>'.$row['NAME'].'</option>';	    		  	
	    		}else{
	    			$dropdown_values .= '<option value='.$row['ID'].'>'.$row['NAME'].'</option>';
	    		}
	    	}
        }
	}else if($input_type == "read_id"){
        	$row = mysqli_fetch_array($result);
            $id_fetch = $row['ID'];
        	$name_fetch= $row['NAME'];

	}else if($input_type == "cus_read_id"){		
	//echo "inside here";
        	$row = mysqli_fetch_array($result);
        	$id_fetch = $row[$id_name];
        	//echo $id_fetch;
	}else if($input_type == "cus_mul_read_id"){ 
	//echo "inside here multiple";
	//echo $query_read;
	$is_multiple = "YES";
			$j=0;
        	while($row = mysqli_fetch_array($result)){
        		$id_fetch_mul[$j] = $row[$id_name];
        		// echo $row[$id_name];
        		$j++;
        	}
	}else if($input_type == "cus_row"){ 
        $cus_row_row = mysqli_fetch_array($result);
	}

?>