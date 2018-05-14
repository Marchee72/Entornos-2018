<doctype <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
    <?php
        include('../html/header.html');
        // echo($_SESSION["permisos"]["titulo"][0]);
        if(isset($_SESSION["usuario"])){
            echo("<nav class='nav'> <ul class='nav nav-tabs nav-justified' id='permisos'>");
            foreach($_SESSION["permisos"]["titulo"] as $per){
                echo("<li role='presentation'><a href='#'>".$per."</a></li>");
            }
            echo("</ul> </nav>");
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
</html>