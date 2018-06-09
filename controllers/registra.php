<?php
 
 class registra{
	function init(){
		
		
	}
	
	function cerveceria($registrar = null){
	//include('templates/registra_cerveceria.html');
		$vars = Array();
	if($registrar == "doReg"){
		$dias =  isset($_POST["dias"]) ? $_POST["dias"] : die;
		$count =  isset($_POST["count"]) ? $_POST["count"] : die;
		$desde =  isset($_POST["desde"]) ? $_POST["desde"] : die;
		$hasta =  isset($_POST["hasta"]) ? $_POST["hasta"] : die;
		
		$nombre =  isset($_POST["nombre"]) ? $_POST["nombre"] : die;
		$direccion =  isset($_POST["direccion"]) ? $_POST["direccion"] : die;
		$telefono =  isset($_POST["telefono"]) ? $_POST["telefono"] : die;
		
		$user_id = $_SESSION["user_id"];
		//$user_id = 12;
		$reg = model::registrarCerveceria($nombre,$direccion,$telefono,$user_id);
		
		
		if(is_array($reg)){
			//handle sql error
		
			$errn = $reg["errno"]; 
			$vars["error"] = $errn;	
			
			}else{
			//$vars["result"] = $reg;
			$id_cerverceria = $reg;
			model::updatetipousuario($user_id,"OWNER");	
			$_SESSION["tipo_usuario"] = "OWNER";
				
		$c = 0;
		$i = 0;
			
		foreach($dias as $dia){
		//id dia ->
			$cantidad = $count[$c++] + $i;			
			
			for(;$i<$cantidad;$i++){
			$desde_ = $desde[$i];
			$hasta_ = $hasta[$i];
			model::registrarHorario($id_cerverceria,$desde_,$hasta_,$dia);
			}
		}
		
		echo ("<div class='alert alert-success' role='alert'>
						<h4 class='alert-heading'><strong>Exito!</strong></h4>
						La cerveceria $nombre ha sido registrada exitosamente!!
					</div>
				</div>");
			}
	
	}
	if(isset($_SESSION["user_id"])){
	echo $this->view->render("templates/registra_cerveceria.html",$vars);
	}else{
	$redirect = "/registra/cerveceria";
	header("Location:".ROOT_PATH."/login?redirectTo=".$redirect);	
	}
}
	
	
	
	function terminaRegistro($hash){
		$vars = Array();
		$res = model::validar($hash);
		if(is_array($res)){
			//handle sql error
			
			$data = $res[0];
			$vars["error"] = $data["errno"]; ;
		}else{
			$vars["result"] = $res;
		}
		echo $this->view->render("templates/finalizaregistro.html",$vars);	
	}
	
	
	
	function usuario($registrar=null){
	$vars = Array();
	if($registrar == "doReg"){	
	$nombre =  isset($_POST["nombre"]) ? $_POST["nombre"] : die;
	$apellido =  isset($_POST["apellido"]) ? $_POST["apellido"] : die;
	$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : die;
	$email =  isset($_POST["email"]) ? $_POST["email"] : die;
	$pass = isset($_POST["pass"]) ? $_POST["pass"] : die;
	
	$random_hash = md5(uniqid(rand(), true));
	
	$reg = model::registrarNuevoUsuario($nombre,$apellido,$usuario,$email,$pass,$random_hash);
		
		if(is_array($reg)){
			//handle sql error
			print_r($reg);
		
				 $errn = $reg["errno"]; 
			$vars["error"] = $errn;	
			}else{
			$vars["result"] = $reg;
		}
		
		
	}
	echo $this->view->render("templates/registra.html",$vars);
		
}
	
function __construct(){
	if(isset($_SESSION["usuario"])){
	if(isset($_SESSION["tipo_usuario"])){
	//header("Location:".ROOT_PATH."/home/dashboard");
	}else{
	header("Location:".ROOT_PATH."/verifyemail");	
	}
}
}

 }
 //include_once('templates/footer.php');
?>