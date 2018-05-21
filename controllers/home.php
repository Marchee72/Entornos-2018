<?php
 //$action = $_GET["action"];
 
 class home{
 //include('../templates/header.php');
 //if(isset($action)){
//	 if($action == "home") {
	
	function init(){
		print("soy el iniciador de " . get_class($this));
	}
	
	function dashboard(){
	include('templates/inicio.html');	
	}
	
 }
?>