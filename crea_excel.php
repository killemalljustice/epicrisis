<?php
include('clases/consultas.php');
$busca_epicrisis_servicio=new consultas();
$busca_epicrisis_fecha_actual=new consultas();
$busca_epicrisis_por_medico=new consultas();
$busca_epicrisis_entre_fechas=new consultas();
$busca_epicrisis_entre_fechas_medico=new consultas();
$busca_epicrisis_entre_fechas_servicio=new consultas();
$busca_epicrisis_cirujano_servicio=new consultas();
$busca_epicrisis_cirujano_servicio_entre_fechas=new consultas();
$busca_epicrisis_rut=new consultas();
$busca_nombre_medico=new consultas();
$busca_medicamentos_arsenal=new consultas();
$busca_citaciones=new consultas();
header("Content-type: application/vnd.ms-excel;");
header("Content-Disposition: filename=Resultados.xls");
header("Pragma: no-cache");
header("Expires: 0");
$tipo_desc=$_GET["tipo_desc"];
if($tipo_desc=='1'){
	$fecha_actual=$_GET["fecha_actual"];
	$busca_epicrisis_fecha_actual->busca_epicrisis_fecha_actual_excel($fecha_actual);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_fecha_actual->sgte_busca_epicrisis_fecha_actual_excel()){
		if($busca_epicrisis_fecha_actual->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_fecha_actual->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_fecha_actual->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_fecha_actual->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_fecha_actual->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_fecha_actual->nombre_paciente)."</td><td>".$busca_epicrisis_fecha_actual->ficha."</td><td>".$busca_epicrisis_fecha_actual->rut_dni."</td><td>".$busca_epicrisis_fecha_actual->ubicacion."</td><td>".$busca_epicrisis_fecha_actual->habitacion."</td><td>".$busca_epicrisis_fecha_actual->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_fecha_actual->fecha_ingreso."</td><td>".$busca_epicrisis_fecha_actual->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_fecha_actual->rut_medico."</td><td>".utf8_decode($busca_epicrisis_fecha_actual->egreso)."</td><td>".utf8_decode($busca_epicrisis_fecha_actual->egreso2)."</td><td>".utf8_decode($busca_epicrisis_fecha_actual->resumen)."</td><td>".utf8_decode($busca_epicrisis_fecha_actual->cirugias)."</td><td>".utf8_decode($busca_epicrisis_fecha_actual->regimen)."</td><td>".utf8_decode($busca_epicrisis_fecha_actual->reposo)."</td><td>".utf8_decode($busca_epicrisis_fecha_actual->otras_indicaciones)."</td><td>".$busca_epicrisis_fecha_actual->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_fecha_actual->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_fecha_actual->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_fecha_actual->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_fecha_actual->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='2'){
	$id_medico=$_GET["id_medico"];
	$busca_epicrisis_por_medico->busca_epicrisis_por_medico_excel($id_medico);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_por_medico->sgte_busca_epicrisis_por_medico_excel()){
		if($busca_epicrisis_por_medico->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_por_medico->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_por_medico->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_por_medico->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_por_medico->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_por_medico->nombre_paciente)."</td><td>".$busca_epicrisis_por_medico->ficha."</td><td>".$busca_epicrisis_por_medico->rut_dni."</td><td>".$busca_epicrisis_por_medico->ubicacion."</td><td>".$busca_epicrisis_por_medico->habitacion."</td><td>".$busca_epicrisis_por_medico->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_por_medico->fecha_ingreso."</td><td>".$busca_epicrisis_por_medico->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_por_medico->rut_medico."</td><td>".utf8_decode($busca_epicrisis_por_medico->egreso)."</td><td>".utf8_decode($busca_epicrisis_por_medico->egreso2)."</td><td>".utf8_decode($busca_epicrisis_por_medico->resumen)."</td><td>".utf8_decode($busca_epicrisis_por_medico->cirugias)."</td><td>".utf8_decode($busca_epicrisis_por_medico->regimen)."</td><td>".utf8_decode($busca_epicrisis_por_medico->reposo)."</td><td>".utf8_decode($busca_epicrisis_por_medico->otras_indicaciones)."</td><td>".$busca_epicrisis_por_medico->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_por_medico->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_por_medico->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_por_medico->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_por_medico->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='3'){
	$fecha_inicio=$_GET["fecha_inicio"];
	$fecha_termino=$_GET["fecha_termino"];
	$busca_epicrisis_entre_fechas->busca_epicrisis_entre_fechas_excel($fecha_inicio,$fecha_termino);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_entre_fechas->sgte_busca_epicrisis_entre_fechas_excel()){
		if($busca_epicrisis_entre_fechas->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_entre_fechas->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_entre_fechas->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_entre_fechas->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_entre_fechas->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_entre_fechas->nombre_paciente)."</td><td>".$busca_epicrisis_entre_fechas->ficha."</td><td>".$busca_epicrisis_entre_fechas->rut."</td><td>".$busca_epicrisis_entre_fechas->ubicacion."</td><td>".$busca_epicrisis_entre_fechas->habitacion."</td><td>".$busca_epicrisis_entre_fechas->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_entre_fechas->fecha_ingreso."</td><td>".$busca_epicrisis_entre_fechas->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_entre_fechas->rut_medico."</td><td>".utf8_decode($busca_epicrisis_entre_fechas->egreso)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas->egreso2)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas->resumen)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas->cirugias)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas->regimen)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas->reposo)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas->otras_indicaciones)."</td><td>".$busca_epicrisis_entre_fechas->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_entre_fechas->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_entre_fechas->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_entre_fechas->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_entre_fechas->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='4'){
	$fecha_inicio=$_GET["fecha_inicio"];
	$fecha_termino=$_GET["fecha_termino"];
	$id_medico=$_GET["id_medico"];
	$busca_epicrisis_entre_fechas_medico->busca_epicrisis_entre_fechas_medico_excel($fecha_inicio,$fecha_termino,$id_medico);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_entre_fechas_medico->sgte_busca_epicrisis_entre_fechas_medico_excel()){
		if($busca_epicrisis_entre_fechas_medico->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_entre_fechas_medico->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_entre_fechas_medico->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_entre_fechas_medico->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_entre_fechas_medico->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->nombre_paciente)."</td><td>".$busca_epicrisis_entre_fechas_medico->ficha."</td><td>".$busca_epicrisis_entre_fechas_medico->rut_dni."</td><td>".$busca_epicrisis_entre_fechas_medico->ubicacion."</td><td>".$busca_epicrisis_entre_fechas_medico->habitacion."</td><td>".$busca_epicrisis_entre_fechas_medico->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_entre_fechas_medico->fecha_ingreso."</td><td>".$busca_epicrisis_entre_fechas_medico->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_entre_fechas_medico->rut_medico."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->egreso)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->egreso2)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->resumen)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->cirugias)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->regimen)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->reposo)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_medico->otras_indicaciones)."</td><td>".$busca_epicrisis_entre_fechas_medico->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_entre_fechas_medico->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_entre_fechas_medico->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_entre_fechas_medico->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_entre_fechas_medico->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='5'){
	$rut=$_GET["rut"];
	$busca_epicrisis_rut->busca_epicrisis_rut_excel($rut);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_rut->sgte_busca_epicrisis_rut_excel()){
		if($busca_epicrisis_rut->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_rut->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_rut->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_rut->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_rut->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_rut->nombre_paciente)."</td><td>".$busca_epicrisis_rut->ficha."</td><td>".$busca_epicrisis_rut->rut_dni."</td><td>".$busca_epicrisis_rut->ubicacion."</td><td>".$busca_epicrisis_rut->habitacion."</td><td>".$busca_epicrisis_rut->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_rut->fecha_ingreso."</td><td>".$busca_epicrisis_rut->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_rut->rut_medico."</td><td>".utf8_decode($busca_epicrisis_rut->egreso)."</td><td>".utf8_decode($busca_epicrisis_rut->egreso2)."</td><td>".utf8_decode($busca_epicrisis_rut->resumen)."</td><td>".utf8_decode($busca_epicrisis_rut->cirugias)."</td><td>".utf8_decode($busca_epicrisis_rut->regimen)."</td><td>".utf8_decode($busca_epicrisis_rut->reposo)."</td><td>".utf8_decode($busca_epicrisis_rut->otras_indicaciones)."</td><td>".$busca_epicrisis_rut->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_rut->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_rut->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_rut->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_rut->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='6'){
	$fecha_inicio=$_GET["fecha_inicio"];
	$fecha_termino=$_GET["fecha_termino"];
	$id_servicio=$_GET["id_servicio"];
	$busca_epicrisis_entre_fechas_servicio->busca_epicrisis_entre_fechas_servicio_excel($fecha_inicio,$fecha_termino,$id_servicio);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_entre_fechas_servicio->sgte_busca_epicrisis_entre_fechas_servicio_excel()){
		if($busca_epicrisis_entre_fechas_servicio->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_entre_fechas_servicio->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_entre_fechas_servicio->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_entre_fechas_servicio->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_entre_fechas_servicio->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->nombre_paciente)."</td><td>".$busca_epicrisis_entre_fechas_servicio->ficha."</td><td>".$busca_epicrisis_entre_fechas_servicio->rut_dni."</td><td>".$busca_epicrisis_entre_fechas_servicio->ubicacion."</td><td>".$busca_epicrisis_entre_fechas_servicio->habitacion."</td><td>".$busca_epicrisis_entre_fechas_servicio->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_entre_fechas_servicio->fecha_ingreso."</td><td>".$busca_epicrisis_entre_fechas_servicio->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_entre_fechas_servicio->rut_medico."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->egreso)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->egreso2)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->resumen)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->cirugias)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->regimen)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->reposo)."</td><td>".utf8_decode($busca_epicrisis_entre_fechas_servicio->otras_indicaciones)."</td><td>".$busca_epicrisis_entre_fechas_servicio->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_entre_fechas_servicio->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_entre_fechas_servicio->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_entre_fechas_servicio->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_entre_fechas_servicio->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='7'){
	$id_cirujano=$_GET["id_cirujano"];
	$id_servicio=$_GET["id_servicio"];
	$busca_epicrisis_cirujano_servicio->busca_epicrisis_cirujano_servicio_excel($id_cirujano,$id_servicio);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_cirujano_servicio->sgte_busca_epicrisis_cirujano_servicio_excel()){
		if($busca_epicrisis_cirujano_servicio->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_cirujano_servicio->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_cirujano_servicio->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_cirujano_servicio->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_cirujano_servicio->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_cirujano_servicio->nombre_paciente)."</td><td>".$busca_epicrisis_cirujano_servicio->ficha."</td><td>".$busca_epicrisis_cirujano_servicio->rut_dni."</td><td>".$busca_epicrisis_cirujano_servicio->ubicacion."</td><td>".$busca_epicrisis_cirujano_servicio->habitacion."</td><td>".$busca_epicrisis_cirujano_servicio->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_cirujano_servicio->fecha_ingreso."</td><td>".$busca_epicrisis_cirujano_servicio->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_cirujano_servicio->rut_medico."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio->egreso)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio->egreso2)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio->resumen)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio->cirugias)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio->regimen)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio->reposo)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio->otras_indicaciones)."</td><td>".$busca_epicrisis_cirujano_servicio->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_cirujano_servicio->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_cirujano_servicio->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_cirujano_servicio->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_cirujano_servicio->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='8'){
	$fecha_inicio=$_GET["fecha_inicio"];
	$fecha_termino=$_GET["fecha_termino"];
	$id_servicio=$_GET["id_servicio"];
	$id_cirujano=$_GET["id_cirujano"];
	$busca_epicrisis_cirujano_servicio_entre_fechas->busca_epicrisis_cirujano_servicio_entre_fechas_excel($id_cirujano,$id_servicio,$fecha_inicio,$fecha_termino);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_cirujano_servicio_entre_fechas->sgte_busca_epicrisis_cirujano_servicio_entre_fechas_excel()){
		if($busca_epicrisis_cirujano_servicio_entre_fechas->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_cirujano_servicio_entre_fechas->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_cirujano_servicio_entre_fechas->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_cirujano_servicio_entre_fechas->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_cirujano_servicio_entre_fechas->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->nombre_paciente)."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->ficha."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->rut_dni."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->ubicacion."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->habitacion."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->fecha_ingreso."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->rut_medico."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->egreso)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->egreso2)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->resumen)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->cirugias)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->regimen)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->reposo)."</td><td>".utf8_decode($busca_epicrisis_cirujano_servicio_entre_fechas->otras_indicaciones)."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_cirujano_servicio_entre_fechas->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_cirujano_servicio_entre_fechas->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_cirujano_servicio_entre_fechas->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_cirujano_servicio_entre_fechas->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
if($tipo_desc=='9'){
	$id_servicio=$_GET["id_servicio"];
	$busca_epicrisis_servicio->busca_epicrisis_servicio_excel($id_servicio);
	echo "<table style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td>Nombre Paciente</td><td>Ficha</td><td>RUT o DNI</td><td>Ubicacion</td><td>Habitacion</td><td>Edad</td><td>Tipo Edad</td><td>Fecha Ingreso</td><td>Fecha Egreso</td><td>Medico</td><td>RUT Medico</td><td>Diagnostico Egreso Principal</td><td>Diagnostico Egreso - Otros Diagnosticos</td><td>Resumen</td><td>Cirugias</td><td>Regimen</td><td>Reposo</td><td>Otras Indicaciones</td><td>Fecha Ingreso Epicrisis</td><td>Fecha Ultima Modificacion</td><td>Medicamentos en el Arsenal</td><td>Medicamentos Fuera del Arsenal</td><td>Citacion(es)</td></tr>";
	while($busca_epicrisis_servicio->sgte_busca_epicrisis_servicio_excel()){
		if($busca_epicrisis_servicio->tipo_edad==1)
			$tipo_edad=" Años";
		else if($busca_epicrisis_servicio->tipo_edad==2)
			$tipo_edad=" Meses";
		else if($busca_epicrisis_servicio->tipo_edad==3)
			$tipo_edad=" Dias";
		else if($busca_epicrisis_servicio->tipo_edad==4)
			$tipo_edad=" Horas";
		$busca_nombre_medico->busca_rut_medico($busca_epicrisis_servicio->id_cirujano);
		echo "<tr><td>".utf8_decode($busca_epicrisis_servicio->nombre_paciente)."</td><td>".$busca_epicrisis_servicio->ficha."</td><td>".$busca_epicrisis_servicio->rut_dni."</td><td>".$busca_epicrisis_servicio->ubicacion."</td><td>".$busca_epicrisis_servicio->habitacion."</td><td>".$busca_epicrisis_servicio->edad."</td><td>".utf8_decode($tipo_edad)."</td><td>".$busca_epicrisis_servicio->fecha_ingreso."</td><td>".$busca_epicrisis_servicio->fecha_egreso."</td><td>".$busca_nombre_medico->nombre."</td><td>".$busca_epicrisis_servicio->rut_medico."</td><td>".utf8_decode($busca_epicrisis_servicio->egreso)."</td><td>".utf8_decode($busca_epicrisis_servicio->egreso2)."</td><td>".utf8_decode($busca_epicrisis_servicio->resumen)."</td><td>".utf8_decode($busca_epicrisis_servicio->cirugias)."</td><td>".utf8_decode($busca_epicrisis_servicio->regimen)."</td><td>".utf8_decode($busca_epicrisis_servicio->reposo)."</td><td>".utf8_decode($busca_epicrisis_servicio->otras_indicaciones)."</td><td>".$busca_epicrisis_servicio->fecha_ingreso_epicrisis."</td><td>".$busca_epicrisis_servicio->fecha_ultima_modificacion."</td>";
		
		$busca_medicamentos_arsenal->busca_medicamentos_arsenal($busca_epicrisis_servicio->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
			echo "||".$i.". ".trim($busca_medicamentos_arsenal->medicamento)." (".strtolower($busca_medicamentos_arsenal->forma)." ".strtolower($busca_medicamentos_arsenal->presentacion)."), ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";

		$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($busca_epicrisis_servicio->id_epicrisis);
		$i=1;
		echo "<td>";
		while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
			echo "||".$i.". ".utf8_decode(trim($busca_medicamentos_arsenal->nombre_medicamento)).", ".utf8_decode($busca_medicamentos_arsenal->dosis).", ".utf8_decode($busca_medicamentos_arsenal->frecuencia).", ".utf8_decode($busca_medicamentos_arsenal->duracion).", ".utf8_decode($busca_medicamentos_arsenal->via);
			$i++;
		}
		echo "</td>";
		echo "<td>";
		$busca_citaciones->busca_citaciones($busca_epicrisis_servicio->id_epicrisis);
		while($busca_citaciones->sgte_busca_citaciones()){
			echo "||".utf8_decode($busca_citaciones->lugar).",".utf8_decode($busca_citaciones->fecha);
		}
		echo "</td>";
		echo "</tr>";
	
	}
	echo "</table>";

}
?>