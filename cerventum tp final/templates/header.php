
    <?php
        session_start();
       // include_once('templates/header.html');
        function loadHeader($titulo){
        $vars =  Array();
        //$vars["titulo"] = $titulo;
        if(!isset($_SESSION["tipo_usuario"])){
            $vars["menu"] = loadTemplate("templates/header/defaultMenu.html");
        }else{
           
                $tipo_u = $_SESSION["tipo_usuario"];
                $vars["menu"] = loadTemplate("templates/header/$tipo_u/menu.html");
            
        }
        extract($vars);
        require("templates/header.html");
        }
       
      function loadTemplate($templateFile){
        ob_start();
        require($templateFile);
        $content = ob_get_contents();
        ob_end_clean();
        
        return $content;
       }
    
    ?>
