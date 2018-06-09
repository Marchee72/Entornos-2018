<?php
require("models/abstractModel.php");

 class model extends abstractModel{
	 

		
	static function registrarNuevoUsuario($nombre,$apellido,$usuario,$email,$pass,$validationhash){
		$conn = connect();
		if(!$conn) 
			return mysqli_error_list($conn);
		
		$sql = "SELECT Count(nombre) as cantidad FROM usuarios WHERE usuario='$usuario' or email='$email'";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		$vCantUsuarios = mysqli_fetch_assoc($resultado);
		$tipo = 2;//isset($_POST["tipo"]) ? $_POST["tipo"] : 2; //USUARIO TIPO 2 ES UN USUARIO COMUN
		$valido = 0; //NO ES VALIDO HASTA QUE SE VERIFIQUE POR MAIL


		if ($vCantUsuarios["cantidad"] !=0){
			//error
			return 0;
		}
		else {
			$sql = "INSERT INTO usuarios (usuario, pass, tipo, valido, nombre, apellido, email,hash_validacion) 
					values ('$usuario',md5('$pass'), '$tipo', '$valido', '$nombre', '$apellido', '$email','$validationhash')";
			$res = mysqli_query($conn, $sql); 
			if(!$res)
				return mysqli_error_list($conn);
		}
	
		// Cerrar la conexion
		mysqli_close($conn);
		return 1;
	}

	static function updatetipousuario($user_id,$tipo){
		$conn = connect();
		if(!$conn) 
			return mysqli_error_list($conn);
		
		$sql = "update usuarios set tipo = (select id from tipo_usuario where nombre='$tipo') where id='$user_id'";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		
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
			mysqli_close($conn)
			return 0;
		}else{
		$id = $datos["id"];
		$sql = "UPDATE usuarios SET valido=1,hash_validacion='' WHERE id = $id";
		$resultado = mysqli_query($conn, $sql);
			if(!$resultado)
			mysqli_close($conn)
				return mysqli_error_list($conn);	
		}
		mysqli_close($conn)
		return 1;
	}


static function registrarCerveceria($nombre,$domicilio,$telefono,$userid){
		$conn = connect();
		if(!$conn) 
			return mysqli_error_list($conn);
		
		$sql = "INSERT into cerveceria (nombre,direccion,user_id) values('$nombre','$domicilio','$userid');";
		$res = mysqli_query($conn, $sql); 
			if(!$res){
					mysqli_close($conn);
					return mysqli_error_list($conn);
			}
		$sql = "SELECT LAST_INSERT_ID();";
		$res = mysqli_query($conn, $sql); 
		 $result = mysqli_fetch_assoc($res);
		
	if(!$result["LAST_INSERT_ID()"]){
			mysqli_close($conn);	
			return mysqli_error_list($conn);
			}
			mysqli_close($conn);
		return $result["LAST_INSERT_ID()"];
}

static function registrarHorario($id_cerveceria,$hora_desde,$hora_hasta,$id_dia){
	$conn = connect();
		if(!$conn) 
			return mysqli_error_list($conn);
		
		$sql = "INSERT into cerveceria_horarios (id_cerveceria,hora_desde,hora_hasta,id_dia) values('$id_cerveceria','$hora_desde','$hora_hasta','$id_dia');";

		$res = mysqli_query($conn, $sql);
		
			//if($res === TRUE){
		//			return true;
		//	}
		
		mysqli_close($conn);
			
}		
	
		
function __construct(){
//	echo("model loaded");
	parent::__construct();
}


}


?>