<?php
if(isset($_GET['action'])){
    if($_GET['action']=="delete"){
   $query2="update chauffeur set suppression_logique=1 where id_chauffeur=".$_GET['id'];
   //print $query2;
      
   }
   else
   { $query2="update chauffeur set suppression_logique=0";
        
   }
 //$res=mysqli_query($cnx,$query2);
  if(!sendData($query2,$cnx)) print "probleme";
   }
 $query="select * from chauffeur";
  if(sendQuery($query,$cnx,$result)){
      getData($result,$tab);
      $nb=count($tab);	  
  

 ?> 
	<h4 class="gras">Nos chauffeurs</h4>
	<table class="marge">
	 <?php 
	    $cpt=0;
        for($i=0;$i<$nb;$i++)
        { if($tab[$i]['suppression_logique']==0){
           ?><tr>
		     <td><img src="./images/<?php print $tab[$i]['photo'];?>"/></td>
		     <td class="vertical_orange"><?php print $tab[$i]['nom_chauffeur']; ?> </td>
			 <td class="vertical_orange"><?php print utf8_encode($tab[$i]['experience']); ?></td>
			 <td class="vertical_orange"><a href="index.php?action=delete&id=<?php print $tab[$i]['id_chauffeur'];?>"><img src="./images/delete.jpg"/></a></td>
             </tr>			  
	    <?php 
		}
		else $cpt++;
		}
		?>
		<?php
		  if($cpt>0){ ?>
	      <tr><td colspan="4"><a href="index.php?action=afficher">R&eacute;afficher</a></td></a>
          <?php }
		  ?>
	
	
	</table>
	
	
	<?php
	
	
	
	}
?>

	