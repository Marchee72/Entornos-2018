<?php

function connect(){
include_once("config.php");
return mysqli_connect(SERVER_NAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
}
?>