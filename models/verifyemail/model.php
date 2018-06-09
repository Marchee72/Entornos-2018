<?php
require("models/abstractModel.php");

 class model extends abstractModel{
	 

static function resendValidationEmail($user_id){
	$conn = connect();
	if(!$conn) 
		return mysqli_error_list($conn);
		print($user_id);
		$sql = "SELECT hash_validacion from usuarios where id='$user_id'";
		$resultado = mysqli_query($conn, $sql);
		$r = mysqli_fetch_assoc($resultado);
		$hash = $r["hash_validacion"];
		$email = $_SESSION["email"];
		utils::enviarMailValidacion($email,$hash);
		mysqli_close($conn);
}		
		
function __construct(){
//	echo("model loaded");
	parent::__construct();
}


}


?>