<?php
  session_start();
?>
<?php
  if (file_exists("./lib/php/connect.php")){
    include "./lib/php/connect.php";
  }
  if(file_exists("./lib/php/fonctions_serveur.php"))
  {  include "./lib/php/fonctions_serveur.php";
  }
?>  
<!DOCTYPE html>
<html>
	<head>
		<title>Taxi Service Online - TSO</title>
		<link rel="stylesheet" type="text/css" href="./lib/css/taxi2.css" />
		<meta charset="utf-8" />
	</head>
	<body>

	<div id="wrapper">
	  <header>
	    <h3 id="enseigne">Taxi Service Online * Location avec chauffeur</h3>
		<figure> 
	
	<img src="./images/header.jpg" alt="bannière" />
		</figure>  
	  </header>
	  
	  <nav id="menu">
	     <?php 
		   if (file_exists("./lib/php/menu.php")){
		   include "./lib/php/menu.php";
		   }
		 ?>  
		  
	  
	  </nav>
	  <section id="contenu">
	   <?php 
	   /* le contenu change en fonction de la navigation*/
	   if(!isset($_SESSION['page'])){
	     $_SESSION['page']="./pages/accueil.php";
		}
      else{		
	   
	   if(isset($_GET['page'])){
	      //print $_GET['page'];
          $_SESSION['page']="./pages/".$_GET['page'];
		  }
		}  
				  
		//print $_SESSION['page'];  
	if(file_exists($_SESSION['page']))
	{ include $_SESSION['page'];
	}
	 else 
        print "OUPS!!!!!";		 
		
       ?>		
	  
	  
	  
	  
	  </section>
	  <footer>
	    footer
	  </footer>
	</div> 
</body>
</html>	