<?php
include('clases/consultas.php');
//require('fpdf17/fpdf.php');
require('fpdf17/mc_table.php');
class PDF extends FPDF
{
// Cabecera de página



}
$id_epicrisis=$_GET["id_epicrisis"];
$busca_nombre_lugar=new consultas();
$busca_epicrisis=new consultas();
$busca_epicrisis->busca_epicrisis($id_epicrisis);
$pdf=new PDF_MC_Table();

//$pdf->Open();
$pdf->AliasNbPages();
$pdf->cambiaTipo(1);
if($busca_epicrisis->ubicacion==8 or $busca_epicrisis->ubicacion==9){
	$pdf->header=4;
}else{
	$pdf->header=1;
}
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(22,7,utf8_decode('Nombre'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_paciente),1);
$pdf->SetFont('Arial','B',12);


if($busca_epicrisis->rut_dni==1)
	$rut_dni="RUT:";
else if($busca_epicrisis->rut_dni==2)
	$rut_dni="DNI:";

$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,7,$rut_dni,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(28,7,utf8_decode($busca_epicrisis->rut),1);

$pdf->Ln(7);

$pdf->SetFont('Arial','B',12);
if($busca_epicrisis->ubicacion==9){
	$edad='Edad Gest';
}else{
	$edad='Edad';
}
$pdf->Cell(29,7,$edad,1);
$pdf->SetFont('Arial','',12);
if($busca_epicrisis->tipo_edad=='1')
	$tipo_edad=utf8_decode('Años');
else if($busca_epicrisis->tipo_edad=='2')
	$tipo_edad=utf8_decode('Meses');
else if($busca_epicrisis->tipo_edad=='3')
	$tipo_edad=utf8_decode('Dias');
else if($busca_epicrisis->tipo_edad=='4')
	$tipo_edad=utf8_decode('Horas');
else if($busca_epicrisis->tipo_edad=='5')
	$tipo_edad=utf8_decode('Semanas');
$pdf->Cell(26,7,$busca_epicrisis->edad." ".$tipo_edad,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(33,7,utf8_decode('Fecha Ingreso'),1);
$pdf->SetFont('Arial','',12);

$dividido=explode("-",$busca_epicrisis->fecha_ingreso);
$fecha_ingreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

$pdf->Cell(40,7,utf8_decode($fecha_ingreso),1);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,7,'Fecha Egreso',1);
$pdf->SetFont('Arial','',12);

$dividido=explode("-",$busca_epicrisis->fecha_egreso);
$fecha_egreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

$pdf->Cell(28,7,utf8_decode($fecha_egreso),1);

$pdf->Ln(7);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(29,7,utf8_decode('Nro Ub Int'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(26,7,$busca_epicrisis->ficha,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(33,7,utf8_decode('Ubicación'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,7,$busca_epicrisis->nombre_tipo_habitacion,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,7,utf8_decode('Habitación'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(28,7,$busca_epicrisis->nombre_habitacion,1);

if($busca_epicrisis->ubicacion==8){
	$pdf->Ln(7);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Sexo'),1);
	$pdf->SetFont('Arial','',12);
	$sexo='';
	if($busca_epicrisis->sexo=='1'){
		$sexo='Masculino';
	}else if($busca_epicrisis->sexo=='2'){
		$sexo='Femenino';
	}
	$pdf->Cell(33,7,$sexo,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Peso Ingreso'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,$busca_epicrisis->peso_ingreso,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Peso Egreso'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->peso_egreso,1);

	$pdf->Ln(7);


	$pdf->Cell(55,7,'',1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Dias Estadia'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,$busca_epicrisis->dias_estadia,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Estadia UCI'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->estadia_uci,1);
}
if($busca_epicrisis->ubicacion==9){
	$pdf->Ln(14);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Padre'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_padre),1);
	$pdf->SetFont('Arial','B',12);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,'Escolaridad',1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,utf8_decode($busca_epicrisis->escol_padre),1);

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Madre'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_madre),1);
	$pdf->SetFont('Arial','B',12);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,'Escolaridad',1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,utf8_decode($busca_epicrisis->escol_madre),1);

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Dirección'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(106,7,utf8_decode($busca_epicrisis->direccion),1);
	$pdf->SetFont('Arial','B',12);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,'Fono',1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,utf8_decode($busca_epicrisis->fono),1);

	$pdf->Ln(14);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Parto'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,7,utf8_decode($busca_epicrisis->parto),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Apgar'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,utf8_decode($busca_epicrisis->apgar),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('GR. MAT'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->gr_mat,1);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('GR. RN'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,7,utf8_decode($busca_epicrisis->gr_rn),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Fecha BGC'),1);
	$pdf->SetFont('Arial','',12);
	if($busca_epicrisis->fecha_bgc!='0000-00-00'){
		$dividido=explode("-",$busca_epicrisis->fecha_bgc);
		$fecha_bgc=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	}else{
		$fecha_bgc='';
	}
	$pdf->Cell(40,7,$fecha_bgc,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Fecha PKU'),1);
	$pdf->SetFont('Arial','',12);
	if($busca_epicrisis->fecha_pku!='0000-00-00'){
		$dividido=explode("-",$busca_epicrisis->fecha_pku);
		$fecha_pku=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	}else{
		$fecha_pku='';
	}
	$pdf->Cell(28,7,$fecha_pku,1);

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Fecha Nac'),1);
	$pdf->SetFont('Arial','',12);
	$dividido=explode("-",$busca_epicrisis->fecha_nac);
	$fecha_nac=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	$pdf->Cell(33,7,$fecha_nac,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Peso Nac'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,utf8_decode($busca_epicrisis->peso_nac),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Peso Alta'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->peso_alta,1);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Dif. Peso'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,7,utf8_decode($busca_epicrisis->dif_peso),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Dias Estadia'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,utf8_decode($busca_epicrisis->dias_estadia_neo),1);

	/*$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Fecha PKU'),1);
	$pdf->SetFont('Arial','',12);
	$dividido=explode("-",$busca_epicrisis->fecha_pku);
	$fecha_pku=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	$pdf->Cell(28,7,$fecha_pku,1);*/
}
$pdf->Ln(14);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(188,7,utf8_decode('DIAGNÓSTICO DE EGRESO'),1,0,'C');
$pdf->Ln(7);
$pdf->Cell(94,7,utf8_decode('PRINCIPAL'),1,0,'C');
$pdf->Cell(94,7,utf8_decode('OTROS DIAGNÓSTICOS'),1,0,'C');

$pdf->Ln(7);
$pdf->SetFont('Arial','',12);
$pdf->SetWidths(array(94, 94));
$pdf->Row(array(utf8_decode($busca_epicrisis->egreso), utf8_decode($busca_epicrisis->egreso2) ));

/*$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(94,7,utf8_decode('DIAGNOSTICO DE INGRESO'),1,0,'C');
$pdf->Cell(94,7,utf8_decode('DIAGNOSTICO DE EGRESO'),1,0,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','',12);
$pdf->SetWidths(array(94, 94));
$pdf->Row(array(utf8_decode($busca_epicrisis->ingreso), utf8_decode($busca_epicrisis->egreso)));*/




//$pdf->MultiCell(128,7,$busca_epicrisis->egreso,1);
/*$array = explode("\n",utf8_decode($busca_epicrisis->egreso));
$entero="";
foreach($array  as $key => $item) {
	
	$pdf->Cell(5,5,$item);
	$pdf->Ln(5);
}*/
$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(188,7,utf8_decode('RESUMEN HOSPITALIZACIÓN'),1,0,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->resumen),1);
/*$array = explode("\n",utf8_decode($busca_epicrisis->resumen));
$entero="";
foreach($array  as $key => $item) {
	
	$pdf->Cell(5,5,$item);
	$pdf->Ln(5);
}*/

if($busca_epicrisis->complicaciones!=''){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('COMPLICACIONES DURANTE LA HOSPITALIZACIÓN'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->complicaciones),1);
}

if($busca_epicrisis->cirugias!=''){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('CIRUGIA(S) Y/O INTERVENCIONES REALIZADA(S)'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->cirugias),1);
}

if($busca_epicrisis->ubicacion==9 || $busca_epicrisis->ubicacion==8){
	if($busca_epicrisis->fecha_egreso > '2014-09-30'){
		if($busca_epicrisis->ubicacion==8){
			$pdf->Ln(7);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
			$pdf->Ln(7);
			$pdf->Cell(94,7,utf8_decode('REPOSO'),1,0,'C');
			$pdf->Cell(94,7,utf8_decode('REGIMEN'),1,0,'C');

			$pdf->Ln(7);
			$pdf->SetFont('Arial','',12);
			$pdf->SetWidths(array(94, 94));
			$pdf->Row(array(utf8_decode($busca_epicrisis->reposo_ped), utf8_decode($busca_epicrisis->regimen_ped)));
			$pdf->Ln(7);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(188,7,utf8_decode('OTRAS INDICACIONES'),1,0,'C');
			
			$pdf->Ln(7);
			$pdf->SetFont('Arial','',12);
			$pdf->SetWidths(array(188));
			$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));

		}else if($busca_epicrisis->ubicacion==9){
			$pdf->Ln(7);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
			
			$pdf->Ln(7);
			$pdf->SetFont('Arial','',12);
			$pdf->SetWidths(array(188));
			$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));
		}
	}else{
		$pdf->Ln(7);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
		
		$pdf->Ln(7);
		$pdf->SetFont('Arial','',12);
		$pdf->SetWidths(array(188));
		$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));
	}
	/*$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
	
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->SetWidths(array(188));
	$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));*/
}else{
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
	$pdf->Ln(7);
	$pdf->Cell(94,7,utf8_decode('REPOSO'),1,0,'C');
	$pdf->Cell(94,7,utf8_decode('REGIMEN'),1,0,'C');

	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->SetWidths(array(94, 94));
	$pdf->Row(array(utf8_decode($busca_epicrisis->reposo), utf8_decode($busca_epicrisis->regimen)));
}

if($busca_epicrisis->otras_indicaciones!=""){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	if($busca_epicrisis->ubicacion==9 || $busca_epicrisis->ubicacion==8){
		$pdf->Cell(188,7,utf8_decode('IIH'),1,0,'C');
	}else{
		$pdf->Cell(188,7,utf8_decode('OTRAS INDICACIONES'),1,0,'C');
	}
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->SetWidths(array(188));
	$pdf->Row(array(utf8_decode($busca_epicrisis->otras_indicaciones) ));
}
if($busca_epicrisis->procedimientos!=''){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('PROCEDIMIENTOS REALIZADOS'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->procedimientos),1);
}
/*$pdf->MultiCell(63,6,$busca_epicrisis->reposo,1);
$pdf->MultiCell(63,6,$busca_epicrisis->regimen,1);
$pdf->MultiCell(62,6,$busca_epicrisis->otras_indicaciones,1);*/

/*$array = explode("\n",utf8_decode($busca_epicrisis->indicaciones));
foreach($array  as $key => $item) {
	
	$pdf->Cell(5,5,$item);
	$pdf->Ln(5);
}
*/
$busca_medicamentos_arsenal=new consultas();
$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);
$cuenta_medicamentos=0;
if($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('MEDICAMENTOS EN EL ARSENAL'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);


	$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);
	$i=1;
	while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
		$cuenta_medicamentos++;
		$pdf->MultiCell(188,6,$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via),1);
		$i++;
	}
}
$busca_medicamentos_arsenal=new consultas();
$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
if($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('MEDICAMENTOS FUERA DEL ARSENAL'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);


	$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
	$i=1;
	while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
		$cuenta_medicamentos++;
		$pdf->MultiCell(188,6,$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via),1);
		$i++;
	}
}

if($cuenta_medicamentos==0){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('SIN INDICACIÓN DE MEDICAMENTOS'),0,0,'C');
	$pdf->Ln(7);
}

$busca_citaciones=new consultas();
$busca_citaciones->busca_citaciones($id_epicrisis);
$existe=0;
while($busca_citaciones->sgte_busca_citaciones()){
	
	$existe++;
}

if($existe>0){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('CITACIÓN A CONTROL(ES)'),1,0,'C');
	$pdf->Ln(7);
	$pdf->Cell(110,7,utf8_decode('LUGAR'),1);
	$pdf->Cell(78,7,utf8_decode('FECHA ESTIMADA'),1,0,'C');
	$pdf->SetFont('Arial','',12);
	$busca_citaciones=new consultas();
	$busca_citaciones->busca_citaciones($id_epicrisis);
	$pdf->Ln(7);
	while($busca_citaciones->sgte_busca_citaciones()){
		
		$pdf->SetWidths(array(110, 78));
		$pdf->Row(array(utf8_decode($busca_citaciones->lugar), utf8_decode($busca_citaciones->fecha)));
		
	}
}


$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(18,7,utf8_decode('MEDICO'),1);

$busca_nombre_cirujano=new consultas();

$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis->id_cirujano);




$pdf->SetFont('Arial','',12);
$pdf->Cell(90,7,$busca_nombre_cirujano->nombre,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(11,7,"RUT",1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(26,7,$busca_epicrisis->rut_medico,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(18,7,"Firma",1);
$pdf->Cell(25,7,"",1);


$fecha_temp=explode(" ",$busca_epicrisis->fecha_ingreso_epicrisis);
$fecha_ok=explode("-",$fecha_temp[0]);
$fecha_ingreso=$fecha_ok[2]."/".$fecha_ok[1]."/".$fecha_ok[0]." ".$fecha_temp[1];

if($busca_epicrisis->fecha_ingreso_epicrisis==$busca_epicrisis->fecha_ultima_modificacion)
	$fecha_modificacion="Nunca";
else{
	$fecha_temp=explode(" ",$busca_epicrisis->fecha_ultima_modificacion);
	$fecha_ok=explode("-",$fecha_temp[0]);
	$fecha_modificacion=$fecha_ok[2]."/".$fecha_ok[1]."/".$fecha_ok[0]." ".$fecha_temp[1];
}
date_default_timezone_set("America/Santiago");
$fecha_actual=date("d/m/Y H:i:s");

$pdf->Ln(14);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(24,7,utf8_decode("CREACIÓN"),1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(37,7,$fecha_ingreso,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(33,7,utf8_decode("MODIFICACIÓN"),1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(37,7,$fecha_modificacion,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(19,7,utf8_decode("EMISIÓN"),1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(38,7,$fecha_actual,1);

$pdf->Ln(7);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,"(COPIA FICHA CLINICA)",0,0,'C');
///////////////////////////////////////////////////////////////////////////HOJA 2 ////////////////////////////////////////////////////////////////////////////////////
$pone_ceros=new consultas();
$pdf->cambiaTipo(2);
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(22,7,utf8_decode('Nombre'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_paciente),1);
$pdf->SetFont('Arial','B',12);

if($busca_epicrisis->rut_dni==1)
	$rut_dni="RUT:";
else if($busca_epicrisis->rut_dni==2)
	$rut_dni="DNI:";

$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,7,$rut_dni,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(28,7,utf8_decode($busca_epicrisis->rut),1);

$pdf->Ln(7);

$pdf->SetFont('Arial','B',12);

if($busca_epicrisis->ubicacion==9){
	$edad='Edad Gest';
}else{
	$edad='Edad';
}
$pdf->Cell(22,7,$edad,1);
$pdf->SetFont('Arial','',12);
if($busca_epicrisis->tipo_edad=='1')
	$tipo_edad=utf8_decode('Años');
else if($busca_epicrisis->tipo_edad=='2')
	$tipo_edad=utf8_decode('Meses');
else if($busca_epicrisis->tipo_edad=='3')
	$tipo_edad=utf8_decode('Dias');
else if($busca_epicrisis->tipo_edad=='4')
	$tipo_edad=utf8_decode('Horas');
else if($busca_epicrisis->tipo_edad=='5')
	$tipo_edad=utf8_decode('Semanas');
$pdf->Cell(33,7,$busca_epicrisis->edad." ".$tipo_edad,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(33,7,utf8_decode('Fecha Ingreso'),1);
$pdf->SetFont('Arial','',12);

$dividido=explode("-",$busca_epicrisis->fecha_ingreso);
$fecha_ingreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

$pdf->Cell(40,7,utf8_decode($fecha_ingreso),1);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,7,'Fecha Egreso',1);
$pdf->SetFont('Arial','',12);

$dividido=explode("-",$busca_epicrisis->fecha_egreso);
$fecha_egreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

$pdf->Cell(28,7,utf8_decode($fecha_egreso),1);

$pdf->Ln(7);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(22,7,utf8_decode('Ficha'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(33,7,$busca_epicrisis->ficha,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(33,7,utf8_decode('Ubicación'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,7,$busca_epicrisis->nombre_tipo_habitacion,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,7,utf8_decode('Habitación'),1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(28,7,$busca_epicrisis->nombre_habitacion,1);

if($busca_epicrisis->ubicacion==8){
	$pdf->Ln(7);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Sexo'),1);
	$pdf->SetFont('Arial','',12);
	$sexo='';
	if($busca_epicrisis->sexo=='1'){
		$sexo='Masculino';
	}else if($busca_epicrisis->sexo=='2'){
		$sexo='Femenino';
	}
	$pdf->Cell(33,7,$sexo,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Peso Ingreso'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,$busca_epicrisis->peso_ingreso,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Peso Egreso'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->peso_egreso,1);

	$pdf->Ln(7);


	$pdf->Cell(55,7,'',1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Dias Estadia'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,$busca_epicrisis->dias_estadia,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Estadia UCI'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->estadia_uci,1);
}
if($busca_epicrisis->ubicacion==9){
	$pdf->Ln(14);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Padre'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_padre),1);
	$pdf->SetFont('Arial','B',12);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,'Escolaridad',1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,utf8_decode($busca_epicrisis->escol_padre),1);

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Madre'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_madre),1);
	$pdf->SetFont('Arial','B',12);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,'Escolaridad',1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,utf8_decode($busca_epicrisis->escol_madre),1);

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Dirección'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(106,7,utf8_decode($busca_epicrisis->direccion),1);
	$pdf->SetFont('Arial','B',12);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,'Fono',1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,utf8_decode($busca_epicrisis->fono),1);

	$pdf->Ln(14);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Parto'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,7,utf8_decode($busca_epicrisis->parto),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Apgar'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,utf8_decode($busca_epicrisis->apgar),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('GR. MAT'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->gr_mat,1);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('GR. RN'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,7,utf8_decode($busca_epicrisis->gr_rn),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Fecha BGC'),1);
	$pdf->SetFont('Arial','',12);
	if($busca_epicrisis->fecha_bgc!='0000-00-00'){
		$dividido=explode("-",$busca_epicrisis->fecha_bgc);
		$fecha_bgc=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	}else{
		$fecha_bgc='';
	}
	$pdf->Cell(40,7,$fecha_bgc,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Fecha PKU'),1);
	$pdf->SetFont('Arial','',12);
	if($busca_epicrisis->fecha_pku!='0000-00-00'){
		$dividido=explode("-",$busca_epicrisis->fecha_pku);
		$fecha_pku=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	}else{
		$fecha_pku='';
	}
	$pdf->Cell(28,7,$fecha_pku,1);

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Fecha Nac'),1);
	$pdf->SetFont('Arial','',12);
	$dividido=explode("-",$busca_epicrisis->fecha_nac);
	$fecha_nac=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	$pdf->Cell(33,7,$fecha_nac,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Peso Nac'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,utf8_decode($busca_epicrisis->peso_nac),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Peso Alta'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->peso_alta,1);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Dif. Peso'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,7,utf8_decode($busca_epicrisis->dif_peso),1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Dias Estadia'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,utf8_decode($busca_epicrisis->dias_estadia_neo),1);

	/*$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Fecha PKU'),1);
	$pdf->SetFont('Arial','',12);
	$dividido=explode("-",$busca_epicrisis->fecha_pku);
	$fecha_pku=$dividido[2]."/".$dividido[1]."/".$dividido[0];
	$pdf->Cell(28,7,$fecha_pku,1);*/
}
$pdf->Ln(14);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(188,7,utf8_decode('DIAGNÓSTICO DE EGRESO'),1,0,'C');
$pdf->Ln(7);
$pdf->Cell(94,7,utf8_decode('PRINCIPAL'),1,0,'C');
$pdf->Cell(94,7,utf8_decode('OTROS DIAGNÓSTICOS'),1,0,'C');

$pdf->Ln(7);
$pdf->SetFont('Arial','',12);
$pdf->SetWidths(array(94, 94));
$pdf->Row(array(utf8_decode($busca_epicrisis->egreso), utf8_decode($busca_epicrisis->egreso2) ));

/*$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(94,7,utf8_decode('DIAGNOSTICO DE INGRESO'),1,0,'C');
$pdf->Cell(94,7,utf8_decode('DIAGNOSTICO DE EGRESO'),1,0,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','',12);
$pdf->SetWidths(array(94, 94));
$pdf->Row(array(utf8_decode($busca_epicrisis->ingreso), utf8_decode($busca_epicrisis->egreso)));*/




//$pdf->MultiCell(128,7,$busca_epicrisis->egreso,1);
/*$array = explode("\n",utf8_decode($busca_epicrisis->egreso));
$entero="";
foreach($array  as $key => $item) {
	
	$pdf->Cell(5,5,$item);
	$pdf->Ln(5);
}*/
$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(188,7,utf8_decode('RESUMEN HOSPITALIZACIÓN'),1,0,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->resumen),1);
/*$array = explode("\n",utf8_decode($busca_epicrisis->resumen));
$entero="";
foreach($array  as $key => $item) {
	
	$pdf->Cell(5,5,$item);
	$pdf->Ln(5);
}*/
if($busca_epicrisis->complicaciones!=''){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('COMPLICACIONES DURANTE LA HOSPITALIZACIÓN'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->complicaciones),1);
}

if($busca_epicrisis->cirugias!=''){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('CIRUGIA(S) Y/O INTERVENCIONES REALIZADA(S)'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->cirugias),1);
}

if($busca_epicrisis->ubicacion==9 || $busca_epicrisis->ubicacion==8){
	if($busca_epicrisis->fecha_egreso > '2014-09-30'){
		if($busca_epicrisis->ubicacion==8){
			$pdf->Ln(7);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
			$pdf->Ln(7);
			$pdf->Cell(94,7,utf8_decode('REPOSO'),1,0,'C');
			$pdf->Cell(94,7,utf8_decode('REGIMEN'),1,0,'C');

			$pdf->Ln(7);
			$pdf->SetFont('Arial','',12);
			$pdf->SetWidths(array(94, 94));
			$pdf->Row(array(utf8_decode($busca_epicrisis->reposo_ped), utf8_decode($busca_epicrisis->regimen_ped)));
			$pdf->Ln(7);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(188,7,utf8_decode('OTRAS INDICACIONES'),1,0,'C');
			
			$pdf->Ln(7);
			$pdf->SetFont('Arial','',12);
			$pdf->SetWidths(array(188));
			$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));

		}else if($busca_epicrisis->ubicacion==9){
			$pdf->Ln(7);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
			
			$pdf->Ln(7);
			$pdf->SetFont('Arial','',12);
			$pdf->SetWidths(array(188));
			$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));
		}
	}else{
		$pdf->Ln(7);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
		
		$pdf->Ln(7);
		$pdf->SetFont('Arial','',12);
		$pdf->SetWidths(array(188));
		$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));
	}
	/*$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
	
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->SetWidths(array(188));
	$pdf->Row(array(utf8_decode($busca_epicrisis->reposo)));*/
}else{
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('INDICACIONES DE ALTA'),1,0,'C');
	$pdf->Ln(7);
	$pdf->Cell(94,7,utf8_decode('REPOSO'),1,0,'C');
	$pdf->Cell(94,7,utf8_decode('REGIMEN'),1,0,'C');

	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->SetWidths(array(94, 94));
	$pdf->Row(array(utf8_decode($busca_epicrisis->reposo), utf8_decode($busca_epicrisis->regimen)));
}

if($busca_epicrisis->otras_indicaciones!=""){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	if($busca_epicrisis->ubicacion==9 || $busca_epicrisis->ubicacion==8){
		$pdf->Cell(188,7,utf8_decode('IIH'),1,0,'C');
	}else{
		$pdf->Cell(188,7,utf8_decode('OTRAS INDICACIONES'),1,0,'C');
	}
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->SetWidths(array(188));
	$pdf->Row(array(utf8_decode($busca_epicrisis->otras_indicaciones) ));
}
if($busca_epicrisis->procedimientos!=''){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('PROCEDIMIENTOS REALIZADOS'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->procedimientos),1);
}
/*$pdf->MultiCell(63,6,$busca_epicrisis->reposo,1);
$pdf->MultiCell(63,6,$busca_epicrisis->regimen,1);
$pdf->MultiCell(62,6,$busca_epicrisis->otras_indicaciones,1);*/

/*$array = explode("\n",utf8_decode($busca_epicrisis->indicaciones));
foreach($array  as $key => $item) {
	
	$pdf->Cell(5,5,$item);
	$pdf->Ln(5);
}
*/
$busca_medicamentos_arsenal=new consultas();
$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);
$cuenta_medicamentos=0;
if($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('MEDICAMENTOS EN EL ARSENAL'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);


	$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);
	$i=1;
	while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
		$cuenta_medicamentos++;
		$pdf->MultiCell(188,6,$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via),1);
		$i++;
	}
}
$busca_medicamentos_arsenal=new consultas();
$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
if($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('MEDICAMENTOS FUERA DEL ARSENAL'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);


	$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
	$i=1;
	while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
		$cuenta_medicamentos++;
		$pdf->MultiCell(188,6,$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via),1);
		$i++;
	}
}

if($cuenta_medicamentos==0){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('SIN INDICACIÓN DE MEDICAMENTOS'),0,0,'C');
	$pdf->Ln(7);
}

$busca_citaciones=new consultas();
$busca_citaciones->busca_citaciones($id_epicrisis);
$existe=0;
while($busca_citaciones->sgte_busca_citaciones()){
	
	$existe++;
}

if($existe>0){
	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('CITACIÓN A CONTROL(ES)'),1,0,'C');
	$pdf->Ln(7);
	$pdf->Cell(110,7,utf8_decode('LUGAR'),1);
	$pdf->Cell(78,7,utf8_decode('FECHA ESTIMADA'),1,0,'C');
	$pdf->SetFont('Arial','',12);
	$busca_citaciones=new consultas();
	$busca_citaciones->busca_citaciones($id_epicrisis);
	$pdf->Ln(7);
	while($busca_citaciones->sgte_busca_citaciones()){
		
		$pdf->SetWidths(array(110, 78));
		$pdf->Row(array(utf8_decode($busca_citaciones->lugar), utf8_decode($busca_citaciones->fecha)));
		
	}
}
/*$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(16,7,"Lugar:",1);
$pdf->SetFont('Arial','',12);

$pdf->Cell(52,7,utf8_decode($busca_epicrisis->lugar),1);


$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(16,7,"Fecha:",1);
$pdf->SetFont('Arial','',12);*/

/*$dividido=explode("-",$busca_epicrisis->fecha);
$fecha=$dividido[2]."/".$dividido[1]."/".$dividido[0];

$pdf->Cell(52,7,$fecha,1);
*/


$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(18,7,utf8_decode('MEDICO'),1);

$busca_nombre_cirujano=new consultas();

$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis->id_cirujano);




$pdf->SetFont('Arial','',12);
$pdf->Cell(90,7,$busca_nombre_cirujano->nombre,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(11,7,"RUT",1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(26,7,$busca_epicrisis->rut_medico,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(18,7,"Firma",1);
$pdf->Cell(25,7,"",1);

$fecha_temp=explode(" ",$busca_epicrisis->fecha_ingreso_epicrisis);
$fecha_ok=explode("-",$fecha_temp[0]);
$fecha_ingreso=$fecha_ok[2]."/".$fecha_ok[1]."/".$fecha_ok[0]." ".$fecha_temp[1];

if($busca_epicrisis->fecha_ingreso_epicrisis==$busca_epicrisis->fecha_ultima_modificacion)
	$fecha_modificacion="Nunca";
else{
	$fecha_temp=explode(" ",$busca_epicrisis->fecha_ultima_modificacion);
	$fecha_ok=explode("-",$fecha_temp[0]);
	$fecha_modificacion=$fecha_ok[2]."/".$fecha_ok[1]."/".$fecha_ok[0]." ".$fecha_temp[1];
}
date_default_timezone_set("America/Santiago");
$fecha_actual=date("d/m/Y H:i:s");

$pdf->Ln(14);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(24,7,utf8_decode("CREACIÓN"),1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(37,7,$fecha_ingreso,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(33,7,utf8_decode("MODIFICACIÓN"),1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(37,7,$fecha_modificacion,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(19,7,utf8_decode("EMISIÓN"),1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(38,7,$fecha_actual,1);

$pdf->Ln(7);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,"(COPIA PACIENTE)",0,0,'C');
//////////////////////////////////////////////////////////////////////////////////HOJA 3 ////////////////////////////////////////////////////////////////////////////////////
$k=0;
$busca_medicamentos_arsenal=new consultas();
$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);
if($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
	$k++;
}
$busca_medicamentos_arsenal=new consultas();
$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
if($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
	$k++;
}

if($k>0){

if($busca_epicrisis->nro_receta!=0){

	$pone_ceros=new consultas();
	$pdf->cambiaTipo(3);
	if($busca_epicrisis->ubicacion==8 or $busca_epicrisis->ubicacion==9){
		$pdf->header=2;
	}else{
		$pdf->header=3;
	}
	if($busca_epicrisis->ubicacion==1){
		$prefijo='INF';
	}else if($busca_epicrisis->ubicacion==2){
		$prefijo='MUJ';
	}else if($busca_epicrisis->ubicacion==3){
		$prefijo='CIR';
	}else if($busca_epicrisis->ubicacion==4){
		$prefijo='MED';
	}else if($busca_epicrisis->ubicacion==5){
		$prefijo='TMT';
	}else if($busca_epicrisis->ubicacion==6){
		$prefijo='PEN';
	}else if($busca_epicrisis->ubicacion==7){
		$prefijo='UCA';
	}else if($busca_epicrisis->ubicacion==8){
		$prefijo='PED';
	}else if($busca_epicrisis->ubicacion==9){
		$prefijo='NEO';
	}else if($busca_epicrisis->ubicacion==10){
		$prefijo='UTI';
	}
	$nro_receta=$pone_ceros->number_pad($busca_epicrisis->nro_receta,6);
	$pdf->nro_receta=$prefijo.$nro_receta;

	$pdf->AddPage();

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Nombre'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_paciente),1);
	$pdf->SetFont('Arial','B',12);

	if($busca_epicrisis->rut_dni==1)
		$rut_dni="RUT:";
	else if($busca_epicrisis->rut_dni==2)
		$rut_dni="DNI:";

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,$rut_dni,1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,utf8_decode($busca_epicrisis->rut),1);

	$pdf->Ln(7);

	$pdf->SetFont('Arial','B',12);
	if($busca_epicrisis->ubicacion==9){
		$edad='Edad Gest';
	}else{
		$edad='Edad';
	}
	$pdf->Cell(22,7,$edad,1);
	$pdf->SetFont('Arial','',12);
	if($busca_epicrisis->tipo_edad=='1')
		$tipo_edad=utf8_decode('Años');
	else if($busca_epicrisis->tipo_edad=='2')
		$tipo_edad=utf8_decode('Meses');
	else if($busca_epicrisis->tipo_edad=='3')
		$tipo_edad=utf8_decode('Dias');
	else if($busca_epicrisis->tipo_edad=='4')
		$tipo_edad=utf8_decode('Horas');
	else if($busca_epicrisis->tipo_edad=='5')
		$tipo_edad=utf8_decode('Semanas');
	$pdf->Cell(33,7,$busca_epicrisis->edad." ".$tipo_edad,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Fecha Ingreso'),1);
	$pdf->SetFont('Arial','',12);

	$dividido=explode("-",$busca_epicrisis->fecha_ingreso);
	$fecha_ingreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

	$pdf->Cell(40,7,utf8_decode($fecha_ingreso),1);


	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,'Fecha Egreso',1);
	$pdf->SetFont('Arial','',12);

	$dividido=explode("-",$busca_epicrisis->fecha_egreso);
	$fecha_egreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

	$pdf->Cell(28,7,utf8_decode($fecha_egreso),1);

	$pdf->Ln(7);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(22,7,utf8_decode('Ficha'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,7,$busca_epicrisis->ficha,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode('Ubicación'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,7,$busca_epicrisis->nombre_tipo_habitacion,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(32,7,utf8_decode('Habitación'),1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(28,7,$busca_epicrisis->nombre_habitacion,1);

	if($busca_epicrisis->ubicacion==8){
		$pdf->Ln(7);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('Sexo'),1);
		$pdf->SetFont('Arial','',12);
		$sexo='';
		if($busca_epicrisis->sexo=='1'){
			$sexo='Masculino';
		}else if($busca_epicrisis->sexo=='2'){
			$sexo='Femenino';
		}
		$pdf->Cell(33,7,$sexo,1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(33,7,utf8_decode('Peso Ingreso'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,7,$busca_epicrisis->peso_ingreso,1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,utf8_decode('Peso Egreso'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(28,7,$busca_epicrisis->peso_egreso,1);

		$pdf->Ln(7);


		$pdf->Cell(55,7,'',1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(33,7,utf8_decode('Dias Estadia'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,7,$busca_epicrisis->dias_estadia,1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,utf8_decode('Estadia UCI'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(28,7,$busca_epicrisis->estadia_uci,1);
	}
	if($busca_epicrisis->ubicacion==9){
		$pdf->Ln(14);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('Padre'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_padre),1);
		$pdf->SetFont('Arial','B',12);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,'Escolaridad',1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(28,7,utf8_decode($busca_epicrisis->escol_padre),1);

		$pdf->Ln(7);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('Madre'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(106,7,utf8_decode($busca_epicrisis->nombre_madre),1);
		$pdf->SetFont('Arial','B',12);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,'Escolaridad',1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(28,7,utf8_decode($busca_epicrisis->escol_madre),1);

		$pdf->Ln(7);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('Dirección'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(106,7,utf8_decode($busca_epicrisis->direccion),1);
		$pdf->SetFont('Arial','B',12);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,'Fono',1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(28,7,utf8_decode($busca_epicrisis->fono),1);

		$pdf->Ln(14);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('Parto'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(33,7,utf8_decode($busca_epicrisis->parto),1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(33,7,utf8_decode('Apgar'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,7,utf8_decode($busca_epicrisis->apgar),1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,utf8_decode('GR. MAT'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(28,7,$busca_epicrisis->gr_mat,1);
		$pdf->Ln(7);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('GR. RN'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(33,7,utf8_decode($busca_epicrisis->gr_rn),1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(33,7,utf8_decode('Fecha BGC'),1);
		$pdf->SetFont('Arial','',12);
		if($busca_epicrisis->fecha_bgc!='0000-00-00'){
		$dividido=explode("-",$busca_epicrisis->fecha_bgc);
		$fecha_bgc=$dividido[2]."/".$dividido[1]."/".$dividido[0];
		}else{
			$fecha_bgc='';
		}
		$pdf->Cell(40,7,$fecha_bgc,1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,utf8_decode('Fecha PKU'),1);
		$pdf->SetFont('Arial','',12);
		if($busca_epicrisis->fecha_pku!='0000-00-00'){
			$dividido=explode("-",$busca_epicrisis->fecha_pku);
			$fecha_pku=$dividido[2]."/".$dividido[1]."/".$dividido[0];
		}else{
			$fecha_pku='';
		}
		$pdf->Cell(28,7,$fecha_pku,1);

		$pdf->Ln(7);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('Fecha Nac'),1);
		$pdf->SetFont('Arial','',12);
		$dividido=explode("-",$busca_epicrisis->fecha_nac);
		$fecha_nac=$dividido[2]."/".$dividido[1]."/".$dividido[0];
		$pdf->Cell(33,7,$fecha_nac,1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(33,7,utf8_decode('Peso Nac'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,7,utf8_decode($busca_epicrisis->peso_nac),1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,utf8_decode('Peso Alta'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(28,7,$busca_epicrisis->peso_alta,1);
		$pdf->Ln(7);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(22,7,utf8_decode('Dif. Peso'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(33,7,utf8_decode($busca_epicrisis->dif_peso),1);

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(33,7,utf8_decode('Dias Estadia'),1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,7,utf8_decode($busca_epicrisis->dias_estadia_neo),1);

		/*$pdf->SetFont('Arial','B',12);
		$pdf->Cell(32,7,utf8_decode('Fecha PKU'),1);
		$pdf->SetFont('Arial','',12);
		$dividido=explode("-",$busca_epicrisis->fecha_pku);
		$fecha_pku=$dividido[2]."/".$dividido[1]."/".$dividido[0];
		$pdf->Cell(28,7,$fecha_pku,1);*/
	}
	$pdf->Ln(14);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(188,7,utf8_decode('DIAGNOSTICO PRINCIPAL'),1,0,'C');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(188,6,utf8_decode($busca_epicrisis->egreso),1);
	

	$pdf->Ln(7);
	$busca_medicamentos_arsenal=new consultas();
	$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);

	if($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(188,7,utf8_decode('MEDICAMENTOS EN EL ARSENAL'),1,0,'C');
		$pdf->Ln(7);
		$pdf->SetFont('Arial','',12);

		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);
		$i=1;
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			$pdf->MultiCell(188,6,$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via),1);
			$i++;
		}
		$pdf->Ln(7);
	}

	$busca_medicamentos_arsenal=new consultas();
	$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
	if($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(188,7,utf8_decode('MEDICAMENTOS FUERA DEL ARSENAL'),1,0,'C');
		$pdf->Ln(7);
		$pdf->SetFont('Arial','',12);

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
		$i=1;
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			$pdf->MultiCell(188,6,$i.". ".trim($busca_medicamentos_arsenal->nombre_medicamento).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via),1);
			$i++;
		}
		$pdf->Ln(7);
	}
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(18,7,utf8_decode('MEDICO'),1);

	$busca_nombre_cirujano=new consultas();

	$busca_nombre_cirujano->busca_nombre_cirujano($busca_epicrisis->id_cirujano);




	$pdf->SetFont('Arial','',12);
	$pdf->Cell(90,7,$busca_nombre_cirujano->nombre,1);

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(11,7,"RUT",1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(26,7,$busca_epicrisis->rut_medico,1);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(18,7,"Firma",1);
	$pdf->Cell(25,7,"",1);

	$fecha_temp=explode(" ",$busca_epicrisis->fecha_ingreso_epicrisis);
	$fecha_ok=explode("-",$fecha_temp[0]);
	$fecha_ingreso=$fecha_ok[2]."/".$fecha_ok[1]."/".$fecha_ok[0]." ".$fecha_temp[1];

	if($busca_epicrisis->fecha_ingreso_epicrisis==$busca_epicrisis->fecha_ultima_modificacion)
		$fecha_modificacion="Nunca";
	else{
		$fecha_temp=explode(" ",$busca_epicrisis->fecha_ultima_modificacion);
		$fecha_ok=explode("-",$fecha_temp[0]);
		$fecha_modificacion=$fecha_ok[2]."/".$fecha_ok[1]."/".$fecha_ok[0]." ".$fecha_temp[1];
	}
	date_default_timezone_set("America/Santiago");
	$fecha_actual=date("d/m/Y H:i:s");

	$pdf->Ln(14);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(24,7,utf8_decode("CREACIÓN"),1);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(37,7,$fecha_ingreso,1);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(33,7,utf8_decode("MODIFICACIÓN"),1);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(37,7,$fecha_modificacion,1);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(19,7,utf8_decode("EMISIÓN"),1);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(38,7,$fecha_actual,1);

	$pdf->Ln(7);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(0,10,"(COPIA FARMACIA)",0,0,'C');
}
}
$pdf->Output();
?>