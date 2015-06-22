<?php
include('clases/consultas.php');
$guarda_epicrisis=new consultas();
$guarda_protocolo_epicrisis=new consultas();
$guarda_med_ars=new consultas();
$guarda_citaciones=new consultas();
$obtiene_ultima_receta=new consultas();

$id_protocolo=$_POST["id_protocolo"];
$rut=$_POST["rut"];
$nombre_paciente=mb_strtoupper(addslashes($_POST["nombre_paciente"]));
$ficha=addslashes($_POST["ficha"]);
$tipo_habitacion=$_POST["tipo_habitacion"];
$habitacion=$_POST["habitacion"];
$ambito=$_POST["ambito"];

$fecha_ingreso=$_POST["fecha_ingreso"];
$fecha_temp=explode("/",$fecha_ingreso);
$fecha_ingreso=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];

$fecha_egreso=$_POST["fecha_egreso"];
$fecha_temp=explode("/",$fecha_egreso);
$fecha_egreso=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];

$id_cirujano=$_POST["id_cirujano"];

$egreso=trim(addslashes($_POST["egreso"]));
$egreso2=trim(addslashes($_POST["egreso2"]));
$resumen=trim(addslashes($_POST["resumen"]));

$complicaciones=trim(addslashes($_POST["complicaciones"]));
$procedimientos=trim(addslashes($_POST["procedimientos"]));

$regimen=addslashes($_POST["regimen"]);
$reposo=addslashes($_POST["reposo"]);
$regimen_ped=addslashes($_POST["regimen_ped"]);
$reposo_ped=addslashes($_POST["reposo_ped"]);
$otras_indicaciones=trim(addslashes($_POST["otras_indicaciones"]));

//echo $regimen." ".$reposo." ".$otras_indicaciones;

/*$lugar=$_POST["lugar"];
$fecha=$_POST["fecha"];
$fecha_temp=explode("/",$fecha);

$fecha=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];*/


$nro_medicamentos_arsenal=$_POST["nro_medicamentos_arsenal"];
$nro_medicamentos=$_POST["nro_medicamentos"];
$nro_citaciones=$_POST["nro_citaciones"];

$edad=$_POST["edad"];
$tipo_edad=$_POST["tipo_edad"];

$rut_dni=$_POST["rut_dni"];
$rut_medico=$_POST["rut_medico"];
$cirugias=trim(addslashes($_POST["cirugias"]));

$peso_ingreso=trim(addslashes($_POST["peso_ingreso"]));
$peso_egreso=trim(addslashes($_POST["peso_egreso"]));
$dias_estadia=trim(addslashes($_POST["dias_estadia"]));
$estadia_uci=trim(addslashes($_POST["estadia_uci"]));
$sexo=trim(addslashes($_POST["sexo"]));

$nombre_padre=trim(addslashes($_POST["nombre_padre"]));
$escol_padre=trim(addslashes($_POST["escol_padre"]));
$nombre_madre=trim(addslashes($_POST["nombre_madre"]));
$escol_madre=trim(addslashes($_POST["escol_madre"]));
$direccion=trim(addslashes($_POST["direccion"]));
$fono=trim(addslashes($_POST["fono"]));
$parto=trim(addslashes($_POST["parto"]));
$apgar=trim(addslashes($_POST["apgar"]));
$gr_mat=$_POST["gr_mat"];
$gr_rn=$_POST["gr_rn"];

$fecha_bgc=trim(addslashes($_POST["fecha_bgc"]));
$fecha_temp=explode("/",$fecha_bgc);
$fecha_bgc=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];

$fecha_pku=trim(addslashes($_POST["fecha_pku"]));
$fecha_temp=explode("/",$fecha_pku);
$fecha_pku=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];

$fecha_nac=trim(addslashes($_POST["fecha_nac"]));
$fecha_temp=explode("/",$fecha_nac);
$fecha_nac=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];

$peso_nac=trim(addslashes($_POST["peso_nac"]));
$peso_alta=trim(addslashes($_POST["peso_alta"]));
$dias_estadia_neo=trim(addslashes($_POST["dias_estadia_neo"]));
$dif_peso=trim(addslashes($_POST["dif_peso"]));



date_default_timezone_set("America/Santiago");
$fecha_actual=date("Y-m-j H:i:s");

$obtiene_ultima_receta->obtiene_ultima_receta($tipo_habitacion=$_POST["tipo_habitacion"]);
$nueva_receta=$obtiene_ultima_receta->ultima_receta+1;


$guarda_epicrisis->guarda_epicrisis($rut,$nombre_paciente,$ficha,$tipo_habitacion,$habitacion,$ambito,$fecha_ingreso,$fecha_egreso,$id_cirujano,$egreso,$egreso2,$resumen,$regimen,$reposo,$regimen_ped,$reposo_ped,$otras_indicaciones,$fecha_actual,$edad,$tipo_edad,$rut_dni,$rut_medico,$cirugias,$nueva_receta,$peso_ingreso,$peso_egreso,$dias_estadia,$estadia_uci,$sexo,$nombre_padre,$escol_padre,$nombre_madre,$escol_madre,$direccion,$fono,$parto,$apgar,$gr_mat,$gr_rn,$fecha_bgc,$fecha_pku,$fecha_nac,$peso_nac,$peso_alta,$dias_estadia_neo,$dif_peso,$complicaciones,$procedimientos);

if($id_protocolo!=0)
	$guarda_protocolo_epicrisis->guarda_protocolo_epicrisis($guarda_epicrisis->ultimo_id,$id_protocolo);


//echo $_POST["med_ars11"];
for($i=1;$i<=$nro_medicamentos_arsenal;$i++){
	$id_epicrisis=$guarda_epicrisis->ultimo_id;
	$id_medicamento=$_POST["med_ars".$i."1"];
	$dosis=$_POST["med_ars".$i."3"];
	$frecuencia=$_POST["med_ars".$i."4"];
	$duracion=$_POST["med_ars".$i."5"];
	$via=$_POST["med_ars".$i."6"];
	$guarda_med_ars->guarda_med_ars($id_epicrisis,$id_medicamento,$dosis,$frecuencia,$duracion,$via);
}

for($i=1;$i<=$nro_medicamentos;$i++){
	$id_epicrisis=$guarda_epicrisis->ultimo_id;
	$nombre_medicamento=$_POST["med".$i."1"];
	$dosis=$_POST["med".$i."2"];
	$frecuencia=$_POST["med".$i."3"];
	$duracion=$_POST["med".$i."4"];
	$via=$_POST["med".$i."5"];
	$guarda_med_ars->guarda_med($id_epicrisis,$nombre_medicamento,$dosis,$frecuencia,$duracion,$via);
}

for($i=1;$i<=$nro_citaciones;$i++){
	$id_epicrisis=$guarda_epicrisis->ultimo_id;
	$lugar=addslashes($_POST["cit".$i."1"]);
	$fecha=addslashes($_POST["cit".$i."2"]);
	//$fecha_temp=explode("/",$fecha);
	//$fecha=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];
	$guarda_citaciones->guarda_citaciones($id_epicrisis,$lugar,$fecha);
}
?>