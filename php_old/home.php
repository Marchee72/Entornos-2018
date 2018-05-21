<?php
 $action = $_GET["action"];
 
 include('../templates/header.php');
 if(isset($action)){
	 if($action == "home") {
		  include('../templates/inicio.html');
	 }else{
	 include_once($action.'.php');	 
	 }
}else{
	header("Location:home.php?action=home");
}
 include('../templates/footer.php');

?>