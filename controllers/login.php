

    <?php
        //include_once('../templates/header.php');
	//	include("connection.php");
        
		class login{
		
		function init(){
		//include('templates/login.html');
			$vars = array();
			if(isset($_GET["redirectTo"])){
				$vars["redirect"] = $_GET["redirectTo"];
			}
			echo $this->view->render("templates/login.html",$vars); 
        
		}				function cerveceria(){			if(isset($_SESSION["user_id"])){				if(!isset($_SESSION["cerveceria"])){				if($_SESSION["tipo_usuario"]=="OWNER"){					$cerv = model::buscarCerveceria($_SESSION["user_id"]);					$_SESSION["cerveceria"] = $cerv;				}			}			}						header("Location:".ROOT_PATH."/home/dashboard");		}
		
		function usuario(){			if(!isset($_SESSION["login_token"])){
			$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : die;
            $pass = isset($_POST["pass"]) ? $_POST["pass"] : die;
			$datos = model::login($usuario,$pass);			}else{			$datos = model::loginwithhash($_SESSION["login_token"]);				}
			
			if($datos != null){
				
				 $_SESSION["usuario"] = $datos["usuario"];
				$_SESSION["user_id"] = $datos["id"];
				$_SESSION["email"] = $datos["email"];
				if($datos["valido"]==1){
				$_SESSION["tipo_usuario"] = $datos["nombretipo"];
					if($datos["nombretipo"]=="OWNER"){
					$cerv = model::buscarCerveceria($datos["id"]);
					$_SESSION["cerveceria"] = $cerv;
					}
				if(isset($_GET["redirect"])){
				header("Location:". ROOT_PATH . $_GET["redirect"]);
				}else{
					header("Location:".ROOT_PATH."/home/dashboard");
				}
			}else{				$_SESSION["login_token"] = $datos["hash_validacion"];
				header("Location:".ROOT_PATH."/verifyemail");
			}
				
			
			}else{
				  $vars["error"] = 1;	
				  echo $this->view->render("templates/login.html",$vars); 
			}
		
		}
        
        function __construct(){
			if(isset($_SESSION["usuario"])){
			if(isset($_SESSION["tipo_usuario"])){
			header("Location:".ROOT_PATH."/home/dashboard");
			}else{
			header("Location:".ROOT_PATH."/verifyemail");	
			}
		}
		}
       

        
		// include_once('../templates/footer.php');
		}
	?>
