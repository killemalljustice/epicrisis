<?php
include('clases/consultas.php');

if($_POST["fecha_ingreso"]!='' && $_POST["fecha_egreso"]!='' && $_POST["rut"]!=''){
	$rut=$_POST["rut"];
	$fecha_ingreso=$_POST["fecha_ingreso"];
	$separado = explode("/",$fecha_ingreso);
	$fecha_ingreso=$separado[2]."-".$separado[1]."-".$separado[0];
	$fecha_egreso=$_POST["fecha_egreso"];
	$separado = explode("/",$fecha_egreso);
	$fecha_egreso=$separado[2]."-".$separado[1]."-".$separado[0];
	$busca_cirugias_paciente = new consultas();
	$busca_cirugias_paciente->busca_cirugias_paciente($rut,$fecha_ingreso,$fecha_egreso);
	while($busca_cirugias_paciente->sgte_busca_cirugias_paciente()){
		$separado = explode("-",$busca_cirugias_paciente->fecha_oper);
		$fecha_oper=$separado[2]."-".$separado[1]."-".$separado[0];
		echo $fecha_oper." - ".utf8_encode($busca_cirugias_paciente->nombre_cirujano)." - ".$busca_cirugias_paciente->practicada."\n";
	}
}
?>