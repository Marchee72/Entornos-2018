<?php 

class admin{
	
	function init(){
		

	}
	
	function borrar_usuarios(){
		if(isset($_SESSION["lista_usuarios"])){
		$seleccion = $_POST["user_selected"];
		$usuarios = $_SESSION["lista_usuarios"];
		//eliminamos los usuarios seleccionados de la db
		foreach($seleccion as $index){
			$usu = $usuarios[$index];
			model::removeusu($usu);
		}
		}
		$pagina = isset($_SESSION["pagina"]) ? $_SESSION["pagina"] : 1;
		header("Location:".ROOT_PATH."/admin/listarusuarios/" . $pagina);	
	}
	
	function borrar_cerveceria(){
		if(isset($_SESSION["lista_cervecerias"])){
		$seleccion = $_POST["user_selected"];
		$cervecerias = $_SESSION["lista_cervecerias"];
		//eliminamos los usuarios seleccionados de la db
		foreach($seleccion as $index){
			$cerv = $cervecerias[$index];
			model::removecerv($cerv);
		}
		}
		$pagina = isset($_SESSION["pagina"]) ? $_SESSION["pagina"] : 1;
		header("Location:".ROOT_PATH."/admin/listarcervecerias/" . $pagina);	
	}
	
	function modificarusuario(){
		if(isset($_SESSION["lista_usuarios"])){
		$usuarios = $_SESSION["lista_usuarios"];
		$selectedIndex = $_POST["userSelected"];
		$userID = $usuarios[$selectedIndex];
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$valido = $_POST["valido"];
		$tipo = isset($_POST["tipo_usu"]) ? $_POST["tipo_usu"] : 3;
		model::modiusu($userID,$nombre,$apellido,$tipo,$valido);
		}
		$pagina = isset($_SESSION["pagina"]) ? $_SESSION["pagina"] : 1;
		header("Location:".ROOT_PATH."/admin/listarusuarios/" . $pagina);
	}
	
	function modificarcerveceria(){
		if(isset($_SESSION["lista_cervecerias"])){
		$cerveceria = $_SESSION["lista_cervecerias"];
		$selectedIndex = $_POST["userSelected"];
		$idCerv = $cerveceria[$selectedIndex];
		$nombre = $_POST["nombre"];
		$direccion = $_POST["direccion"];
		$telefono = $_POST["telefono"];
		model::modicerv($idCerv,$nombre,$direccion,$telefono);
		}
		$pagina = isset($_SESSION["pagina"]) ? $_SESSION["pagina"] : 1;
		header("Location:".ROOT_PATH."/admin/listarcervecerias/" . $pagina);
	}
	

	function listarusuarios($pagina = null){
		
		$cantidadPorPagina = 6;

		$cantidadusuarios = model::contarusuarios();

		$numeroPaginas = ceil($cantidadusuarios/$cantidadPorPagina);

		if($pagina > $numeroPaginas){
				header("Location:".ROOT_PATH."/admin/listarusuarios/" . $numeroPaginas);	
		}

		$vars = array();

		if($pagina == null || $pagina == 1){
			
			if($pagina == null) $pagina = 1;
			$vars["pagina"] = Array("anterior"=>1,"siguiente"=>(($pagina + 1) <= $numeroPaginas) ? $pagina + 1 : $pagina,"actual"=>1);

		}else{

			$anterior = $pagina-1 <= 0 ? $pagina : $pagina -1 ;

			$siguiente = (($pagina + 1) <= $numeroPaginas) ? $pagina + 1 : $pagina;

			

			$vars["pagina"] = Array("anterior"=>$anterior,"siguiente"=>$siguiente,"actual"=>$pagina);

		} 	

			$pActual = $vars["pagina"];

			$pActual = $pActual["actual"];

			$offset = ($pActual -1) * $cantidadPorPagina;

			$desde = $pActual - 1;

			

			$data = model::getusuarios($offset,$cantidadPorPagina,null);

			$vars["usuarios"] = $data;

			echo $this->view->render("templates/admin/listausu.html",$vars);
			$user_ids = array();
			$i = 0;
			foreach($data as $usu){
				$user_ids[$i] = $usu->getid();
				$i++;
			}
			$_SESSION["lista_usuarios"] = $user_ids;
			$_SESSION["pagina"] = $pActual;
	}
	
	
	
	function listarcervecerias($pagina = null){
		
		$cantidadPorPagina = 6;

		$cantidad = model::contarcervecerias();

		$numeroPaginas = ceil($cantidad/$cantidadPorPagina);
		if($pagina = 0) $pagina = 1;
		if($pagina > $numeroPaginas){
				header("Location:".ROOT_PATH."/admin/listarcervecerias/" . $numeroPaginas);	
		}

		$vars = array();

		if($pagina == null || $pagina == 1){
			
			if($pagina == null) $pagina = 1;
			$vars["pagina"] = Array("anterior"=>1,"siguiente"=>(($pagina + 1) <= $numeroPaginas) ? $pagina + 1 : $pagina,"actual"=>1);

		}else{

			$anterior = $pagina-1 <= 0 ? $pagina : $pagina -1 ;

			$siguiente = (($pagina + 1) <= $numeroPaginas) ? $pagina + 1 : $pagina;

			

			$vars["pagina"] = Array("anterior"=>$anterior,"siguiente"=>$siguiente,"actual"=>$pagina);

		} 	

			$pActual = $vars["pagina"];

			$pActual = $pActual["actual"];

			$offset = ($pActual -1) * $cantidadPorPagina;

			$desde = $pActual - 1;

			

			$data = model::getcervecerias($offset,$cantidadPorPagina,null);

			$vars["cervecerias"] = $data;

			echo $this->view->render("templates/admin/listacerv.html",$vars);
			$ids = array();
			$i = 0;
			foreach($data as $cerv){
				$ids[$i] = $cerv->getid();
				$i++;
			}
			$_SESSION["lista_cervecerias"] = $ids;
			$_SESSION["pagina"] = $pActual;
	}
}

?>