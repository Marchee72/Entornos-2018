<?php
require("models/abstractModel.php");

 class model extends abstractModel{
	 
 


static function obtenerdatos($idcerv){
	$conn = connect();
		if(!$conn)
			return 0;
			$sql = "select * from cerveceria where id='$idcerv';";	
			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
			
			mysqli_close($conn);
			return new data(mysqli_fetch_assoc($resultado));
}
	
	
static function obtenerhorarios($idcerv){
	$conn = connect();
		if(!$conn)
			return 0;
			$sql = "select * from cerveceria inner join cerveceria_horarios on id = id_cerveceria where id='$idcerv' order by id_dia,hora_desde;";	
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

		static function updatedatos($idcerv,$nombre,$direccion,$telefono){
		$conn = connect();
		if(!$conn)
			return 0;
			$sql = "update cerveceria set nombre='$nombre',direccion='$direccion',telefono='$telefono' where id='$idcerv';";
			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
			mysqli_close($conn);
		}
		
		static function removehorarios($id_cerveceria){
				$conn = connect();
		if(!$conn)
			return 0;
			$sql = "delete from cerveceria_horarios where id_cerveceria='$id_cerveceria'";
		$res = mysqli_query($conn, $sql);
		mysqli_close($conn);
			
		}
		
		static function sethorarios($id_cerveceria,$hora_desde,$hora_hasta,$id_dia){
			$conn = connect();
		if(!$conn)
			return 0;
			$sql = "INSERT into cerveceria_horarios (id_cerveceria,hora_desde,hora_hasta,id_dia) values('$id_cerveceria','$hora_desde','$hora_hasta','$id_dia');";

		$res = mysqli_query($conn, $sql);
		
			//if($res === TRUE){
		//			return true;
		//	}
		
		mysqli_close($conn);
		
		}
	
static function counthorarios($idcerv){
	$conn = connect();
		if(!$conn)
			return 0;
			$sql = "select id_dia,count(*) as cantidad from cerveceria inner join cerveceria_horarios on id = id_cerveceria where id='$idcerv' group by id_dia order by id_dia,hora_desde;";
			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));
			$rows = Array();	
			$i = 0;
			while(($row = mysqli_fetch_assoc($resultado))) {
			$rows[$row["id_dia"]] = $row["cantidad"];
			}
			
			mysqli_free_result($resultado);
			mysqli_close($conn);
			return $rows;
}
	
	

	
		
function __construct(){
	parent::__construct();
}


}


 class data{
	
function __construct($data){
		$this->data = $data;
	}
	
	function getid(){
		return $this->data["id"];
	}
	
	function getnombre(){
		return $this->data["nombre"];
	}
	
	
	function getdireccion(){
		return $this->data["direccion"];
	}

	function gethora_desde(){
		return $this->data["hora_desde"];
	}
	
	function gethora_hasta(){
		return $this->data["hora_hasta"];
	}
	
	function getiddia(){
		return $this->data["id_dia"];
	}

		function gettelefono(){
		return $this->data["telefono"];
	}


}
 

?>