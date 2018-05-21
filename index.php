<?php
$ROOT_PATH = "Entornos-2018";
if (isset($_GET['url'])){ 
$url = $_GET["url"];
$params = explode('/', $url);

 

$path = "controllers/".$params[0].".php";
if(file_exists($path)){
include('templates/header.php');
include_once($path);
$controller = new  $params[0];//load the controller
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