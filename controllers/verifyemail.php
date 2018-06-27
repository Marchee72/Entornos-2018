<?php 
class verifyemail{

    function init(){
        $vars = Array();
        $vars["email"] = $_SESSION["email"];
        
        echo $this->view->render("templates/login/mustverifyemail.html",$vars); 
    }

    function resend(){
        model::resendValidationEmail($_SESSION["user_id"]);
        echo ("<div class='alert alert-success' role='alert'>
        <h4 class='alert-heading'><strong>Exito!</strong></h4>
       Se reenvio el email de validacion.
    </div>
</div>");
    }
    	function terminaRegistro($hash){
		$vars = Array();
		$res = model::validar($hash);				header("Location:".ROOT_PATH."/login/usuario/");
		}
	

	
}
?>