<?php
require("models/abstractModel.php");



 class model extends abstractModel{
	 
	 static function contarusuarios(){
		$conn = connect();

			if(!$conn)
				return 0;

			$sql = "select count(id) as cantidad from usuarios";


			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

			$res = mysqli_fetch_assoc($resultado);
				mysqli_close($conn);
	
			return $res["cantidad"];
	 }
	 
	 
	  static function contarCervecerias(){
		$conn = connect();

			if(!$conn)
				return 0;

			$sql = "select count(id) as cantidad from cerveceria";


			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

			$res = mysqli_fetch_assoc($resultado);
				mysqli_close($conn);
	
			return $res["cantidad"];
	 }
	 
	 static function removeusu($id){
		$conn = connect();
		if(!$conn)
			return 0;
		$sql = "delete from usuarios where id='$id'";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		mysqli_close($conn);
		
	}
	
	 static function removecerv($id){
		$conn = connect();
		if(!$conn)
			return 0;
		$sql = "select u.id from usuarios u inner join cerveceria c on c.user_id = u.id";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		$res = mysqli_fetch_assoc($resultado);
		$id_usu = $res["id"];
		
		$sql = "update usuarios set tipo=2 where id='$id_usu'";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		
		
		$sql = "delete from cerveceria where id='$id'";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		
		mysqli_close($conn);
		
	}


	 static function modiusu($id,$nombre,$apellido,$tipo_usu,$valido){
		 if(strlen($nombre)>20) $nombre = substr($nombre,0,20);
		 if(strlen($apellido)>20) $apellido = substr($apellido,0,20);
		$conn = connect();
		if(!$conn)
			return 0;
		$sql = "update usuarios set nombre='$nombre', apellido='$apellido',tipo='$tipo_usu',valido='$valido' where id='$id'";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		mysqli_close($conn);
		return mysqli_fetch_assoc($resultado);
	 }
	 
	 
	  static function modicerv($id,$nombre,$direccion,$telefono){
		$conn = connect();
		if(!$conn)
			return 0;
		$sql = "update cerveceria set nombre='$nombre', direccion='$direccion',telefono='$telefono' where id='$id'";
		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		mysqli_close($conn);
		return mysqli_fetch_assoc($resultado);
	 }
	 
	 


	 static function getusuarios($desde,$hasta,$str = null){

		$conn = connect();

		if(!$conn)

			return 0;

		$sql = "";

		if($str == null)

		$sql = "select u.id,u.nombre,u.apellido,u.usuario,u.email,u.valido,u.tipo,t.nombre tipo_usu from usuarios u inner join tipo_usuario t on t.id = u.tipo limit $desde,$hasta;";	

		else

		$sql = "select u.id,u.nombre,u.apellido,u.usuario,u.email,u.valido,u.tipo,t.nombre tipo_usu from usuarios u inner join tipo_usuario t on t.id = u.tipo where u.usuario like '%$str%' or u.nombre like '%$str%' or u.email like '%$str%' limit $desde,$hasta;";	
	

		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

		$rows = Array();	

		$i = 0;

		while(($row = mysqli_fetch_assoc($resultado))) {

		$rows[$i++] = new data($row);

		}

		
		mysqli_free_result($resultado);

		mysqli_close($conn);

		return $rows;

		}
		
		
	 
	 
	  static function getcervecerias($desde,$hasta){

		$conn = connect();

		if(!$conn)

			return 0;


		$sql = "select c.id,c.nombre,c.direccion,c.telefono from cerveceria c limit $desde,$hasta;";	


		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

		$rows = Array();	

		$i = 0;

		while(($row = mysqli_fetch_assoc($resultado))) {

		$rows[$i++] = new data($row);

		}

		
		mysqli_free_result($resultado);

		mysqli_close($conn);

		return $rows;

		}
	
 }

 
class data{

	

function __construct($data){
$this->data = $data;
}

		function getnombre(){
		return $this->data["nombre"];
		}
		function getapellido(){
			return $this->data["apellido"];
		}
		function getvalido(){
			return $this->data["valido"];
		}
		function getusuario(){
			return  $this->data["usuario"];
		}
		function getemail(){
			return $this->data["email"];
		}
		function gettelefono(){
			return $this->data["telefono"];
		}
		function gettipo(){
			return $this->data["tipo_usu"];
		}
		
		function getid(){
			return $this->data["id"];
		}
		
		function getdireccion(){
			return $this->data["direccion"];
		}
}
