<?php
 //$action = $_GET["action"];
 
 class ofertas{
 //include('../templates/header.php');
 //if(isset($action)){
//	 if($action == "home") {
	
	function init(){
		print("soy el iniciador de " . get_class($this));
	}
	
	function listar(){
		include_once("templates/ofertas.html");
	}
	
	//	 }else{
//	 include_once($action.'.php');	 
//	 }
//}else{
//	header("Location:home.php?action=home");
//}
// include('../templates/footer.php');

 }
?>