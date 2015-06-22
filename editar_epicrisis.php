<?php
include('clases/consultas.php');
$id_epicrisis=$_POST["id_epicrisis"];
$busca_epicrisis=new consultas();
$busca_medicamentos= new consultas();
$busca_lugares=new consultas();
$busca_epicrisis->busca_epicrisis($id_epicrisis);
$busca_tipo_habitacion=new consultas();
$busca_habitaciones=new consultas();
$busca_cirujanos=new consultas();
$dividido=explode("-",$busca_epicrisis->fecha_ingreso);
$fecha_ingreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

$dividido=explode("-",$busca_epicrisis->fecha_egreso);
$fecha_egreso=$dividido[2]."/".$dividido[1]."/".$dividido[0];

/*$dividido=explode("-",$busca_epicrisis->fecha);
$fecha=$dividido[2]."/".$dividido[1]."/".$dividido[0];*/

if($busca_epicrisis->fecha_ingreso_epicrisis==$busca_epicrisis->fecha_ultima_modificacion)
	$fecha_modificacion="Nunca";
else{
	$dividido2=explode(" ",$busca_epicrisis->fecha_ultima_modificacion);
	$dividido3=explode("-",$dividido2[0]);
	$fecha_modificacion=$dividido3[2]."/".$dividido3[1]."/".$dividido3[0]." ".$dividido2[1];
}

echo "--------------------------------------------------------------------------------------------------------------------------------------<br>";
echo "<center><h2 style='display:inline;'><b>INFORME DE ALTA (EPICRISIS)</b></h2><br>(Ultima Modificacion: ".$fecha_modificacion.")</center><br>";

echo "<input type='hidden' value='".$id_epicrisis."' id='id_epicrisis'>";
echo "<b><select id='rut_dni'><option value='1'>RUT</option><option value='2'>DNI</option></select>(*)</b><input type='text' value='".$busca_epicrisis->rut."' id='rut' style='width:80px;' onblur='formato_rut(this);' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 107 || event.charCode == 75' onkeydown='if (event.keyCode == 13) formato_rut(this)'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Nombre Paciente(*)&nbsp;</b><input type='text' id='nombre' style='width:300px;' value='".$busca_epicrisis->nombre_paciente."'>     <br><br>
			<b><span id='texto_ficha'>Ficha(*)</span>&nbsp;</b><input type='text' id='ficha' style='width:100px;' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='".$busca_epicrisis->ficha."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			<B>Ubicación(*) </B><select id='tipo_habitacion' onchange='carga_habitaciones();' >
			<option value='0' disabled>--Seleccione--</option>";

			echo "<script>$('#rut').bind('cut copy paste',function(e){e.preventDefault();});$('#rut').bind('contextmenu',function(e){ e.preventDefault(); });</script>";
			$busca_tipo_habitacion->busca_tipo_habitacion();

			while($busca_tipo_habitacion->sgte_busca_tipo_habitacion()){
				
				if($busca_tipo_habitacion->id_tipo_habitacion==$busca_epicrisis->ubicacion){
					echo "<option value='".$busca_tipo_habitacion->id_tipo_habitacion."' selected>".$busca_tipo_habitacion->nombre_tipo_habitacion."</option>";
				}
				else{
					echo "<option value='".$busca_tipo_habitacion->id_tipo_habitacion."' >".$busca_tipo_habitacion->nombre_tipo_habitacion."</option>";
				}
				
			}
			echo"
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;<div id='habitaciones' style='display:inline;'>";
			if($busca_epicrisis->ubicacion!=7){
				$busca_habitaciones->busca_habitaciones($busca_epicrisis->ubicacion);
				echo "<b>Habitación(*) </b><select id='habitacion'> <option value='0'>--Seleccione--</option>";
				while($busca_habitaciones->sgte_busca_habitaciones()){
					if($busca_epicrisis->habitacion==$busca_habitaciones->id_habitacion){
						echo "<option value='".$busca_habitaciones->id_habitacion."' selected>".$busca_habitaciones->nombre_habitacion."</option>";
					}else{
						echo "<option value='".$busca_habitaciones->id_habitacion."'>".$busca_habitaciones->nombre_habitacion."</option>";
					}
					
				}
				echo "</select>";
			}
			$seleccionado='';
			$seleccionado2='';
			if($busca_epicrisis->ambito==1)
				$seleccionado2='selected';
			else if($busca_epicrisis->ambito==2)
				$seleccionado='selected';
			echo "</div>";
			if($busca_epicrisis->ubicacion==8){
				echo "<br><br><div id='pediatria'><b>Peso Ingreso(*)&nbsp;</b><input type='text' id='peso_ingreso' style='width:70px;' value='".$busca_epicrisis->peso_ingreso."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Peso Egreso(*)&nbsp;</b><input type='text' id='peso_egreso' style='width:70px;' value='".$busca_epicrisis->peso_egreso."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Sexo (*)&nbsp;</b>";
				$sexo1='';
				$sexo2='';
				if($busca_epicrisis->sexo=='1'){
					$sexo1='selected';
				}
				if($busca_epicrisis->sexo=='2'){
					$sexo2='selected';
				}
				echo "<select id='sexo'><option value='1' ".$sexo1.">Masculino</option><option value='2' ".$sexo2.">Femenino</option></select></div>";
			}
			if($busca_epicrisis->ubicacion==9){
				echo "<br><br><div id='pediatria'><b>Nombre Padre&nbsp;&nbsp;</b><input type='text' id='nombre_padre' style='width:250px;' value='".$busca_epicrisis->nombre_padre."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Escolaridad Padre&nbsp;&nbsp;</b><input type='text' id='escol_padre' style='width:90px;' value='".$busca_epicrisis->escol_padre."'><br><br><b><b>Nombre Madre&nbsp;</b><input type='text' id='nombre_madre' style='width:250px;' value='".$busca_epicrisis->nombre_madre."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Escolaridad Madre&nbsp;</b><input type='text' id='escol_madre' style='width:90px;' value='".$busca_epicrisis->escol_madre."' ><br><br><b>Dirección&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><input type='text' id='direccion' style='width:250px;' value='".$busca_epicrisis->direccion."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Fono&nbsp;</b><input type='text' id='fono' style='width:70px;' value='".$busca_epicrisis->fono."'><br><br><b>Parto&nbsp;&nbsp;&nbsp;&nbsp;</b><input type='text' id='parto' style='width:90px;' value='".$busca_epicrisis->parto."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Apgar&nbsp;</b><input type='text' id='apgar' style='width:90px;' value='".$busca_epicrisis->apgar."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>GR. MAT&nbsp;</b><input type='text' id='gr_mat' style='width:90px;' value='".$busca_epicrisis->gr_mat."'><br><br><b>GR. RN&nbsp;&nbsp;&nbsp;&nbsp;</b><input type='text' id='gr_rn' style='width:90px;' value='".$busca_epicrisis->gr_rn."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				$dividido=explode("-",$busca_epicrisis->fecha_bgc);
				$fecha_bgc=$dividido[2]."/".$dividido[1]."/".$dividido[0];
				echo "<b>Fecha BGC&nbsp;</b><input type='text' id='fecha_bgc' style='width:70px;' class='datepicker' value='".$fecha_bgc."' READONLY>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				$dividido=explode("-",$busca_epicrisis->fecha_pku);
				$fecha_pku=$dividido[2]."/".$dividido[1]."/".$dividido[0];
				echo "<b>Fecha PKU&nbsp;</b><input type='text' id='fecha_pku' style='width:70px;' class='datepicker' value='".$fecha_pku."' READONLY><br><br><b>Fecha Nac&nbsp;&nbsp;&nbsp;&nbsp;";
				$dividido=explode("-",$busca_epicrisis->fecha_nac);
				$fecha_nac=$dividido[2]."/".$dividido[1]."/".$dividido[0];
				echo "</b><input type='text' id='fecha_nac' style='width:70px;' class='datepicker' value='".$fecha_nac."' READONLY>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Peso Nac&nbsp;</b><input type='text' id='peso_nac' style='width:70px;' onkeyup='calcula_dif();'onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='".$busca_epicrisis->peso_nac."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Peso Alta&nbsp;</b><input type='text' id='peso_alta' style='width:70px;' onkeyup='calcula_dif();'onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='".$busca_epicrisis->peso_alta."'><br><br><b>Dias de Estadia&nbsp;&nbsp;&nbsp;&nbsp;</b><input type='text' id='dias_estadia_neo' style='width:30px;'  value='".$busca_epicrisis->dias_estadia_neo."'  READONLY>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Dif. Peso&nbsp;</b><input type='text' id='dif_peso' style='width:70px;' READONLY value='".$busca_epicrisis->dif_peso."'></div>";
			}
			echo "
			<br><br>
			<b>Ambito(*) </b><select id='ambito'><option value='0'>--Seleccione--</option><option value='1' ".$seleccionado2.">Hospitalización</option><option value='2' ".$seleccionado.">Ambulatorio</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <b>Fecha Ingreso(*)&nbsp;</b><input type='text' id='fecha_ingreso' style='width:70px;' value='".$fecha_ingreso."' class='datepicker' READONLY onchange='calcula_dif_fechas();'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>Fecha Egreso(*)&nbsp;</b><input type='text' id='fecha_egreso' style='width:70px;' value='".$fecha_egreso."' class='datepicker' READONLY onchange='calcula_dif_fechas();'><br><br>

			<b>Edad(*)&nbsp;</b><input type='text' id='edad' style='width:20px;' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='".$busca_epicrisis->edad."'><select id='tipo_edad'>";
			$edad1='';
			$edad2='';
			$edad3='';
			$edad4='';
			if($busca_epicrisis->tipo_edad=='1'){
				$edad1='selected';
			}else if($busca_epicrisis->tipo_edad=='2'){
				$edad2='selected';
			}else if($busca_epicrisis->tipo_edad=='3'){
				$edad3='selected';
			}else if($busca_epicrisis->tipo_edad=='4'){
				$edad4='selected';
			}

			echo "<option value='1' ".$edad1.">Años</option><option value='2' ".$edad2.">Meses</option><option value='3' ".$edad3.">Dias</option><option value='4' ".$edad4.">Horas</option>";
			
			echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Nombre Medico(*)&nbsp;</b>
			<select id='id_cirujano'><option value='0'>--Seleccione--</option>";
			$busca_cirujanos->busca_cirujanos();
			while($busca_cirujanos->sgte_busca_cirujanos()){
				if($busca_cirujanos->id_cirujano==$busca_epicrisis->id_cirujano){
					echo "<option value='".$busca_cirujanos->id_cirujano."' selected>".utf8_encode($busca_cirujanos->nombre)."</option>";
				}else{
					echo "<option value='".$busca_cirujanos->id_cirujano."'>".utf8_encode($busca_cirujanos->nombre)."</option>";
				}
				
			}
			echo"
			</select>
			<br><br>
			<b>RUT Medico(*)&nbsp;</b><input type='text' id='rut_medico' style='width:80px;' onblur='formato_rut_medico(this);' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 107 || event.charCode == 75' onkeydown='if (event.keyCode == 13) formato_rut_medico(this)' value='".$busca_epicrisis->rut_medico."'>
			";
			if($busca_epicrisis->ubicacion==8){
				echo "<span id='pediatria2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Dias Estadia(*)&nbsp;</b><input type='text' id='dias_estadia' style='width:70px;' value='".$busca_epicrisis->dias_estadia."' READONLY>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Estadía UCI(*)&nbsp;</b><input type='text' id='estadia_uci' style='width:70px;' value='".$busca_epicrisis->estadia_uci."'></span>";
			}
			echo"
			<br><br>

			<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'>
			<tr><td colspan='2'><center><b>DIAGNOSTICO DE EGRESO(*)</b></center></td></tr>

			<tr><td><center><b>Principal</b></center></td><td><center><b>Otros Diagnosticos</b></center></td></tr>
			<tr><td><textarea id='egreso' rows='3'  style='width: 330px;'>".$busca_epicrisis->egreso."</textarea></td><td><textarea id='egreso2' rows='3' style='width: 330px;'>".$busca_epicrisis->egreso2."</textarea></td></tr>
			</table>
			<br><br>
			<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'>

			<tr><td ><center><b>RESUMEN HOSPITALIZACIÓN(*)</b> (Evolución, tratamiento y dosis, resumen examenes)</center></td></tr>
			
			<tr><td ><textarea id='resumen' rows='10' style='width: 665px;'>".$busca_epicrisis->resumen."</textarea></td></tr>
			
			</table>

			<br><br>
			
			<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'>

			<tr><td ><center><b>COMPLICACIONES DURANTE LA HOSPITALIZACIÓN</b> </center></td></tr>
			
			<tr><td ><textarea id='complicaciones' rows='10' style='width: 665px;'>".$busca_epicrisis->complicaciones."</textarea></td></tr>
			
			</table>
			<br><br>";
			if($busca_epicrisis->ubicacion!=7){
				echo "<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'>

			<tr><td ><center><b>CIRUGIA(S) Y/O INTERVENCIONES REALIZADA(S)</b> </center></td></tr>
			
			<tr><td ><textarea id='cirugias' rows='10' style='width: 665px;'>".$busca_epicrisis->cirugias."</textarea></td></tr>
			
			</table>

			<br><br>";
			}
			if($busca_epicrisis->ubicacion==9 ){
				echo "<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td colspan='2'><center><b>INDICACIONES DE ALTA(*)</b></center></td></tr><tr><td><textarea id='reposo' rows='3'  style='width: 670px;'>".$busca_epicrisis->reposo."</textarea></td></tr><tr><td ><center><b>IIH</b></center></td></tr><tr><td ><textarea id='otras_indicaciones' rows='3' style='width: 670px;'>".$busca_epicrisis->otras_indicaciones."</textarea></td></tr></table>";
			}else if($busca_epicrisis->ubicacion==8 ){
				echo "<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td colspan='2'><center><b>INDICACIONES DE ALTA(*)</b></center></td></tr><tr><td><center><b>Reposo</b></center></td><td><center><b>Regimen</b></center></td></tr><tr><td><textarea id='reposo_ped' rows='3'  style='width: 330px;'>".$busca_epicrisis->reposo_ped."</textarea></td><td><textarea id='regimen_ped' rows='3' style='width: 330px;'>".$busca_epicrisis->regimen_ped."</textarea></td></tr> </table> <table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'><tr><td colspan='2'><center><b>OTRAS INDICACIONES</center></td></tr><tr><td><textarea id='reposo' rows='3'  style='width: 670px;'>".$busca_epicrisis->reposo."</textarea></td></tr><tr><td ><center><b>IIH</b></center></td></tr><tr><td ><textarea id='otras_indicaciones' rows='3' style='width: 670px;'>".$busca_epicrisis->otras_indicaciones."</textarea></td></tr></table>";
			}else{
				echo "
				<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'>
				<tr><td colspan='3'><center><b>INDICACIONES DE ALTA(*)</b></center></td></tr>
				<tr><td><center><b>Reposo</b></center></td><td><center><b>Regimen</b></center></td><td><center><b>Otras Indicaciones</b></center></td></tr>
				<tr><td><textarea id='reposo' rows='3'  style='width: 220px;'>".$busca_epicrisis->reposo."</textarea></td><td><textarea id='regimen' rows='3' style='width: 220px;'>".$busca_epicrisis->regimen."</textarea></td><td><textarea id='otras_indicaciones' rows='3' style='width: 220px;'>".$busca_epicrisis->otras_indicaciones."</textarea></td></tr>
				</table>";
			}
			
			echo "<br><br>
			
			<table border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0'>

			<tr><td ><center><b>PROCEDIMIENTOS</B> (ej: puncion pleural, puncion ascitis, artrocentesis, instalación cateter, etc)</center></td></tr>
			
			<tr><td ><textarea id='procedimientos' rows='10' style='width: 665px;'>".$busca_epicrisis->procedimientos."</textarea></td></tr>
			
			</table>";
			
			echo "
			<br><center><b>MEDICAMENTOS ARSENAL</b></center>
			<table>
			<tr><td colspan='5'><b>Medicamento</b></td></TR>
			<tr><td colspan='5'><select id='medicamento_arsenal' style='width:690px;' class='editable'>";
			$busca_medicamentos->busca_medicamentos();
			echo "<option value='0'>---Seleccione---</option>";
			while($busca_medicamentos->sgte_busca_medicamentos()){
				echo "<option value='".$busca_medicamentos->id_medicamento."'>".utf8_encode($busca_medicamentos->medicamento)." (".utf8_encode($busca_medicamentos->forma)." ".utf8_encode($busca_medicamentos->presentacion)."</option>";
			}
			echo "
	
			</select></td></tr></table>
			<table>
			<TR><td><b>Dosis</b></td><td><input type='text' style='width:500px;' id='dosis_arsenal'></td></tr>
			<td><b>Frecuencia</b></td><td><input type='text' style='width:500px;' id='frecuencia_arsenal' value='cada '></td></tr>
			<td><b>Duracion Trat</b></td><td><input type='text' style='width:500px;' id='duracion_arsenal' value='por '></td></tr>
			<td><b>Via Administración</b></td><td><input type='text' style='width:500px;' id='via_arsenal'></td></tr>
			<tr><td colspan='2'><center><a href='javascript:void(0);'><img onclick='llena_tabla();' src='imagenes/plus_add_green.png' width='25'></a></center></td></tr>
			</table><br>
			<center><b>LISTADO DE MEDICAMENTOS ARSENAL</b></center>
			<table width='100%' border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0' id='listado_arsenal'>
			<tr bgcolor='#CCCCCC'><td style='width:20px;'>ID</td><td style='width:130px;'>Medicamento</td><td style='width:70px;'>Dosis</td><td style='width:100px;'>Frecuencia</td><td style='width:105px;'>Duracion Trat</td><td style='width:130px;'>Via Administración</td><td style='width:30px;'></td></tr>
			";
			$busca_medicamentos_arsenal=new consultas();
			$busca_medicamentos_arsenal->busca_medicamentos_arsenal($id_epicrisis);
			while($busca_medicamentos_arsenal->sgte_busca_medicamentos_arsenal()){
				echo "<tr><td>".$busca_medicamentos_arsenal->id_medicamento."</td><td>".$busca_medicamentos_arsenal->medicamento."</td><td>".$busca_medicamentos_arsenal->dosis."</td><td>".$busca_medicamentos_arsenal->frecuencia."</td><td>".$busca_medicamentos_arsenal->duracion."</td><td>".$busca_medicamentos_arsenal->via."</td><td><center><img class='btnDelete'	src='imagenes/Button-Delete-icon.png' width='20'></center></td></tr>";
				echo '<script type="text/javascript">', '$(".btnDelete").bind("click", Delete);', '</script>';
			}

			echo "
			</table><br>
			<hr width='300'>
			<BR>
			<center><b>MEDICAMENTOS FUERA DEL ARSENAL</b></center>
			<table>
			<tr><td colspan='5'><b>Medicamento<b></td></TR>
			</TR><td colspan='5'><input type='text' id='medicamento' style='width:680px;' ></td></TR></table>

			<table>
			<TR><td><b>Dosis</b></td><td><input type='text' style='width:500px;' id='dosis'></td></tr>
			<td><b>Frecuencia</b></td><td><input type='text' style='width:500px;' id='frecuencia' value='cada '></td></tr>
			<td><b>Duracion Trat</b></td><td><input type='text' style='width:500px;' id='duracion' value='por '></td></tr>
			<td><b>Via Administración</b></td><td><input type='text' style='width:500px;' id='via'></td></tr>
			<tr><td colspan='2'><center><a href='javascript:void(0);'><img onclick='llena_tabla2();' src='imagenes/plus_add_green.png' width='25'></a></center></td></tr>
			</table><br>

			<center><b>LISTADO DE MEDICAMENTOS FUERA DEL ARSENAL</b></center><br>
			<table width='100%' border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0' id='listado'>
			<tr bgcolor='#CCCCCC'><td style='width:130px;'>Medicamento</td><td style='width:70px;'>Dosis</td><td style='width:100px;'>Frecuencia</td><td style='width:105px;'>Duracion Trat</td><td style='width:130px;'>Via Administración</td><td style='width:30px;'></td></tr>";

			$busca_medicamentos_arsenal=new consultas();
			$busca_medicamentos_arsenal->busca_medicamentos_fuera_arsenal($id_epicrisis);
			$i=1;
			while($busca_medicamentos_arsenal->sgte_busca_medicamentos_fuera_arsenal()){
				echo "<tr><td>".$busca_medicamentos_arsenal->nombre_medicamento."</td><td>".$busca_medicamentos_arsenal->dosis."</td><td>".$busca_medicamentos_arsenal->frecuencia."</td><td>".$busca_medicamentos_arsenal->duracion."</td><td>".$busca_medicamentos_arsenal->via."</td><td><center><img class='btnDelete' src='imagenes/Button-Delete-icon.png' width='20'></center></td></tr>";
				echo '<script type="text/javascript">', '$(".btnDelete").bind("click", Delete);', '</script>';
			}
			echo "
			</table><br>
			<hr width='300'>
			<BR>
			<b>CITACIÓN A CONTROL</b><br>
			<table>
			<tr><td><b>Lugar:</b></td><td>
			 <input type='text' id='lugar' style='width:300px;'> 
			
			</td></tr>
			<tr><td><b>Fecha Estimada:</b></td><td><input type='text' id='fecha' style='width:300px;'></td></tr>
			</table>
			<input type='button' value='Agregar' onclick='llena_tabla_citaciones();'>
			<br>
			<center><b>LISTADO DE CITACIONES</b></center>
			<table width='100%' border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0' id='listado_citaciones'>
			<tr bgcolor='#CCCCCC'><td><b>Lugar</b></td><td style='width:200px;'><b>Fecha Estimada</b></td><td style='width:60px;'><b>Eliminar</b></td></tr>
			";
			$busca_citaciones=new consultas();
			$busca_citaciones->busca_citaciones($id_epicrisis);
			while($busca_citaciones->sgte_busca_citaciones()){
				//$dividido=explode("-",$busca_citaciones->fecha);
				//$fecha=$dividido[2]."/".$dividido[1]."/".$dividido[0];
				echo "<tr><td>".$busca_citaciones->lugar."</td><td>".$busca_citaciones->fecha."</td><td><center><img class='btnDelete' src='imagenes/Button-Delete-icon.png' width='20'></center></td></tr>";
				echo '<script type="text/javascript">', '$(".btnDelete").bind("click", Delete);', '</script>';
			}
			//echo "<input type='text' id='lugar' value='".$busca_epicrisis->lugar."' style='width:300px;'>"; 
			
			/*echo "<select id='lugar'><option value='0'>--Seleccione--</option>";
			$busca_lugares->busca_lugares();
			while($busca_lugares->sgte_busca_lugares()){
				if($busca_lugares->id_lugar==$busca_epicrisis->lugar){
					echo "<option value='".$busca_lugares->id_lugar."' selected>".$busca_lugares->nombre_lugar."</option>";
				}else{
					echo "<option value='".$busca_lugares->id_lugar."'>".$busca_lugares->nombre_lugar."</option>";
				}
			
			}
			
			
			
			echo "</select>";*/
			
			//echo "</td></tr><tr><td><b>Fecha:</b></td><td><input type='text' id='fecha' style='width:70px;' READONLY class='datepicker' value='".$fecha."'></td></tr>
			echo "</table>
			<br><br>
			<center><div id='boton_guardar'><a href='javascript:void(0);'><img onclick='actualiza_epicrisis();' src='imagenes/btn_guardar1.fw.png'  style='border:0px;'></a>";
			
			echo "</div></center>";
?>