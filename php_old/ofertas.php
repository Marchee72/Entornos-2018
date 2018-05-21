<?php
if(!isset($_GET["action"])){
	header("Location:../php/home.php?action=home");
	}
	
 include('../templates/ofertas.html');
 

?>