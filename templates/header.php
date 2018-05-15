
    <?php
        session_start();
        include_once('../templates/header.html');
     
        if(isset($_SESSION["usuario"])){
     /*       echo("<nav class='nav'> <ul class='nav nav-tabs nav-justified' id='permisos'>");
            foreach($_SESSION["permisos"] as $per){
                echo("<li role='presentation'><a href='#'>".$per["titulo"]."</a></li>");
            }
            echo("</ul> </nav>");
*/       
	   }

        // if(isset($_SESSION["usuario"])){
        //     $dom = new DOMDocument();
        //     $element = $dom->createElement('ul');
        //     // Insertamos el nuevo elemento como raíz (hijo del documento)
        //     $dom->appendChild($element);
        //     foreach($_SESSION["permisos"] as $per){
        //         $element->appendChild($element->createElement('li', $per["titulo"]));
        //     }
        //     echo $dom->saveXML();
        // }
        
    ?>
