<?php 

class admin{
	
	function init(){
		

	}

	function listarusuarios($pagina = null){
		
		$cantidadPorPagina = 6;

		$cantidadusuarios = model::contarusuarios();

		$numeroPaginas = ceil($cantidadusuarios/$cantidadPorPagina);



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
		
		
	}
	
}

?>