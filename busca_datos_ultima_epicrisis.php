<?php
header ("content-type: application/json; charset=utf-8");
include('clases/consultas.php');
$rut=$_POST["rut"];
$busca_datos_ultima_epicrisis=new consultas();
$busca_datos_ultima_epicrisis->busca_datos_ultima_epicrisis($rut);
if($busca_datos_ultima_epicrisis->existe){
	
	if($busca_datos_ultima_epicrisis->fecha_bgc!='0000-00-00'){
		$separado=explode("-",$busca_datos_ultima_epicrisis->fecha_bgc);
		$fecha_bgc=$separado[2]."/".$separado[1]."/".$separado[0];
	}else{
		$fecha_bgc='';
	}
	if($busca_datos_ultima_epicrisis->fecha_pku!='0000-00-00'){
		$separado=explode("-",$busca_datos_ultima_epicrisis->fecha_pku);
		$fecha_pku=$separado[2]."/".$separado[1]."/".$separado[0];
	}else{
		$fecha_pku='';
	}

	if($busca_datos_ultima_epicrisis->fecha_nac!='0000-00-00'){
		$separado=explode("-",$busca_datos_ultima_epicrisis->fecha_nac);
		$fecha_nac=$separado[2]."/".$separado[1]."/".$separado[0];
	}else{
		$fecha_nac='';
	}
	$separado=explode("-",$busca_datos_ultima_epicrisis->fecha_egreso);
	$fecha_egreso=$separado[2]."/".$separado[1]."/".$separado[0];

	$datos=array($busca_datos_ultima_epicrisis->nombre_paciente,$busca_datos_ultima_epicrisis->ficha,$busca_datos_ultima_epicrisis->edad,$busca_datos_ultima_epicrisis->egreso,$busca_datos_ultima_epicrisis->egreso2,$busca_datos_ultima_epicrisis->reposo,$busca_datos_ultima_epicrisis->resumen,$busca_datos_ultima_epicrisis->otras_indicaciones,$busca_datos_ultima_epicrisis->cirugias,$busca_datos_ultima_epicrisis->peso_ingreso,$busca_datos_ultima_epicrisis->peso_egreso,$busca_datos_ultima_epicrisis->sexo,$busca_datos_ultima_epicrisis->nombre_padre,$busca_datos_ultima_epicrisis->escol_padre,$busca_datos_ultima_epicrisis->nombre_madre,$busca_datos_ultima_epicrisis->escol_madre,$busca_datos_ultima_epicrisis->direccion,$busca_datos_ultima_epicrisis->fono,$busca_datos_ultima_epicrisis->parto,$busca_datos_ultima_epicrisis->apgar,$busca_datos_ultima_epicrisis->gr_mat,$busca_datos_ultima_epicrisis->gr_rn,$fecha_bgc,$fecha_pku,$fecha_nac,$busca_datos_ultima_epicrisis->peso_nac,$fecha_egreso,$busca_datos_ultima_epicrisis->nombre_tipo_habitacion,$busca_datos_ultima_epicrisis->tipo_edad);
}else{
	$datos=array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
}
echo json_encode($datos);
?>