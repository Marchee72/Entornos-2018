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
	
}

?>