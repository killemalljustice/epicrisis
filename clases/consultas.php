<?php
include("conf/config.php");

class consultas
{
	function verifica_usuario($user,$pass){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select usuario,password from usuarios where usuario='$user' and password='$pass'");
		if($this->db->sig_reg()){
			$this->usuario=$this->db->campo("usuario");
			return true;
		}
		else
			return false;
	}
	function busca_datos_paciente($rut){
		$this->db = new conexion(SERVER,USER,PASSWORD,'protocolo_urgencia');
		$this->db->consulta("select * from pacientes where Rut='$rut'");

		if($this->db->sig_reg()){
			$this->existe=true;
			$this->nombre=$this->db->campo("Nombre");
			$this->paterno=$this->db->campo("Apell_Pater");
			$this->materno=$this->db->campo("Apell_Mater");
			$this->ficha=$this->db->campo("Ficha");
			$this->nacimiento=$this->db->campo("Fecha_Nac");
		}
		else{
			$this->existe=false;
		}
	}
	function calculaedad($fechanacimiento){
		date_default_timezone_set("America/Santiago");
		list($ano,$mes,$dia) = explode("-",$fechanacimiento);
		$ano_diferencia = date("Y") - $ano;
		$mes_diferencia = date("m") - $mes;
		$dia_diferencia = date("d") - $dia;
		if ($mes_diferencia==0 && $dia_diferencia < 0 || $mes_diferencia < 0)
			$ano_diferencia--;
		return $ano_diferencia;
	}
	function busca_tipo_habitacion()
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM tipo_habitacion");
	}
	function sgte_busca_tipo_habitacion()
	{
		if($this->db->sig_reg()){
			$this->id_tipo_habitacion=$this->db->campo("id_tipo_habitacion");
			$this->nombre_tipo_habitacion=$this->db->campo("nombre_tipo_habitacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_habitaciones($tipo_habitacion)
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM habitaciones where id_tipo_habitacion='$tipo_habitacion' and id_habitacion!='0'");
	}
	function sgte_busca_habitaciones()
	{
		if($this->db->sig_reg()){
			$this->id_habitacion=$this->db->campo("id_habitacion");
			$this->nombre_habitacion=$this->db->campo("nombre_habitacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_protocolo($id_protocolo){
		$this->db = new conexion(SERVER,USER,PASSWORD,'protocolo_urgencia');
		
		$this->db->consulta("select id_protocolo,rut,protocolos.nombre as paciente,cirujanos.nombre as cirujano,id_cirujano,fecha_oper,fecha_ingreso_protocolo,orden,ficha,tipo_oper,tipo_ambito,subtipo_oper,edad,tipo_edad,hora_ini,hora_fin,herida,riesgo,pabellon,preoperatorio,propuesta,operatorio,practicada,arsenalera,anestesista,pabellonera,ayudante1,ayudante2,ayudante3,anestecia,auxanestecia,detalles,fecha_ultima_modificacion,rut_medico FROM protocolos,cirujanos where protocolos.cirujano=cirujanos.id_cirujano and id_protocolo='$id_protocolo'");
		if($this->db->sig_reg()){
			$this->id_protocolo=$this->db->campo("id_protocolo");
			$this->rut=$this->db->campo("rut");
			$this->paciente=$this->db->campo("paciente");
			$this->cirujano=$this->db->campo("cirujano");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->fecha_oper=$this->db->campo("fecha_oper");
			$this->fecha_ingreso_protocolo=$this->db->campo("fecha_ingreso_protocolo");
			$this->orden=$this->db->campo("orden");
			$this->ficha=$this->db->campo("ficha");
			$this->tipo_oper=$this->db->campo("tipo_oper");
			$this->tipo_ambito=$this->db->campo("tipo_ambito");
			$this->subtipo_oper=$this->db->campo("subtipo_oper");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->hora_ini=$this->db->campo("hora_ini");
			$this->hora_fin=$this->db->campo("hora_fin");
			$this->herida=$this->db->campo("herida");
			$this->riesgo=$this->db->campo("riesgo");
			$this->pabellon=$this->db->campo("pabellon");
			$this->preoperatorio=$this->db->campo("preoperatorio");
			$this->propuesta=$this->db->campo("propuesta");
			$this->operatorio=$this->db->campo("operatorio");
			$this->practicada=$this->db->campo("practicada");
			$this->arsenalera=$this->db->campo("arsenalera");
			$this->anestesista=$this->db->campo("anestesista");
			$this->pabellonera=$this->db->campo("pabellonera");
			$this->ayudante1=$this->db->campo("ayudante1");
			$this->ayudante2=$this->db->campo("ayudante2");
			$this->ayudante3=$this->db->campo("ayudante3");
			$this->anestecia=$this->db->campo("anestecia");
			$this->auxanestecia=$this->db->campo("auxanestecia");
			$this->detalles=$this->db->campo("detalles");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->existe=true;
		}
		else{
			$this->existe=false;
		}
	}
	function guarda_epicrisis($rut,$nombre_paciente,$ficha,$tipo_habitacion,$habitacion,$ambito,$fecha_ingreso,$fecha_egreso,$id_cirujano,$egreso,$egreso2,$resumen,$regimen,$reposo,$regimen_ped,$reposo_ped,$otras_indicaciones,$fecha_actual,$edad,$tipo_edad,$rut_dni,$rut_medico,$cirugias,$nueva_receta,$peso_ingreso,$peso_egreso,$dias_estadia,$estadia_uci,$sexo,$nombre_padre,$escol_padre,$nombre_madre,$escol_madre,$direccion,$fono,$parto,$apgar,$gr_mat,$gr_rn,$fecha_bgc,$fecha_pku,$fecha_nac,$peso_nac,$peso_alta,$dias_estadia_neo,$dif_peso,$complicaciones,$procedimientos){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$consulta="insert into epicrisis (rut_dni,rut,nombre_paciente,ficha,nro_receta,ubicacion,habitacion,ambito,fecha_ingreso,fecha_egreso,id_cirujano,rut_medico,egreso,egreso2,resumen,cirugias,regimen,reposo,regimen_ped,reposo_ped,otras_indicaciones,fecha_ingreso_epicrisis,fecha_ultima_modificacion,edad,tipo_edad,peso_ingreso,peso_egreso,dias_estadia,estadia_uci,sexo,nombre_padre,escol_padre,nombre_madre,escol_madre,direccion,fono,parto,apgar,gr_mat,gr_rn,fecha_bgc,fecha_pku,fecha_nac,peso_nac,peso_alta,dias_estadia_neo,dif_peso,complicaciones,procedimientos) values('$rut_dni','$rut','$nombre_paciente','$ficha','$nueva_receta','$tipo_habitacion','$habitacion','$ambito','$fecha_ingreso','$fecha_egreso','$id_cirujano','$rut_medico','$egreso','$egreso2','$resumen','$cirugias','$regimen','$reposo','$regimen_ped','$reposo_ped','$otras_indicaciones','$fecha_actual','$fecha_actual','$edad','$tipo_edad','$peso_ingreso','$peso_egreso','$dias_estadia','$estadia_uci','$sexo','$nombre_padre','$escol_padre','$nombre_madre','$escol_madre','$direccion','$fono','$parto','$apgar','$gr_mat','$gr_rn','$fecha_bgc','$fecha_pku','$fecha_nac','$peso_nac','$peso_alta','$dias_estadia_neo','$dif_peso','$complicaciones','$procedimientos')";
		$consulta=addslashes($consulta);
		$ip=$this->getRealIP();
		$this->db->consulta("insert into seguimiento (consulta, fecha,ip) values ('$consulta','$fecha_actual','$ip')");
		$this->db->consulta("insert into epicrisis (rut_dni,rut,nombre_paciente,ficha,nro_receta,ubicacion,habitacion,ambito,fecha_ingreso,fecha_egreso,id_cirujano,rut_medico,egreso,egreso2,resumen,cirugias,regimen,reposo,regimen_ped,reposo_ped,otras_indicaciones,fecha_ingreso_epicrisis,fecha_ultima_modificacion,edad,tipo_edad,peso_ingreso,peso_egreso,dias_estadia,estadia_uci,sexo,nombre_padre,escol_padre,nombre_madre,escol_madre,direccion,fono,parto,apgar,gr_mat,gr_rn,fecha_bgc,fecha_pku,fecha_nac,peso_nac,peso_alta,dias_estadia_neo,dif_peso,complicaciones,procedimientos) values('$rut_dni','$rut','$nombre_paciente','$ficha','$nueva_receta','$tipo_habitacion','$habitacion','$ambito','$fecha_ingreso','$fecha_egreso','$id_cirujano','$rut_medico','$egreso','$egreso2','$resumen','$cirugias','$regimen','$reposo','$regimen_ped','$reposo_ped','$otras_indicaciones','$fecha_actual','$fecha_actual','$edad','$tipo_edad','$peso_ingreso','$peso_egreso','$dias_estadia','$estadia_uci','$sexo','$nombre_padre','$escol_padre','$nombre_madre','$escol_madre','$direccion','$fono','$parto','$apgar','$gr_mat','$gr_rn','$fecha_bgc','$fecha_pku','$fecha_nac','$peso_nac','$peso_alta','$dias_estadia_neo','$dif_peso','$complicaciones','$procedimientos')");
		$this->db->consulta("select * from epicrisis order by id_epicrisis desc limit 1");
		$this->db->sig_reg();
		$this->ultimo_id=$this->db->campo("id_epicrisis");
	}
	function busca_medicamentos()
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM medicamentos where inactivo=0");
	}
	function sgte_busca_medicamentos()
	{
		if($this->db->sig_reg()){
			$this->id_medicamento=$this->db->campo("id_medicamento");
			$this->medicamento=$this->db->campo("medicamento");
			$this->forma=$this->db->campo("forma");
			$this->presentacion=$this->db->campo("presentacion");
			$this->ges=$this->db->campo("ges");
			$this->tipo=$this->db->campo("tipo");
			return true;
		}
		else{
			return false;
		}
	}
	function guarda_med_ars($id_epicrisis,$id_medicamento,$dosis,$frecuencia,$duracion,$via){
		date_default_timezone_set("America/Santiago");
		$fecha_actual=date("Y-m-j H:i:s", (strtotime ("-1 Hour")));
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$consulta="insert into epicrisis_med_ars values ('".$id_epicrisis."','".$id_medicamento."','".$dosis."','".$frecuencia."','".$duracion."','".$via."')";
		$consulta=addslashes($consulta);
		$ip=$this->getRealIP();
		$this->db->consulta("insert into seguimiento (consulta, fecha,ip) values ('$consulta','$fecha_actual','$ip')");
		$this->db->consulta("insert into epicrisis_med_ars values ('$id_epicrisis','$id_medicamento','$dosis','$frecuencia','$duracion','$via')");
	}
	function guarda_med($id_epicrisis,$nombre_medicamento,$dosis,$frecuencia,$duracion,$via){
		date_default_timezone_set("America/Santiago");
		$fecha_actual=date("Y-m-j H:i:s", (strtotime ("-1 Hour")));
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$consulta="insert into epicrisis_med values ('".$id_epicrisis."','".$nombre_medicamento."','".$dosis."','".$frecuencia."','".$duracion."','".$via."')";
		$consulta=addslashes($consulta);
		$ip=$this->getRealIP();
		$this->db->consulta("insert into seguimiento (consulta, fecha,ip) values ('$consulta','$fecha_actual','$ip')");
		$this->db->consulta("insert into epicrisis_med values ('$id_epicrisis','$nombre_medicamento','$dosis','$frecuencia','$duracion','$via')");
	}
	function busca_cirujanos()
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,'protocolo_urgencia');
		$this->db->consulta("select * FROM cirujanos where nombre NOT LIKE '%ALUMNO%' AND nombre NOT LIKE '%ALUMNA%' order by nombre ");
	}
	function sgte_busca_cirujanos()
	{
		if($this->db->sig_reg()){
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->nombre=$this->db->campo("nombre");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_fecha_actual($fecha_actual,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where fecha_egreso='$fecha_actual'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where fecha_egreso='$fecha_actual' ORDER BY id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_fecha_actual()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			$this->sexo=$this->db->campo("sexo");
			$this->peso_ingreso=$this->db->campo("peso_ingreso");
			$this->peso_egreso=$this->db->campo("peso_egreso");
			$this->dias_estadia=$this->db->campo("dias_estadia");
			$this->estadia_uci=$this->db->campo("estadia_uci");

			$this->nombre_padre=$this->db->campo("nombre_padre");
			$this->escol_padre=$this->db->campo("escol_padre");
			$this->nombre_madre=$this->db->campo("nombre_madre");
			$this->escol_madre=$this->db->campo("escol_madre");
			$this->direccion=$this->db->campo("direccion");
			$this->fono=$this->db->campo("fono");
			$this->parto=$this->db->campo("parto");
			$this->apgar=$this->db->campo("apgar");
			$this->gr_mat=$this->db->campo("gr_mat");
			$this->gr_rn=$this->db->campo("gr_rn");
			$this->fecha_bgc=$this->db->campo("fecha_bgc");
			$this->fecha_pku=$this->db->campo("fecha_pku");
			$this->fecha_nac=$this->db->campo("fecha_nac");
			$this->peso_nac=$this->db->campo("peso_nac");
			$this->peso_alta=$this->db->campo("peso_alta");
			$this->dias_estadia_neo=$this->db->campo("dias_estadia_neo");
			$this->dif_peso=$this->db->campo("dif_peso");

			
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_fecha_actual_excel($fecha_actual){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where fecha_egreso='$fecha_actual' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_fecha_actual_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_servicio_excel($id_servicio){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where ubicacion='$id_servicio' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_servicio_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_por_medico_excel($id_medico){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where id_cirujano='$id_medico' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY fecha_egreso DESC");
	}
	function sgte_busca_epicrisis_por_medico_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_entre_fechas_excel($fecha_inicio,$fecha_termino){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY fecha_egreso,id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_entre_fechas_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_entre_fechas_medico_excel($fecha_inicio,$fecha_termino,$id_medico){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and id_cirujano='$id_medico' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_entre_fechas_medico_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_entre_fechas_servicio_excel($fecha_inicio,$fecha_termino,$id_servicio){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and ubicacion='$id_servicio' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_entre_fechas_servicio_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_cirujano_servicio_excel($id_cirujano,$id_servicio){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where id_cirujano='$id_cirujano' and ubicacion='$id_servicio' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_cirujano_servicio_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_cirujano_servicio_entre_fechas_excel($id_cirujano,$id_servicio,$fecha_inicio,$fecha_termino){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and id_cirujano='$id_cirujano' and ubicacion='$id_servicio' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_cirujano_servicio_entre_fechas_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_rut_excel($rut){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion where rut='$rut' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion ORDER BY id_epicrisis DESC");
	}
	function sgte_busca_epicrisis_rut_excel()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("nombre_tipo_habitacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->cirugias=$this->db->campo("cirugias");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false){
	   $f0 = strtotime($fecha_principal);
	   $f1 = strtotime($fecha_secundaria);
	   if ($f0 < $f1) { $tmp = $f1; $f1 = $f0; $f0 = $tmp; }
	   $resultado = ($f0 - $f1);
	   switch ($obtener) {
		   default: break;
		   case "MINUTOS"   :   $resultado = $resultado / 60;   break;
		   case "HORAS"     :   $resultado = $resultado / 60 / 60;   break;
		   case "DIAS"      :   $resultado = $resultado / 60 / 60 / 24;   break;
		   case "SEMANAS"   :   $resultado = $resultado / 60 / 60 / 24 / 7;   break;
	   }
	   if($redondear) $resultado = round($resultado);
	   return $resultado;
	}
	function busca_nombre_cirujano($id_cirujano){
		$this->db = new conexion(SERVER,USER,PASSWORD,'protocolo_urgencia');
		$this->db->consulta("select nombre FROM cirujanos where id_cirujano='$id_cirujano'");
		$this->db->sig_reg();
		$this->nombre=$this->db->campo("nombre");
	}
	function busca_epicrisis_cirujano($id_cirujano,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where id_cirujano='$id_cirujano'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where id_cirujano='$id_cirujano' ORDER BY fecha_egreso DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_cirujano()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_servicio($id_servicio,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where ubicacion='$id_servicio'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where ubicacion='$id_servicio' ORDER BY id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_servicio()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_entre_fechas($fecha_inicio,$fecha_termino,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino' ORDER BY fecha_egreso,id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_entre_fechas()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_entre_fechas_cirujano($fecha_inicio,$fecha_termino,$id_cirujano,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and id_cirujano='$id_cirujano'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and id_cirujano='$id_cirujano' ORDER BY id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_entre_fechas_cirujano()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_cirujano_servicio_entre_fechas($id_cirujano,$id_servicio,$fecha_inicio,$fecha_termino,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and id_cirujano='$id_cirujano' and ubicacion='$id_servicio' ");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and id_cirujano='$id_cirujano' and ubicacion='$id_servicio' ORDER BY id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_cirujano_servicio_entre_fechas()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_entre_fechas_servicio($fecha_inicio,$fecha_termino,$id_servicio,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and ubicacion='$id_servicio'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where fecha_egreso between '$fecha_inicio' and '$fecha_termino' and ubicacion='$id_servicio' ORDER BY id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_entre_fechas_servicio()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_cirujano_servicio($id_cirujano,$id_servicio,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where id_cirujano='$id_cirujano' and ubicacion='$id_servicio'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where id_cirujano='$id_cirujano' and ubicacion='$id_servicio' ORDER BY id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_cirujano_servicio()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis_solo_ficha($ficha,$offset,$rowsPerPage){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select count(*) as total FROM epicrisis where rut='$ficha'");
		$this->db->sig_reg();
		$this->total=$this->db->campo("total");
		$this->db->consulta("select * FROM epicrisis where rut='$ficha' ORDER BY id_epicrisis DESC LIMIT $offset, $rowsPerPage");
	}
	function sgte_busca_epicrisis_solo_ficha()
	{
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_epicrisis($id_epicrisis){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		
		$this->db->consulta("select * FROM epicrisis,tipo_habitacion,habitaciones where epicrisis.id_epicrisis='$id_epicrisis' and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion and epicrisis.habitacion=habitaciones.id_habitacion");
		if($this->db->sig_reg()){
			$this->id_epicrisis=$this->db->campo("id_epicrisis");
			$this->rut_dni=$this->db->campo("rut_dni");
			$this->rut=$this->db->campo("rut");
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->ubicacion=$this->db->campo("ubicacion");
			$this->habitacion=$this->db->campo("habitacion");
			$this->ambito=$this->db->campo("ambito");
			$this->fecha_ingreso=$this->db->campo("fecha_ingreso");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->id_cirujano=$this->db->campo("id_cirujano");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->resumen=$this->db->campo("resumen");
			$this->regimen=$this->db->campo("regimen");
			$this->reposo=$this->db->campo("reposo");
			$this->regimen_ped=$this->db->campo("regimen_ped");
			$this->reposo_ped=$this->db->campo("reposo_ped");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
			$this->fecha_ingreso_epicrisis=$this->db->campo("fecha_ingreso_epicrisis");
			$this->fecha_ultima_modificacion=$this->db->campo("fecha_ultima_modificacion");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->rut_medico=$this->db->campo("rut_medico");
			$this->nombre_tipo_habitacion=$this->db->campo("nombre_tipo_habitacion");
			$this->nombre_habitacion=$this->db->campo("nombre_habitacion");
			$this->cirugias=$this->db->campo("cirugias");
			$this->nro_receta=$this->db->campo("nro_receta");
			$this->peso_ingreso=$this->db->campo("peso_ingreso");
			$this->peso_egreso=$this->db->campo("peso_egreso");
			$this->dias_estadia=$this->db->campo("dias_estadia");
			$this->estadia_uci=$this->db->campo("estadia_uci");
			$this->sexo=$this->db->campo("sexo");

			$this->nombre_padre=$this->db->campo("nombre_padre");
			$this->escol_padre=$this->db->campo("escol_padre");
			$this->nombre_madre=$this->db->campo("nombre_madre");
			$this->escol_madre=$this->db->campo("escol_madre");
			$this->direccion=$this->db->campo("direccion");
			$this->fono=$this->db->campo("fono");
			$this->parto=$this->db->campo("parto");
			$this->apgar=$this->db->campo("apgar");
			$this->gr_mat=$this->db->campo("gr_mat");
			$this->gr_rn=$this->db->campo("gr_rn");
			$this->fecha_bgc=$this->db->campo("fecha_bgc");
			$this->fecha_pku=$this->db->campo("fecha_pku");
			$this->fecha_nac=$this->db->campo("fecha_nac");
			$this->peso_nac=$this->db->campo("peso_nac");
			$this->peso_alta=$this->db->campo("peso_alta");
			$this->dias_estadia_neo=$this->db->campo("dias_estadia_neo");
			$this->dif_peso=$this->db->campo("dif_peso");

			$this->complicaciones=$this->db->campo("complicaciones");
			$this->procedimientos=$this->db->campo("procedimientos");

			$this->existe=true;
		}
		else{
			$this->existe=false;
		}
	}
	function busca_medicamentos_arsenal($id_epicrisis)
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select medicamento,forma,presentacion,dosis,frecuencia,duracion,via,epicrisis_med_ars.id_medicamento as id_medicamento FROM epicrisis_med_ars,medicamentos where id_epicrisis='$id_epicrisis' and epicrisis_med_ars.id_medicamento=medicamentos.id_medicamento order by epicrisis_med_ars.id_epicrisis");
	}
	function sgte_busca_medicamentos_arsenal()
	{
		if($this->db->sig_reg()){
			$this->id_medicamento=$this->db->campo("id_medicamento");
			$this->medicamento=$this->db->campo("medicamento");
			$this->forma=$this->db->campo("forma");
			$this->presentacion=$this->db->campo("presentacion");
			$this->dosis=$this->db->campo("dosis");
			$this->frecuencia=$this->db->campo("frecuencia");
			$this->duracion=$this->db->campo("duracion");
			$this->via=$this->db->campo("via");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_medicamentos_fuera_arsenal($id_epicrisis)
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis_med where id_epicrisis='$id_epicrisis' ");
	}
	function sgte_busca_medicamentos_fuera_arsenal()
	{
		if($this->db->sig_reg()){
			$this->nombre_medicamento=$this->db->campo("nombre_medicamento");
			$this->dosis=$this->db->campo("dosis");
			$this->frecuencia=$this->db->campo("frecuencia");
			$this->duracion=$this->db->campo("duracion");
			$this->via=$this->db->campo("via");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_lugares()
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM lugares ");
	}
	function sgte_busca_lugares()
	{
		if($this->db->sig_reg()){
			$this->id_lugar=$this->db->campo("id_lugar");
			$this->nombre_lugar=$this->db->campo("nombre_lugar");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_nombre_lugar($id_lugar){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select nombre_lugar FROM lugares where id_lugar='$id_lugar'");
		$this->db->sig_reg();
		$this->nombre_lugar=$this->db->campo("nombre_lugar");
	}
	function elimina_medicamentos($id_epicrisis)
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("delete from epicrisis_med where id_epicrisis='$id_epicrisis'");
		$this->db->consulta("delete from epicrisis_med_ars where id_epicrisis='$id_epicrisis'");
		$this->db->consulta("delete from epicrisis_citaciones where id_epicrisis='$id_epicrisis'");
	}
	function actualiza_epicrisis($id_epicrisis,$rut,$nombre_paciente,$ficha,$tipo_habitacion,$habitacion,$ambito,$fecha_ingreso,$fecha_egreso,$id_cirujano,$egreso,$resumen,$complicaciones,$procedimientos,$regimen,$reposo,$regimen_ped,$reposo_ped,$otras_indicaciones,$fecha_actual,$edad,$tipo_edad,$rut_medico,$egreso2,$cirugias,$peso_ingreso,$peso_egreso,$dias_estadia,$estadia_uci,$sexo,$nombre_padre,$escol_padre,$nombre_madre,$escol_madre,$direccion,$fono,$parto,$apgar,$gr_mat,$gr_rn,$fecha_bgc,$fecha_pku,$fecha_nac,$peso_nac,$peso_alta,$dias_estadia_neo,$dif_peso){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$consulta="update epicrisis set rut='$rut',nombre_paciente='$nombre_paciente',ficha='$ficha',ubicacion='$tipo_habitacion',habitacion='$habitacion',ambito='$ambito',fecha_ingreso='$fecha_ingreso',fecha_egreso='$fecha_egreso',id_cirujano='$id_cirujano',egreso='$egreso',resumen='$resumen',cirugias='$cirugias',regimen='$regimen',reposo='$reposo',regimen_ped='$regimen_ped',reposo_ped='$reposo_ped',otras_indicaciones='$otras_indicaciones',edad='$edad',tipo_edad='$tipo_edad',fecha_ultima_modificacion='$fecha_actual',rut_medico='$rut_medico',egreso2='$egreso2',peso_ingreso='$peso_ingreso',peso_egreso='$peso_egreso',dias_estadia='$dias_estadia',estadia_uci='$estadia_uci',sexo='$sexo',nombre_padre='$nombre_padre',escol_padre='$escol_padre',nombre_madre='$nombre_madre',escol_madre='$escol_madre',direccion='$direccion',fono='$fono',parto='$parto',apgar='$apgar',gr_mat='$gr_mat',gr_rn='$gr_rn',fecha_bgc='$fecha_bgc',fecha_pku='$fecha_pku',fecha_nac='$fecha_nac',peso_nac='$peso_nac',peso_alta='$peso_alta',dias_estadia_neo='$dias_estadia_neo',dif_peso='$dif_peso',complicaciones='$complicaciones',procedimientos='$procedimientos' where id_epicrisis='$id_epicrisis'";
		$consulta=addslashes($consulta);
		$ip=$this->getRealIP();
		$this->db->consulta("insert into seguimiento (consulta, fecha,ip) values ('$consulta','$fecha_actual','$ip')");
		$this->db->consulta("update epicrisis set rut='$rut',nombre_paciente='$nombre_paciente',ficha='$ficha',ubicacion='$tipo_habitacion',habitacion='$habitacion',ambito='$ambito',fecha_ingreso='$fecha_ingreso',fecha_egreso='$fecha_egreso',id_cirujano='$id_cirujano',egreso='$egreso',resumen='$resumen',cirugias='$cirugias',regimen='$regimen',reposo='$reposo',regimen_ped='$regimen_ped',reposo_ped='$reposo_ped',otras_indicaciones='$otras_indicaciones',edad='$edad',tipo_edad='$tipo_edad',fecha_ultima_modificacion='$fecha_actual',rut_medico='$rut_medico',egreso2='$egreso2',peso_ingreso='$peso_ingreso',peso_egreso='$peso_egreso',dias_estadia='$dias_estadia',estadia_uci='$estadia_uci',sexo='$sexo',nombre_padre='$nombre_padre',escol_padre='$escol_padre',nombre_madre='$nombre_madre',escol_madre='$escol_madre',direccion='$direccion',fono='$fono',parto='$parto',apgar='$apgar',gr_mat='$gr_mat',gr_rn='$gr_rn',fecha_bgc='$fecha_bgc',fecha_pku='$fecha_pku',fecha_nac='$fecha_nac',peso_nac='$peso_nac',peso_alta='$peso_alta',dias_estadia_neo='$dias_estadia_neo',dif_peso='$dif_peso',complicaciones='$complicaciones',procedimientos='$procedimientos' where id_epicrisis='$id_epicrisis'");
	}
	function guarda_protocolo_epicrisis($id_epicrisis,$id_protocolo){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("insert into epicrisis_protocolo values ('$id_epicrisis','$id_protocolo')");
	}
	function busca_protocolos_epicrisis($id_epicrisis)
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select id_protocolo FROM epicrisis_protocolo where id_epicrisis='$id_epicrisis' ");
	}
	function sgte_busca_protocolos_epicrisis()
	{
		if($this->db->sig_reg()){
			$this->id_protocolo=$this->db->campo("id_protocolo");
			return true;
		}
		else{
			return false;
		}
	}
	function busca_protocolo_existente($id_protocolo){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis_protocolo where id_protocolo='$id_protocolo'");
		if($this->db->sig_reg()){
			$this->existe=true;
		}
		else{
			$this->existe=false;
		}
		
	}
	function busca_rut_medico($id_cirujano){
		$this->db = new conexion(SERVER,USER,PASSWORD,'protocolo_urgencia');
		$this->db->consulta("select nombre,rut_medico FROM cirujanos where id_cirujano='$id_cirujano'");
		$this->db->sig_reg();
		$this->rut=$this->db->campo("rut_medico");
		$this->nombre=$this->db->campo("nombre");
	}
	function obtiene_ultima_receta($ubicacion){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * from epicrisis where ubicacion='$ubicacion' order by id_epicrisis desc limit 1");
		if($this->db->sig_reg()){
			$this->ultima_receta=$this->db->campo("nro_receta");
		}else{
			$this->ultima_receta=0;
		}

	}
	function number_pad($number,$n) {
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
	}
	function guarda_citaciones($id_epicrisis,$lugar,$fecha){
		date_default_timezone_set("America/Santiago");
		$fecha_actual=date("Y-m-j H:i:s", (strtotime ("-1 Hour")));
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$consulta="insert into epicrisis_citaciones (id_epicrisis,lugar,fecha) values ('".$id_epicrisis."','".$lugar."','".$fecha."')";
		$consulta=addslashes($consulta);
		$ip=$this->getRealIP();
		$this->db->consulta("insert into seguimiento (consulta, fecha,ip) values ('$consulta','$fecha_actual','$ip')");
		$this->db->consulta("insert into epicrisis_citaciones (id_epicrisis,lugar,fecha) values ('$id_epicrisis','$lugar','$fecha')");
	}
	function busca_citaciones($id_epicrisis)
	{
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * FROM epicrisis_citaciones where id_epicrisis='$id_epicrisis'");
	}
	function sgte_busca_citaciones()
	{
		if($this->db->sig_reg()){
			$this->lugar=$this->db->campo("lugar");
			$this->fecha=$this->db->campo("fecha");
			return true;
		}
		else{
			return false;
		}
	}
	function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		   
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
	   
		return $_SERVER['REMOTE_ADDR'];
	}
	function busca_datos_ultima_epicrisis($rut){
		$this->db = new conexion(SERVER,USER,PASSWORD,BASE);
		$this->db->consulta("select * from epicrisis,tipo_habitacion where rut='$rut' and (ubicacion='8' or ubicacion='9') and epicrisis.ubicacion=tipo_habitacion.id_tipo_habitacion order by id_epicrisis desc limit 1");

		if($this->db->sig_reg()){
			$this->existe=true;
			$this->nombre_paciente=$this->db->campo("nombre_paciente");
			$this->ficha=$this->db->campo("ficha");
			$this->edad=$this->db->campo("edad");
			$this->tipo_edad=$this->db->campo("tipo_edad");
			$this->egreso=$this->db->campo("egreso");
			$this->egreso2=$this->db->campo("egreso2");
			$this->resumen=$this->db->campo("resumen");
			$this->fecha_egreso=$this->db->campo("fecha_egreso");
			$this->nombre_tipo_habitacion=$this->db->campo("nombre_tipo_habitacion");
			$this->reposo=$this->db->campo("reposo");
			$this->otras_indicaciones=$this->db->campo("otras_indicaciones");
		
			$this->cirugias=$this->db->campo("cirugias");
			$this->peso_ingreso=$this->db->campo("peso_ingreso");
			$this->peso_egreso=$this->db->campo("peso_egreso");
			$this->dias_estadia=$this->db->campo("dias_estadia");
			$this->estadia_uci=$this->db->campo("estadia_uci");
			$this->sexo=$this->db->campo("sexo");

			$this->nombre_padre=$this->db->campo("nombre_padre");
			$this->escol_padre=$this->db->campo("escol_padre");
			$this->nombre_madre=$this->db->campo("nombre_madre");
			$this->escol_madre=$this->db->campo("escol_madre");
			$this->direccion=$this->db->campo("direccion");
			$this->fono=$this->db->campo("fono");
			$this->parto=$this->db->campo("parto");
			$this->apgar=$this->db->campo("apgar");
			$this->gr_mat=$this->db->campo("gr_mat");
			$this->gr_rn=$this->db->campo("gr_rn");
			$this->fecha_bgc=$this->db->campo("fecha_bgc");
			$this->fecha_pku=$this->db->campo("fecha_pku");
			$this->fecha_nac=$this->db->campo("fecha_nac");
			$this->peso_nac=$this->db->campo("peso_nac");
			$this->peso_alta=$this->db->campo("peso_alta");
			$this->dias_estadia_neo=$this->db->campo("dias_estadia_neo");
			$this->dif_peso=$this->db->campo("dif_peso");
		}
		else{
			$this->existe=false;
		}
	}
	function busca_cirugias_paciente($rut,$fecha_ingreso,$fecha_egreso){
		$this->db = new conexion(SERVER,USER,PASSWORD,'protocolo_urgencia');
		$this->db->consulta("select cirujanos.nombre as nombre_cirujano,practicada,fecha_oper from protocolos,cirujanos where rut='$rut' and protocolos.cirujano=cirujanos.id_cirujano and fecha_oper between '$fecha_ingreso' and '$fecha_egreso'");

	}
	function sgte_busca_cirugias_paciente()
	{
		if($this->db->sig_reg()){
			$this->nombre_cirujano=$this->db->campo("nombre_cirujano");
			$this->practicada=$this->db->campo("practicada");
			$this->fecha_oper=$this->db->campo("fecha_oper");
			return true;
		}
		else{
			return false;
		}
	}
}
?>
