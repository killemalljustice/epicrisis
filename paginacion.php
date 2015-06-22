<?php
include('clases/consultas.php');
$busca_epicrisis_fecha_actual=new consultas();
$busca_nombre_cirujano=new consultas();
$busca_epicrisis_servicio=new consultas();
$busca_epicrisis_cirujano=new consultas();
$busca_epicrisis_entre_fechas=new consultas();
$busca_epicrisis_entre_fechas_cirujano=new consultas();
$busca_epicrisis_entre_fechas_servicio=new consultas();
$busca_epicrisis_cirujano_servicio=new consultas();
$busca_epicrisis_cirujano_servicio_entre_fechas=new consultas();
$busca_epicrisis_solo_ficha=new consultas();
$busca_protocolos_epicrisis=new consultas();
$tpl=new TemplatePower('templates/paginacion.html');
$tpl->prepare();
$diferenciaEntreFechas = new consultas();
$pagina=$_POST["pagina"];
$tipo_pag=$_POST["tipo_pag"];
$rowsPerPage = 30;

//pagina actual
$pageNum = $pagina;

//contando el desplazamiento
$offset = ($pageNum - 1) * $rowsPerPage;
date_default_timezone_set("America/Santiago");
$fecha_actual_comp2=date("Y-m-d");

if($tipo_pag=='1'){
	$i=0;

	$fecha_actual_comp=date("Y-m-j H:i:s");
	
	$fecha_actual=date("Y-m-d");

	$busca_epicrisis_fecha_actual->busca_epicrisis_fecha_actual($fecha_actual,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_fecha_actual->total / $rowsPerPage);


	while($busca_epicrisis_fecha_actual->sgte_busca_epicrisis_fecha_actual()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_fecha_actual->total." resultados)");
			
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

		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_fecha_actual->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		//$tpl->assign("ID_PROTOCOLO",$busca_epicrisis_fecha_actual->id_protocolo);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_fecha_actual->id_epicrisis);
		//echo $diferencia;
		if($busca_epicrisis_fecha_actual->fecha_egreso>=$fecha_actual_comp2){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_fecha_actual->id_epicrisis.");'  style='border:0px;'></center>");
		}
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
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
}
if($tipo_pag=='2'){
	$i=0;
	$id_cirujano=$_POST["id_cirujano"];
	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_cirujano->busca_epicrisis_cirujano($id_cirujano,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_cirujano->total / $rowsPerPage);


	while($busca_epicrisis_cirujano->sgte_busca_epicrisis_cirujano()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_cirujano->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=2&id_medico=".$id_cirujano);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_cirujano->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_cirujano->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_cirujano->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_cirujano->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_cirujano->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_cirujano->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_cirujano->id_epicrisis);
		if($busca_epicrisis_cirujano->fecha_egreso>=$fecha_actual_comp2 ){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_cirujano->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'2');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen epicrisis ingresadas por el cirujano seleccionado</b></center>";
}
if($tipo_pag=='3'){
	$i=0;
	$fecha_inicio=$_POST["fecha_inicio"];
	$fecha_termino=$_POST["fecha_termino"];
	$fecha_ini=explode("/",$fecha_inicio);
	$fecha_inicio=$fecha_ini[2]."-".$fecha_ini[1]."-".$fecha_ini[0];
	$fecha_ter=explode("/",$fecha_termino);
	$fecha_termino=$fecha_ter[2]."-".$fecha_ter[1]."-".$fecha_ter[0];

	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_entre_fechas->busca_epicrisis_entre_fechas($fecha_inicio,$fecha_termino,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_entre_fechas->total / $rowsPerPage);


	while($busca_epicrisis_entre_fechas->sgte_busca_epicrisis_entre_fechas()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_entre_fechas->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=3&fecha_inicio=".$fecha_inicio."&fecha_termino=".$fecha_termino);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_entre_fechas->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_entre_fechas->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_entre_fechas->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_entre_fechas->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_entre_fechas->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_entre_fechas->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_entre_fechas->id_epicrisis);
		//echo $busca_epicrisis_entre_fechas->fecha_egreso." ".$fecha_actual_comp2."<br>";
		if($busca_epicrisis_entre_fechas->fecha_egreso>=$fecha_actual_comp2 ){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_entre_fechas->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'3');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen epicrisis ingresadas entre las fechas seleccionadas</b></center>";
}
if($tipo_pag=='4'){
	$i=0;
	$fecha_inicio=$_POST["fecha_inicio"];
	$fecha_termino=$_POST["fecha_termino"];
	$id_cirujano=$_POST["id_cirujano"];
	$fecha_ini=explode("/",$fecha_inicio);
	$fecha_inicio=$fecha_ini[2]."-".$fecha_ini[1]."-".$fecha_ini[0];
	$fecha_ter=explode("/",$fecha_termino);
	$fecha_termino=$fecha_ter[2]."-".$fecha_ter[1]."-".$fecha_ter[0];

	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_entre_fechas_cirujano->busca_epicrisis_entre_fechas_cirujano($fecha_inicio,$fecha_termino,$id_cirujano,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_entre_fechas_cirujano->total / $rowsPerPage);


	while($busca_epicrisis_entre_fechas_cirujano->sgte_busca_epicrisis_entre_fechas_cirujano()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_entre_fechas_cirujano->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=4&fecha_inicio=".$fecha_inicio."&fecha_termino=".$fecha_termino."&id_medico=".$id_cirujano);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_entre_fechas_cirujano->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_entre_fechas_cirujano->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_entre_fechas_cirujano->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_entre_fechas_cirujano->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_entre_fechas_cirujano->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_entre_fechas_cirujano->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_entre_fechas_cirujano->id_epicrisis);
		if($busca_epicrisis_entre_fechas_cirujano->fecha_egreso>=$fecha_actual_comp2 ){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_entre_fechas_cirujano->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'4');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen epicrisis ingresadas por el cirujano entre las fechas especificadas</b></center>";
}
if($tipo_pag=='5'){
	$i=0;
	$ficha=$_POST["ficha"];

	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_solo_ficha->busca_epicrisis_solo_ficha($ficha,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_solo_ficha->total / $rowsPerPage);


	while($busca_epicrisis_solo_ficha->sgte_busca_epicrisis_solo_ficha()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_solo_ficha->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=5&rut=".$ficha);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_solo_ficha->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_solo_ficha->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_solo_ficha->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_solo_ficha->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_solo_ficha->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
			$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_solo_ficha->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_solo_ficha->id_epicrisis);
		if($busca_epicrisis_solo_ficha->fecha_egreso>=$fecha_actual_comp2){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_solo_ficha->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'5');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen registros del RUT o DNI ingresado</b></center>";
}
if($tipo_pag=='6'){
	$i=0;
	$fecha_inicio=$_POST["fecha_inicio"];
	$fecha_termino=$_POST["fecha_termino"];
	$id_servicio=$_POST["id_servicio"];
	$fecha_ini=explode("/",$fecha_inicio);
	$fecha_inicio=$fecha_ini[2]."-".$fecha_ini[1]."-".$fecha_ini[0];
	$fecha_ter=explode("/",$fecha_termino);
	$fecha_termino=$fecha_ter[2]."-".$fecha_ter[1]."-".$fecha_ter[0];

	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_entre_fechas_servicio->busca_epicrisis_entre_fechas_servicio($fecha_inicio,$fecha_termino,$id_servicio,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_entre_fechas_servicio->total / $rowsPerPage);


	while($busca_epicrisis_entre_fechas_servicio->sgte_busca_epicrisis_entre_fechas_cirujano()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_entre_fechas_servicio->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=6&fecha_inicio=".$fecha_inicio."&fecha_termino=".$fecha_termino."&id_servicio=".$id_servicio);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_entre_fechas_servicio->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_entre_fechas_servicio->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_entre_fechas_servicio->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_entre_fechas_servicio->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_entre_fechas_servicio->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_entre_fechas_servicio->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_entre_fechas_servicio->id_epicrisis);
		if($busca_epicrisis_entre_fechas_servicio->fecha_egreso>=$fecha_actual_comp2){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_entre_fechas_servicio->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'6');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen epicrisis del servicio indicado entre las fechas seleccionadas</b></center>";
}
if($tipo_pag=='7'){
	$i=0;
	$id_cirujano=$_POST["id_cirujano"];
	$id_servicio=$_POST["id_servicio"];

	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_cirujano_servicio->busca_epicrisis_cirujano_servicio($id_cirujano,$id_servicio,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_cirujano_servicio->total / $rowsPerPage);


	while($busca_epicrisis_cirujano_servicio->sgte_busca_epicrisis_cirujano_servicio()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_cirujano_servicio->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=7&id_cirujano=".$id_cirujano."&id_servicio=".$id_servicio);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_cirujano_servicio->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_cirujano_servicio->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_cirujano_servicio->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_cirujano_servicio->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_cirujano_servicio->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_cirujano_servicio->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_cirujano_servicio->id_epicrisis);
		if($busca_epicrisis_cirujano_servicio->fecha_egreso>=$fecha_actual_comp2){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_cirujano_servicio->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'7');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen epicrisis del cirujano seleccionado en el servicio especificado</b></center>";
}
if($tipo_pag=='8'){
	$i=0;
	$id_cirujano=$_POST["id_cirujano"];
	$id_servicio=$_POST["id_servicio"];
	$fecha_inicio=$_POST["fecha_inicio"];
	$fecha_termino=$_POST["fecha_termino"];

	$fecha_ini=explode("/",$fecha_inicio);
	$fecha_inicio=$fecha_ini[2]."-".$fecha_ini[1]."-".$fecha_ini[0];
	$fecha_ter=explode("/",$fecha_termino);
	$fecha_termino=$fecha_ter[2]."-".$fecha_ter[1]."-".$fecha_ter[0];

	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_cirujano_servicio_entre_fechas->busca_epicrisis_cirujano_servicio_entre_fechas($id_cirujano,$id_servicio,$fecha_inicio,$fecha_termino,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_cirujano_servicio_entre_fechas->total / $rowsPerPage);


	while($busca_epicrisis_cirujano_servicio_entre_fechas->sgte_busca_epicrisis_cirujano_servicio_entre_fechas()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_cirujano_servicio_entre_fechas->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=8&id_cirujano=".$id_cirujano."&id_servicio=".$id_servicio."&fecha_inicio=".$fecha_inicio."&fecha_termino=".$fecha_termino);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_cirujano_servicio_entre_fechas->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_cirujano_servicio_entre_fechas->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_cirujano_servicio_entre_fechas->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_cirujano_servicio_entre_fechas->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_cirujano_servicio_entre_fechas->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_cirujano_servicio_entre_fechas->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_cirujano_servicio_entre_fechas->id_epicrisis);
		if($busca_epicrisis_cirujano_servicio_entre_fechas->fecha_egreso>=$fecha_actual_comp2){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_cirujano_servicio_entre_fechas->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'8');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen epicrisis del cirujano entre las fechas y servicio seleccionados</b></center>";
}
if($tipo_pag=='9'){
	$i=0;
	$id_servicio=$_POST["id_servicio"];

	$fecha_actual_comp=date("Y-m-j H:i:s");

	$busca_epicrisis_servicio->busca_epicrisis_servicio($id_servicio,$offset,$rowsPerPage);
	$total_paginas = ceil($busca_epicrisis_servicio->total / $rowsPerPage);


	while($busca_epicrisis_servicio->sgte_busca_epicrisis_servicio()){
		
		if($i==0){
			$tpl->newBlock("TITULO");
			$tpl->assign("NUMERO_RESULTADOS","(".$busca_epicrisis_servicio->total." resultados)");
			$tpl->assign("PARAMETROS","tipo_desc=9&id_servicio=".$id_servicio);
		}
		$diferencia=$diferenciaEntreFechas->diferenciaEntreFechas($fecha_actual_comp,$busca_epicrisis_servicio->fecha_ingreso_epicrisis, "HORAS", FALSE);
		$tpl->newBlock("FILAS");
		$tpl->assign("RUT",$busca_epicrisis_servicio->rut);
		$tpl->assign("PACIENTE",$busca_epicrisis_servicio->nombre_paciente);
		$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis_servicio->id_cirujano);
		$tpl->assign("CIRUJANO",utf8_encode($busca_nombre_cirujano->nombre));
		$fecha_sep=explode("-",$busca_epicrisis_servicio->fecha_egreso);
		$fecha=$fecha_sep[2]."/".$fecha_sep[1]."/".$fecha_sep[0];
		$tpl->assign("FECHA_EGRE",$fecha);
		$protocolos="";
		$busca_protocolos_epicrisis->busca_protocolos_epicrisis($busca_epicrisis_servicio->id_epicrisis);
		while($busca_protocolos_epicrisis->sgte_busca_protocolos_epicrisis()){
			$protocolos=$protocolos."<a href='../protocolo_operatorio/crea_pdf.php?id_protocolo=".$busca_protocolos_epicrisis->id_protocolo."' target='_blank'><img src='imagenes/icono.jpg' width='20'  style='border:0px;'></a>";
		}
		$tpl->assign("PROTOCOLOS",$protocolos);
		$tpl->assign("ID_EPICRISIS",$busca_epicrisis_servicio->id_epicrisis);
		if($busca_epicrisis_servicio->fecha_egreso>=$fecha_actual_comp2){
			$tpl->assign("EDITAR","<center><a href='javascript:void(0);'><img src='imagenes/editar.png' width='20' onclick='carga_editar(".$busca_epicrisis_servicio->id_epicrisis.");'  style='border:0px;'></center>");
		}
		$i++;
	}
	 if ($total_paginas > 1) {
		$tpl->gotoBlock("_ROOT");
		$tpl->newBlock("PAGINACION");
		$tpl->assign("VALOR_TIPO",'9');
		
		if ($pageNum != 1){
			$tpl->newBlock("ANTERIOR");
			$tpl->assign("NUMERO",($pageNum-1));
		}
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pageNum == $i){
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO","class='active'");
				$tpl->assign("NUMERO2",$i);
			}
			else{
				$tpl->newBlock("SINCONENLACE");
				$tpl->assign("CONTENIDO2","class='paginate' data='".$i."'");
				$tpl->assign("NUMERO2",$i);
			}
        }
		if ($pageNum != $total_paginas){
			$tpl->newBlock("SIGUIENTE");
			$tpl->assign("NUMERO4",($pageNum+1));
		}
	}
	if($i==0)
		echo "<center><b>No existen epicrisis del servicio seleccionado</b></center>";
}
$tpl->printToScreen();
?>