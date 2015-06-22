<?php
	$ruta=$_GET["ruta"];
	$archivo=filtro($_GET["archivo"]);
//	echo "asfsgfasf".$nombre;
	$enlace=$ruta."/".$archivo;
	if(file_exists($enlace)){
		header ("Content-Disposition: attachment; filename=".$archivo."");
		header ("Content-Type: application/octet-stream");
		header ("Content-Length: ".filesize($enlace));
		readfile($enlace);
	}
	function filtro($ruta){
		$baneadas=array("../","..","./");
		$filtrada=str_replace($baneadas,"",$ruta);
		return $filtrada;
	}
	
?>