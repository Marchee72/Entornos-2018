<?php
require("models/abstractModel.php");

 class model extends abstractModel{
	 
 
 static function buscarCerveceria($user_id){
    $con = connect();
    $sql = "SELECT * FROM cerveceria where user_id='$user_id'";
    $resultado = mysqli_query($con, $sql);
            $res = mysqli_fetch_assoc($resultado);
            return $res;
 }      static function loginwithhash($hash){            $con = connect();            $sql = "SELECT * FROM usuarios u inner join (select tipo_usuario.id as idtipo,tipo_usuario.nombre as nombretipo from tipo_usuario) t on u.tipo = t.idtipo             where u.hash_validacion = '$hash'";			$resultado = mysqli_query($con, $sql);            $vUsuario = mysqli_fetch_assoc($resultado);            //sqli_free_result($resultado);						$id = $vUsuario["id"];		$sql = "UPDATE usuarios SET valido=1,hash_validacion='' WHERE id = $id";		 mysqli_query($conn, $sql);			if(!$resultado){			mysqli_close($conn);				return mysqli_error_list($conn);				}            mysqli_close($con);            if(!is_null($vUsuario)){				return $vUsuario;			}            else{                return null;            }}

 static function login($usuario,$pass){
            
            $con = connect();
            $sql = "SELECT * FROM usuarios u inner join (select tipo_usuario.id as idtipo,tipo_usuario.nombre as nombretipo from tipo_usuario) t on u.tipo = t.idtipo 
            where u.usuario='$usuario' and u.pass=md5('$pass')";

         //   $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' and pass=md5('$pass')";

			$resultado = mysqli_query($con, $sql);
            $vUsuario = mysqli_fetch_assoc($resultado);
            //sqli_free_result($resultado);
            mysqli_close($con);
            if(!is_null($vUsuario)){
				return $vUsuario;
			}
            else{
                return null;
            }
}

	
	

	
		
function __construct(){
	parent::__construct();
}


}

 

?>