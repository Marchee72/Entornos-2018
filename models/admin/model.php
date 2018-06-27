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

			return $res["cantidad"];
	 }
	 
	 static function getusuarios($desde,$hasta,$str = null){

		$conn = connect();

		if(!$conn)

			return 0;

		$sql = "";

		if($str == null)

		$sql = "select u.nombre,u.telefono,u.apellido,u.usuario,u.email,u.valido,u.tipo,t.nombre tipo_usu from usuarios u inner join tipo_usuario t on t.id = u.tipo limit $desde,$hasta;";	

		else

		$sql = "select u.nombre,u.telefono,u.apellido,u.usuario,u.email,u.valido,u.tipo,t.nombre tipo_usu from usuarios u inner join tipo_usuario t on t.id = u.tipo where u.usuario like '%$str%' or u.nombre like '%$str%' or u.email like '%$str%' limit $desde,$hasta;";	
	

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
}