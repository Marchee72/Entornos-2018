<?php
 
 class ofertas{

	function init(){
	
	}

	function info($id){		//agregar cerveceria + direccion y telefono		
		
	}

	function remove(){
	$id = $_POST["id"];
	model::removeoferta($id);
	}
	
	function search(){
		$str = $_POST["search-box"];
		$this->listar(null,$str);
	}

	function listar($pagina=null,$str=null){
		
		$cantidadPorPagina = 6;
		$cantidadOfertas = model::contarOfertas();
		$numeroPaginas = ceil($cantidadOfertas/$cantidadPorPagina);

		$vars = array();
		if($pagina == null || $pagina == 1){			if($pagina==null) $pagina = 1;	
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
			
			$data = model::getofertas($offset,$cantidadPorPagina,$str);
			$vars["ofertas"] = $data;
			echo $this->view->render("templates/ofertas/ofertas.html",$vars);
	}
	
	function listarOfertas($pagina=null){
		$cantidadPorPagina = 2;
		$cantidadOfertas = model::contarOfertas();
		$numeroPaginas = ceil($cantidadOfertas/$cantidadPorPagina);
		

		$vars = array();
		if($pagina == null || $pagina == 1){
			$vars["pagina"] = Array("anterior"=>1,"siguiente"=>2,"actual"=>1);
		}else{
			$anterior = $pagina-1 <= 0 ? $pagina : $pagina -1 ;
			$siguiente = (($pagina + 1) <= $numeroPaginas) ? $pagina + 1 : $pagina;
			
			$vars["pagina"] = Array("anterior"=>$anterior,"siguiente"=>$siguiente,"actual"=>$pagina);
		} 	
		

			$pActual = $vars["pagina"];
			$pActual = $pActual["actual"];
			$offset = ($pActual -1) * $cantidadPorPagina;
			$desde = $pActual - 1;

			if(isset($_SESSION["cerveceria"])){
			$cerveceria = $_SESSION["cerveceria"];
			$id_cerveceria = $cerveceria["id"];
			$data = model::listarOfertas($id_cerveceria,$offset,$cantidadPorPagina);
			$vars["ofertas"] = $data;
			echo $this->view->render("templates/ofertas/frm_list_ofertas.html",$vars);
		}else{
			//listar ofertas no se puede si no sos owner
		}
	}

	function update(){
		$id = $_POST["id-oferta"];
		$id_tipo = $_POST["oferta-sel"];
		$descripcion = $_POST["long-desc"];
		$fecha_desde = $_POST["desde"];
		$fecha_hasta = $_POST["hasta"];
		$titulo = $_POST["titulo"];
		model::updateoferta($id,$id_tipo,$descripcion,$fecha_desde,$fecha_hasta,$titulo);
		echo ("<div class='alert alert-success' role='alert'>
						<h4 class='alert-heading'><strong>Exito!</strong></h4>
						Oferta actualizada!
					</div>
				</div>");
	}

	function editarOferta($id_oferta){
		$vars = Array();
		if(!isset($_SESSION["cerveceria"])){
			header("Location:".ROOT_PATH."/home/dashboard");
		}else{
		$cerveceria = $_SESSION["cerveceria"];
		$id_cerveceria = $cerveceria["id"];
		$oferta = model::getOferta($id_oferta);
		if($oferta->getidCerveceria() != $id_cerveceria){
			header("Location:".ROOT_PATH."/home/dashboard");
		}else{
			//tipos de ofertas posibles para el combo box
			$data = model::getofertas_tipos();
			$vars["data"] = $data;
			$vars["oferta"] = $oferta;
			echo $this->view->render("templates/ofertas/frm_edit_ofertas.html",$vars);
		}
		}
	}

	function crearOferta($reg=null){
		if(isset($_SESSION["cerveceria"])){
		if($reg != null){
	//	if($_SESSION["tipo_usuario"] != "OWNER")
	//	header("Location: ".ROOT_PATH."/home/dashboard");
	//}
	$id_tipo = $_POST["oferta-sel"];
	$descripcion = $_POST["long-desc"];
	$fecha_desde = $_POST["desde"];
	$fecha_hasta = $_POST["hasta"];
	$cerveceria = $_SESSION["cerveceria"];
	$id_cerveceria = $cerveceria["id"];
	$titulo = $_POST["titulo"];

	model::agregarOferta($titulo,$id_tipo,$descripcion,$fecha_desde,$fecha_hasta,$id_cerveceria);

	echo ("<div class='alert alert-success' role='alert'>
	<h4 class='alert-heading'><strong>Exito!</strong></h4>
	Oferta creada!
</div>
</div>");

	}else{
	$vars = Array();
	$data = model::getofertas_tipos();
	$vars["data"] = $data;
	echo $this->view->render("templates/ofertas/frmcrear_oferta.html",$vars);
	}
 }
}
}
?>