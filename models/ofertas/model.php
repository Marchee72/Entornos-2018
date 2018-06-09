<?php
require("models/abstractModel.php");

 class model extends abstractModel{
	 
	static function getofertas(){
		$conn = connect();
		if(!$conn)
			return 0;
		$sql = "select * from ofertas inner join tipo_oferta on tipo_oferta.id = id_tipo;";	
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

	
		
function __construct(){
	echo("model loaded");
	parent::__construct();
}


}

 class data{
	
function __construct($data){
		$this->data = $data;
	}
	
	function getimg(){
		return ROOT_PATH . $this->data["img_path"];
	}
	
	function getdesc(){
		return $this->data["descripcion"];
	}
	
	
	function getdesctipo(){
		return $this->data["descripcion_tipo"];
	}
	
}

?>