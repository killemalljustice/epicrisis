<?php
session_start();
if(!isset($_SESSION["nombre"])){
	header("location:index.php");
}

include('clases/consultas.php');
$busca_cirujanos= new consultas();
$busca_nombre_cirujano=new consultas();
$busca_epicrisis_fecha_actual=new consultas();
$busca_intervenciones=new consultas();
$diferenciaEntreFechas = new consultas();
$busca_protocolos_epicrisis= new consultas();
date_default_timezone_set("America/Santiago");
$fecha_actual_comp=date("Y-m-j H:i:s");
$fecha_actual_comp2=date("Y-m-d");

$tpl=new TemplatePower('templates/buscar.html');
$tpl->prepare();


$tpl->gotoBlock( "_ROOT" );

//$fecha_actual=date("d/m/Y");

$fecha_actual=date("d/m/Y");
//$fecha_actual = strtotime ( '-1 hour' , strtotime ( $fecha_actual) ) ;
//$fecha_actual = date ( 'd/m/Y' , $fecha_actual );

$tpl->assign("FEC_INICIO",$fecha_actual);
$tpl->assign("FEC_TERMINO",$fecha_actual);
$busca_imagenes=new consultas();
$busca_cirujanos->busca_cirujanos();
while($busca_cirujanos->sgte_busca_cirujanos()){
	$tpl->newBlock("CIRUJANO");
	$tpl->assign("ID_CIRUJANO",$busca_cirujanos->id_cirujano);
	$tpl->assign("NOMBRE_CIRUJANO",utf8_encode($busca_cirujanos->nombre));
}

$busca_tipo_habitacion = new consultas();
$busca_tipo_habitacion->busca_tipo_habitacion();

while($busca_tipo_habitacion->sgte_busca_tipo_habitacion()){
	$tpl->newBlock("SERVICIO");
	$tpl->assign("ID_SERVICIO",$busca_tipo_habitacion->id_tipo_habitacion);
	$tpl->assign("NOMBRE_SERVICIO",$busca_tipo_habitacion->nombre_tipo_habitacion);
}

$fecha_actual=date("Y-m-d");
$i=0;

//numeros de resultados por pagina
$rowsPerPage = 30;
//se muestra por defecto la pagina 1
$pageNum = 1;
//contando el desplazamiento
$offset = ($pageNum - 1) * $rowsPerPage;

$busca_epicrisis_fecha_actual->busca_epicrisis_fecha_actual($fecha_actual,$offset,$rowsPerPage);



//numero total de pagina
$total_paginas = ceil($busca_epicrisis_fecha_actual->total / $rowsPerPage);


while($busca_epicrisis_fecha_actual->sgte_busca_epicrisis_fecha_actual()){
	
	if($i==0){
		$tpl->newBlock("TITULO");
		$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_fecha_actual->total." resultados)");
		$dividido=explode("-",$fecha_actual);
		$fecha_actual_actual=$dividido[2]."/".$dividido[1]."/".$dividido[0];
		$tpl->assign("FECHA_ACTUAL2",$fecha_actual_actual);
		$tpl->assign("FECHA_ACTUAL",$fecha_actual);
	}
	$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_fecha_actual->fecha_ingreso_epicrisis, "HORAS", FALSE);
	$tpl->newBlock("FILAS");
	$tpl->assign("RUT",$busca_epicrisis_fecha_actual->rut);
	$tpl->assign("PACIENTE",$busca_epicrisis_fecha_actual->nombre_paciente);
	$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_fecha_actual->id_cirujano);
	$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
	$fecha_sep=explode("-",$busca_epicrisis_fecha_actual->fecha_egreso);
	$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
	$tpl->assign("FECHA_EGRE",$fecha);
	//$tpl->assign("ID_PROTOCOLO",$busca_epicrisis_fecha_actual->id_protocolo);
	$tpl->assign("ID_EPICRISIS",$busca_epicrisis_fecha_actual->id_epicrisis);
	if($busca_epicrisis_fecha_actual->fecha_egreso>=$fecha_actual_comp2){
		$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_fecha_actual->id_epicrisis.");'  style='border:0px;'></center>");
	}
	$protocolos="";

	$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_fecha_actual->id_epicrisis);
	while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
		$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
	}
	$tpl->assign("PROTOCOLOS",$protocolos);
	/*if($diferencia > 60 or $_SESSION["nombre"]=='informe' or $_SESSION["nombre"]=='orden'){
		if($_SESSION["nombre"]=='orden'){
			$busca_intervenciones->busca_intervenciones_protocolo($busca_protocolos_fecha_actual->id_protocolo);
			
			$tpl->assign("EDITAR_ORDEN","Orden");
			$tpl->newBlock("FILAS3");
			$tpl->assign("RUT",$busca_protocolos_fecha_actual->rut);
			$tpl->assign("PACIENTE",$busca_protocolos_fecha_actual->paciente);
			$tpl->assign("CIRUJANO",utf8_encode($busca_protocolos_fecha_actual->cirujano));
			$fecha_sep=explode("-",$busca_protocolos_fecha_actual->fecha_oper);
			$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
			$tpl->assign("FECHA",$fecha);
			if($busca_protocolos_fecha_actual->orden=='1')
				$tpl->assign("CHECKEADO","CHECKED");
			$todas="";
			while($busca_intervenciones->sgte_busca_intervenciones_protocolo()){
				if($todas=='')
					$todas=$busca_intervenciones->id_intervencion;	
				else
					$todas=$todas."-".$busca_intervenciones->id_intervencion;	
			}
			$tpl->assign("CODIGOS",$todas);
			$tpl->assign("ID_PROTOCOLO",$busca_protocolos_fecha_actual->id_protocolo);
		}else{
			$tpl->assign("EDITAR_ORDEN","Editar");
			$tpl->newBlock("FILAS2");
			$tpl->assign("RUT",$busca_protocolos_fecha_actual->rut);
			$tpl->assign("PACIENTE",$busca_protocolos_fecha_actual->paciente);
			$tpl->assign("CIRUJANO",utf8_encode($busca_protocolos_fecha_actual->cirujano));
			$fecha_sep=explode("-",$busca_protocolos_fecha_actual->fecha_oper);
			$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
			$tpl->assign("FECHA",$fecha);
			$tpl->assign("ID_PROTOCOLO",$busca_protocolos_fecha_actual->id_protocolo);
			$busca_imagenes->busca_imagenes($busca_protocolos_fecha_actual->id_protocolo);
				if($busca_imagenes->sgte_busca_imagenes()){
					$tpl->assign("IMAGEN","&nbsp;<a href='ver_imagenes.php?id_protocolo=".$busca_protocolos_fecha_actual->id_protocolo."' target='_blank'><img src='archivos/".$busca_imagenes->nombre_imagen."' width='20'></a>");
				}
		}
	}
	else{
		$tpl->assign("EDITAR_ORDEN","Editar");
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_protocolos_fecha_actual->rut);
		$tpl->assign("PACIENTE",$busca_protocolos_fecha_actual->paciente);
		$tpl->assign("CIRUJANO",utf8_encode($busca_protocolos_fecha_actual->cirujano));
		$fecha_sep=explode("-",$busca_protocolos_fecha_actual->fecha_oper);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA",$fecha);
		$tpl->assign("ID_PROTOCOLO",$busca_protocolos_fecha_actual->id_protocolo);
		$busca_imagenes->busca_imagenes($busca_protocolos_fecha_actual->id_protocolo);
				if($busca_imagenes->sgte_busca_imagenes()){
					$tpl->assign("IMAGEN","&nbsp;<a href='ver_imagenes.php?id_protocolo=".$busca_protocolos_fecha_actual->id_protocolo."' target='_blank'><img src='archivos/".$busca_imagenes->nombre_imagen."' width='20'></a>");
				}
	}*/
	$i++;
}
if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'1');
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				//si muestro el índice de la página actual, no coloco enlace
				$tpl->newBlock("SINENLACE");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				//si el índice no corresponde con la página mostrada actualmente,
				//coloco el enlace para ir a esa página
				$tpl->newBlock("CONENLACE");
				$tpl->assign("NUMERO3",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
			
 }
 if($i==0){
	 $tpl->gotoBlock("_ROOT");
	$tpl->newBlock("MENSAJE");
 }

          
$tpl->printToScreen();
?>