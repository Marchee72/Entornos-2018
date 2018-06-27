<?php
require("models/abstractModel.php");

 class model extends abstractModel{
	 

static function resendValidationEmail($user_id){
	$conn = connect();
	if(!$conn) 
		return mysqli_error_list($conn);
	
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
static function validar($hash){
		$conn = connect();
		if(!$conn) return mysqli_error_list($conn);
		
		$sql = "SELECT id,Count(nombre) as cantidad from usuarios where hash_validacion='$hash'";
		$resultado = mysqli_query($conn, $sql);
		if(!$resultado)
				return mysqli_error_list($conn);
		$datos = mysqli_fetch_assoc($resultado);
		
		if($datos["cantidad"] == 0){
			//no se encontro esa hash
			mysqli_close($conn);
			return 0;
		}else{		
		$id = $datos["id"];
		$sql = "UPDATE usuarios SET valido=1 WHERE id = $id";
		$resultado = mysqli_query($conn, $sql);
			if(!$resultado)
			mysqli_close($conn);
				return mysqli_error_list($conn);	
		}		
		mysqli_close($conn);
		return 1;
	}

}


?>