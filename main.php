<?php
session_start();
include('clases/consultas.php');
if(!isset($_SESSION["nombre"])){
	header("location:index.php");
}
$existe=0;
if(isset($_GET["id_protocolo"])){
	$existe=1;
	$busca_protocolo_existente=new consultas();
	$busca_protocolo_existente->busca_protocolo_existente($_GET["id_protocolo"]);
	if($busca_protocolo_existente->existe)
		header("location:buscar.php");
}


$busca_tipo_habitacion=new consultas();
$busca_medicamentos=new consultas();
$busca_protocolo=new consultas();

$busca_cirujanos=new consultas();
$busca_lugares=new consultas();


$tpl=new TemplatePower('templates/main.html');
$tpl->prepare();

if($existe==1){
	$busca_protocolo->busca_protocolo($_GET["id_protocolo"]);
	$tpl->assign("RUT",$busca_protocolo->rut);
	$tpl->assign("PACIENTE",$busca_protocolo->paciente);
	$tpl->assign("FICHA",$busca_protocolo->ficha);
	$fecha=explode("-",$busca_protocolo->fecha_oper);
	$fecha=$fecha[2]."/".$fecha[1]."/".$fecha[0];
	$tpl->assign("FECHA",$fecha);
	$tpl->assign("EDAD",$busca_protocolo->edad);
	if($busca_protocolo->tipo_edad=='1'){
		$tpl->assign("SEL_AN",'selected');
	}else if($busca_protocolo->tipo_edad=='2'){
		$tpl->assign("SEL_ME",'selected');
	}else if($busca_protocolo->tipo_edad=='3'){
		$tpl->assign("SEL_DI",'selected');
	}else if($busca_protocolo->tipo_edad=='4'){
		$tpl->assign("SEL_HO",'selected');
	}
	$tpl->assign("CIRUJANO",utf8_encode($busca_protocolo->cirujano));
	

	if(strlen($busca_protocolo->operatorio)<7)
		$tpl->assign("EGRESO",$busca_protocolo->preoperatorio);
	else
		$tpl->assign("EGRESO",$busca_protocolo->operatorio);

	$tpl->assign("ID_PROTOCOLO",$_GET["id_protocolo"]);
	date_default_timezone_set("America/Santiago");

	$fecha_actual=date("d/m/Y");

	$tpl->assign("FECHA_ACTUAL",$fecha_actual);

	$busca_tipo_habitacion->busca_tipo_habitacion();

	while($busca_tipo_habitacion->sgte_busca_tipo_habitacion()){
		if($busca_tipo_habitacion->id_tipo_habitacion==7){
			$tpl->newBlock("TIPO_HABITACION");
			$tpl->assign("CODIGO",$busca_tipo_habitacion->id_tipo_habitacion);
			$tpl->assign("NOMBRE",$busca_tipo_habitacion->nombre_tipo_habitacion);
			if($busca_tipo_habitacion->id_tipo_habitacion=='7'){
				$tpl->assign("SELECCIONADO",'SELECTED');
			}
			//$tpl->assign("DESAC","disabled");
		}
	}
	$tpl->gotoBlock( "_ROOT" );
	$tpl->assign("SELECCIONADO","selected");
	$busca_cirujanos->busca_cirujanos();
	while($busca_cirujanos->sgte_busca_cirujanos()){
		$tpl->newBlock("CIRUJANO");
		$tpl->assign("ID_CIRUJANO",$busca_cirujanos->id_cirujano);
		$tpl->assign("NOMBRE_CIRUJANO",utf8_encode($busca_cirujanos->nombre));
		if($busca_cirujanos->id_cirujano==$busca_protocolo->id_cirujano){
			$tpl->assign("SELECCIONADO",'SELECTED');
		}
	}
	$tpl->gotoBlock( "_ROOT" );
	$tpl->assign("RUT_MEDICO",$busca_protocolo->rut_medico);
	$busca_medicamentos->busca_medicamentos();
	while($busca_medicamentos->sgte_busca_medicamentos()){
		$tpl->newBlock("MEDICAMENTO");
		$tpl->assign("ID_MEDICAMENTO",$busca_medicamentos->id_medicamento);
		$tpl->assign("NOMBRE_MEDICAMENTO",utf8_encode($busca_medicamentos->medicamento)." (".utf8_encode($busca_medicamentos->forma)." ".utf8_encode($busca_medicamentos->presentacion.")"));
	}
	
	/*$busca_lugares->busca_lugares();
	while($busca_lugares->sgte_busca_lugares()){
		$tpl->newBlock("LUGARES");
		$tpl->assign("ID_LUGAR",$busca_lugares->id_lugar);
		$tpl->assign("NOMBRE_LUGAR",$busca_lugares->nombre_lugar);
	}*/
}else{
	$busca_tipo_habitacion->busca_tipo_habitacion();

	while($busca_tipo_habitacion->sgte_busca_tipo_habitacion()){
		if($busca_tipo_habitacion->id_tipo_habitacion!=7){
		$tpl->newBlock("TIPO_HABITACION");
		$tpl->assign("CODIGO",$busca_tipo_habitacion->id_tipo_habitacion);
		$tpl->assign("NOMBRE",$busca_tipo_habitacion->nombre_tipo_habitacion);
		}
	}
		$tpl->gotoBlock( "_ROOT" );
	$tpl->assign("SELECCIONADO2","selected");
	$busca_cirujanos->busca_cirujanos();
	while($busca_cirujanos->sgte_busca_cirujanos()){
		$tpl->newBlock("CIRUJANO");
		$tpl->assign("ID_CIRUJANO",$busca_cirujanos->id_cirujano);
		$tpl->assign("NOMBRE_CIRUJANO",utf8_encode($busca_cirujanos->nombre));
	}
	$tpl->newBlock("CIRUGIAS");

	$busca_medicamentos->busca_medicamentos();
	$tpl->newBlock("MEDICAMENTO");
	$tpl->assign("ID_MEDICAMENTO",'0');
	$tpl->assign("NOMBRE_MEDICAMENTO",utf8_encode('--Haga click aquí y escriba el medicamento que desea buscar-- '));
	while($busca_medicamentos->sgte_busca_medicamentos()){
		$tpl->newBlock("MEDICAMENTO");
		$tpl->assign("ID_MEDICAMENTO",$busca_medicamentos->id_medicamento);
		$tpl->assign("NOMBRE_MEDICAMENTO",utf8_encode($busca_medicamentos->medicamento)." (".utf8_encode($busca_medicamentos->forma)." ".utf8_encode($busca_medicamentos->presentacion.")"));
	}
	/*$busca_lugares->busca_lugares();
	while($busca_lugares->sgte_busca_lugares()){
		$tpl->newBlock("LUGARES");
		$tpl->assign("ID_LUGAR",$busca_lugares->id_lugar);
		$tpl->assign("NOMBRE_LUGAR",$busca_lugares->nombre_lugar);
	}*/
}
$tpl->printToScreen();
?>