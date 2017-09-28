<?php  //cette fonction pourrait être placée dans un fichier séparé ; il suffirait d'inclure le fichier
  function verifie($j,$m,$a)
  { //récupération de la date du jour avec annee sur 4 chiffres
    $date=date("d/m/Y");
    
    $jour=substr($date,0,2);
	$mois=substr($date,3,2);
	$annee=substr($date,6,4);
	$ok=0;
	if($a>$annee)
	   $ok=1;
	else
      if($a==$annee)
         if($m>$mois)
             $ok=1;
         else
            if($m==$mois)
               if($j>$jour)
                    $ok=1;
  return $ok;					
  
  }


?>

<?php //traitement du formulaire
if(isset($_GET['reserver']))
{ //print_r($_GET);
  if($_GET['nom']==""){
    $erreur_nom="Nom manquant";
  }
  else{
   
   //print $d;
   //rétablissement de la date 
    $m=$_GET['mois'];
	$a=$_GET['annee'];
	$j=$_GET['jour'];
	$d=$a."-".$m."-".$j;
	//on appelle la fonction verifie définie ci-dessus pour vérifier si la date de réservation est antérieure à la date du jour
	//la fonction checkdate est une fonction php qui vérifie si la date est correcte (exemple : 30 février, 31 avril ...
	 if((verifie($j,$m,$a)==0)||(!checkdate($m,$j,$a))) $erreur_date="<span class='txtGras rouge'>mauvaise date</span>";
	 else{

       $query="insert into reservations(nom,date_reservation,heure_reservation,chauffeur,id_taxi)
       values('".$_GET['nom']."','".$d."','".$_GET['heure']."',".$_GET['chauffeur'].",".$_GET['voiture'].")";
   //print $query;
   
      if(sendData($query,$cnx))
         print "<span class=\"gras rouge\">Votre réservation est enregistrée</span> ";
      else
       print "problème grave ";
   }
}	


}
?>


<?php

  $query="select * from taxi";
  //$res=mysqli_query($cnx,$query);
  $res="";
  if(sendQuery($query,$cnx,$res))
  { 
    getData($res,$tabTaxi);
    $n=count($tabTaxi);
  }
  $query="select * from chauffeur";
  //$res=mysqli_query($cnx,$query);
  if(sendQuery($query,$cnx,$res))
  { getData($res,$tabChauffeur);
    $nb=count($tabChauffeur);
  
  }
?>  


<h1>Réservations</h1>
<h4>Réservez ici votre taxi </h4>
<?php if(isset($erreur_nom)) print "<span class=\"rouge\">".$erreur_nom."</span>"; 
if (isset($erreur_date)) print "<span class=\"rouge\">".$erreur_date."</span>";?>
<form action="index.php" method="get" >
<table>
<tr>
  <td><label for="nom">NOM :</label></td>
  <td><input type="text" name="nom" />
  <?php if(isset($erreur_nom)) print "<span class=\"rouge\">*</span>"; ?>
  </td>
</tr>
<tr>
  <td><label for="date">Date :</label></td>
  <td><select name="jour">
      <option value=""></option>
      <?php for($i=1;$i<=31;$i++){
	         ?><option value="<?php print $i; ?>"><?php print $i; ?></option>    
	   <?php } ?> 
	  </select>		 
      <select name="mois">
	  <option value=""></option>
      <?php for($i=1;$i<=12;$i++){
	         ?><option value="<?php print $i; ?>"><?php print $i; ?></option>    
	   <?php } ?> 
	  </select>
	  <select name="annee">
	  <option value=""></option>
      <?php for($i=2016;$i<=2017;$i++){
	         ?><option value="<?php print $i; ?>"><?php print $i; ?></option>    
	   <?php } ?> 
	  </select> <?php if (isset($erreur_date)) print "<span class=\"rouge\">*</span>"; ?>
   </td>
</tr>
<tr>
  <td><label for="heure">HEURE :</label></td>
  <td><input type="text" name="heure"/></td>
</tr>
<tr>
<td>Préférence de taxi<br/>(sous réserve de disponibilité)</td>
<td><select name="voiture">
<option value="">Votre choix</option>
<?php
for($i=0;$i<$n;$i++)
{ ?><option value="<?php print $tabTaxi[$i]['id_taxi']; ?>">
    <?php print $tabTaxi[$i]['marque']."-".utf8_encode($tabTaxi[$i]['modele']); ?>
	</option>
<?php }
?>
</select>
</td>
</tr>
<tr>
<td>Un chauffeur préféré ? <br/>(sous réserve de disponibilité)</td>
<td><select name="chauffeur">
    <option value="">Votre choix</option>
    <?php for($i=0;$i<$nb;$i++)
     { ?><option value="<?php print $tabChauffeur[$i]['id_chauffeur']; ?>">
    <?php print $tabChauffeur[$i]['nom_chauffeur']; ?>
	</option>
<?php }
?>	
	</select>
</td>
</tr>
<tr>
<td><input type="submit" name="reserver" value="Réserver"/></td>
<td><input type="reset" name="annuler" value="Annuler"/></td>
</tr>

</table>
</form>