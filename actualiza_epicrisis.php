<?php
include('clases/consultas.php');
$actualiza_epicrisis=new consultas();
$guarda_med_ars=new consultas();
$guarda_citaciones=new consultas();
$elimina_medicamentos=new consultas();

$id_epicrisis=$_POST["id_epicrisis"];
$rut=$_POST["rut"];
$nombre_paciente=$_POST["nombre_paciente"];
$ficha=$_POST["ficha"];
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

//$resumen=str_replace(chr(226), "\"", $resumen); 
//$resumen = preg_replace('/[^\x20-\x7E]/','', $resumen);


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
$rut_medico=$_POST["rut_medico"];
$cirugias=addslashes($_POST["cirugias"]);

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
$estado=$_POST["estado"];


date_default_timezone_set("America/Santiago");
$fecha_actual=date("Y-m-j H:i:s");

$actualiza_epicrisis->actualiza_epicrisis($id_epicrisis,$rut,$nombre_paciente,$ficha,$tipo_habitacion,$habitacion,$ambito,$fecha_ingreso,$fecha_egreso,$id_cirujano,$egreso,$resumen,$complicaciones,$procedimientos,$regimen,$reposo,$regimen_ped,$reposo_ped,$otras_indicaciones,$fecha_actual,$edad,$tipo_edad,$rut_medico,$egreso2,$cirugias,$peso_ingreso,$peso_egreso,$dias_estadia,$estadia_uci,$sexo,$nombre_padre,$escol_padre,$nombre_madre,$escol_madre,$direccion,$fono,$parto,$apgar,$gr_mat,$gr_rn,$fecha_bgc,$fecha_pku,$fecha_nac,$peso_nac,$peso_alta,$dias_estadia_neo,$dif_peso,$estado);

$elimina_medicamentos->elimina_medicamentos($id_epicrisis);

//echo $_POST["med_ars11"];
for($i=1;$i<=$nro_medicamentos_arsenal;$i++){
	$id_medicamento=addslashes($_POST["med_ars".$i."1"]);
	$dosis=addslashes($_POST["med_ars".$i."3"]);
	$frecuencia=addslashes($_POST["med_ars".$i."4"]);
	$duracion=addslashes($_POST["med_ars".$i."5"]);
	$via=addslashes($_POST["med_ars".$i."6"]);
	$guarda_med_ars->guarda_med_ars($id_epicrisis,$id_medicamento,$dosis,$frecuencia,$duracion,$via);
}

for($i=1;$i<=$nro_medicamentos;$i++){
	$nombre_medicamento=addslashes($_POST["med".$i."1"]);
	$dosis=addslashes($_POST["med".$i."2"]);
	$frecuencia=addslashes($_POST["med".$i."3"]);
	$duracion=addslashes($_POST["med".$i."4"]);
	$via=addslashes($_POST["med".$i."5"]);
	$guarda_med_ars->guarda_med($id_epicrisis,$nombre_medicamento,$dosis,$frecuencia,$duracion,$via);
}

for($i=1;$i<=$nro_citaciones;$i++){
	$lugar=addslashes($_POST["cit".$i."1"]);
	$fecha=addslashes($_POST["cit".$i."2"]);
	//$fecha_temp=explode("/",$fecha);
	//$fecha=$fecha_temp[2]."-".$fecha_temp[1]."-".$fecha_temp[0];
	$guarda_citaciones->guarda_citaciones($id_epicrisis,$lugar,$fecha);
}
?>