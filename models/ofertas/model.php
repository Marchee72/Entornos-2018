<?php

require("models/abstractModel.php");



 class model extends abstractModel{

	 

	static function getofertas($desde,$hasta,$str = null){

		$conn = connect();

		if(!$conn)

			return 0;

		$sql = "";

		if($str == null)

		$sql = "select o.id,o.titulo,o.fecha_desde,o.fecha_hasta,o.descripcion,desc_tipo,img_path from ofertas o inner join tipo_oferta on tipo_oferta.id_tipo = o.tipo_id limit $desde,$hasta;";	

		else

		$sql = "select o.id,o.titulo,o.fecha_desde,o.fecha_hasta,o.descripcion,desc_tipo,img_path from ofertas o inner join tipo_oferta on tipo_oferta.id_tipo = o.tipo_id where o.titulo like '%$str%' or o.descripcion like '%$str%' limit $desde,$hasta;";	

	

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



	static function contarOfertas($id_cerveceria = null){

			$conn = connect();

			if(!$conn)

				return 0;

			$sql = "";

			if($id_cerveceria != null){

			$sql = "select count(id) as cantidad from ofertas where cerveceria_id='$id_cerveceria'";

			}else{

			$sql = "select count(id) as cantidad from ofertas";

			}



			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

			$res = mysqli_fetch_assoc($resultado);

			return $res["cantidad"];

	}





	static function listarOfertas($id_cerveceria,$desde,$hasta){

		$conn = connect();

		$sql = "select o.id,o.titulo,o.fecha_desde,o.fecha_hasta,o.descripcion,desc_tipo,img_path,c.nombre from ofertas o inner join tipo_oferta on tipo_oferta.id_tipo = o.tipo_id inner join cerveceria c on c.id = o.cerveceria_id	

		where cerveceria_id='$id_cerveceria' limit $desde,$hasta;";

		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));;

	

		$rows = Array();	

		$i = 0;

		while(($row = mysqli_fetch_assoc($resultado))) {

		$rows[$i++] = new data($row);

		}

		mysqli_free_result($resultado);

		mysqli_close($conn);

		return $rows;

	

	}	



	static function agregarOferta($titulo,$id_tipo,$descripcion,$fecha_desde,$fecha_hasta,$id_cerveceria){

		$conn = connect();



		$sql = "INSERT INTO ofertas (titulo,id_cerveceria, fecha_desde, fecha_hasta, descripcion, tipo_id) 

		values ('$titulo','$id_cerveceria','$fecha_desde','$fecha_hasta','$descripcion','$id_tipo')";

		$res = mysqli_query($conn, $sql) or die (mysqli_error($conn));; 

		

	}	



	static function getofertas_tipos(){

		$conn = connect();

		if(!$conn)

			return 0;

			$sql = "select * from tipo_oferta;";	

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



	static function removeoferta($id){

		$conn = connect();

		if(!$conn)

			return 0;

		$sql = "delete from ofertas where id='$id'";

		$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

		mysqli_close($conn);

	}



	static function getOferta($id){

		$conn = connect();

		if(!$conn)

			return 0;

			$sql = "select * from ofertas inner join tipo_oferta on id_tipo = tipo_id where id='$id';";	

			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

			$oferta = mysqli_fetch_assoc($resultado);

		

			mysqli_close($conn);

			return new data($oferta);

	}



	function updateoferta($id,$id_tipo,$descripcion,$fecha_desde,$fecha_hasta,$titulo){

		$conn = connect();

		if(!$conn)

			return 0;

			$sql = "update ofertas set tipo_id='$id_tipo',fecha_desde = '$fecha_desde',fecha_hasta='$fecha_hasta',

			titulo='$titulo',descripcion='$descripcion' where id = '$id';";	

			$resultado = mysqli_query($conn, $sql) or die (mysqli_error($conn));

		}



function __construct(){

	

	parent::__construct();

}





}



 class data{

	

function __construct($data){

		$this->data = $data;

	}

	

	function getimg(){

		return ROOT_PATH ."/". $this->data["img_path"];

	}

	

	function getdesc(){

		return $this->data["descripcion"];

	}

	

	function getcerv(){

		return $this->data["nombre"];

	}

	

	function getdesctipo(){

		return $this->data["desc_tipo"];

	}



	function getid(){

		return $this->data["id_tipo"];

	}





	function getidoferta(){

		return $this->data["id"];

	}



	function getidCerveceria(){

		return $this->data["cerveceria_id"];

	}

	

	

	function getfecha_desde_parsed(){

		return date("d-m-Y H:i", strtotime($this->data["fecha_desde"])); 

	}



	function getfecha_desde_parsed_t(){

		return date("Y-m-d\TH:i", strtotime($this->data["fecha_desde"])); 

	}





	function getfecha_hasta_parsed(){

		return date("d-m-Y H:i", strtotime($this->data["fecha_hasta"])); 

	}



	function getfecha_hasta_parsed_t(){

		return date("Y-m-d\TH:i", strtotime($this->data["fecha_hasta"])); 

	}





	function getfecha_desde(){

		return $this->data["fecha_desde"];

	}

	

	function getfecha_hasta(){

		return $this->data["fecha_hasta"];

	}



	function gettitulo(){

		return $this->data["titulo"];

	}

}



?>