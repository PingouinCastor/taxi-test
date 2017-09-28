<?php 
function sendData($query,$cnx){
	$query=htmlentities($query);
    $result = mysqli_query($cnx,$query);	
	if($result){			
		return true;
	}	
	return false; 
}

function sendQuery($query,$cnx,&$result){
		$query=htmlentities($query);
		$result = mysqli_query($cnx, $query);
		if($result){			
		  return $result;
		}
		else { 
         return false;
       } 
   }

function getData($result, &$tab){
 // conversion de la variable $tab en tableau
	$tab = array();	
 for ($i=0; $i< mysqli_num_rows($result); $i++) {
   $tab[$i]=mysqli_fetch_array($result);
 }
}
?>
