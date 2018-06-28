<?php
class cerveceria{

function init(){
}

function misdatos(){
if(!isset($_SESSION["cerveceria"])){
	header("Location:".ROOT_PATH."/home/dashboard");	
}else{
$vars = Array();
$cerveceria = $_SESSION["cerveceria"];	
$cervid = $cerveceria["id"];
$datos = model::obtenerdatos($cervid);
$horarios = model::obtenerhorarios($cervid);	
$vars["cerveceria"] = $datos;
$vars["horarios"] = $horarios;
$vars["count"] = model::counthorarios($cervid);
echo $this->view->render("templates/cerveceria/misdatos.html",$vars);		
}
}

function editarDatos(){
		$dias =  isset($_POST["dias"]) ? $_POST["dias"] : die;
		$count =  isset($_POST["count"]) ? $_POST["count"] : die;
		$desde =  isset($_POST["desde"]) ? $_POST["desde"] : die;
		$hasta =  isset($_POST["hasta"]) ? $_POST["hasta"] : die;
		
		$nombre =  isset($_POST["nombre"]) ? $_POST["nombre"] : die;
		$direccion =  isset($_POST["direccion"]) ? $_POST["direccion"] : die;
		$telefono =  isset($_POST["telefono"]) ? $_POST["telefono"] : die;
		
		$cerveceria = $_SESSION["cerveceria"];	
		$cervid = $cerveceria["id"];
		model::updatedatos($cervid,$nombre,$direccion,$telefono);
		
		model::removehorarios($cervid);
		$c = 0;
		$i = 0;
			
		foreach($dias as $dia){
		//id dia ->
			$cantidad = $count[$c++] + $i;			
			
			for(;$i<$cantidad;$i++){
			$desde_ = $desde[$i];
			$hasta_ = $hasta[$i];
			model::sethorarios($cervid,$desde_,$hasta_,$dia);
			}
		}
			
		echo ("<div class='alert alert-success' role='alert'>
						<h4 class='alert-heading'><strong>Exito!</strong></h4>
						Datos actualizados
					</div>
				</div>");
			
		
	
}
function listar(){	echo $this->view->render("templates/enconstruccion/enconstruccion.php");}
}
?>