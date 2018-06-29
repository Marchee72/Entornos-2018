<?php

define("ROOT_PATH","/Entornos-2018");


if (isset($_GET['url'])){ 

$url = $_GET["url"];

$params = explode('/', $url);

require("config/view.php");

 require("config/utils.php");



$path = "controllers/".$params[0].".php";

//carga el controlador

if(file_exists($path)){

include('templates/header.php');

//titulo del controlador



include_once($path);

$controller = new  $params[0];

$model = "models/" .$params[0]. "/model.php";

loadHeader($params[0]);

$controller->view = new View();



if(file_exists($model)){

require($model);

$model = new model();	

}

if(count($params) - 1 > 1){

if(method_exists($controller,$params[1]))

$controller->$params[1]($params[2]);//ejecute the method, and pass the param

else

	header("Location:../");

}else{

if(count($params) - 1 > 0){	

if($params[1] == "")

	$controller->init();	

else

if(method_exists($controller,$params[1]))

	$controller->$params[1]();//ejecute the method, and pass the param	

else

	header("Location:../");

}else{

$controller->init();	

}

}

include('templates/footer.php');



}else{

include('templates/404.php');	

}

}else{

header("Location:home/dashboard");

}



?>