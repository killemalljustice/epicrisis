<?php
session_start();
include('clases/consultas.php');
$verifica_usuario= new consultas();

$user=addslashes($_POST["user"]);
$pass=addslashes($_POST["pass"]);

if($verifica_usuario->verifica_usuario($user,$pass)){
	if($verifica_usuario->usuario=="epicrisis")
		$_SESSION["nombre"]='protocolo';
	echo "si";
}else{
	echo "no";
}

?>