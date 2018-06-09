<?php
class logout{

function init(){
session_start();
session_destroy();
header("Location:".ROOT_PATH."/home/dashboard");	
}

}
?>