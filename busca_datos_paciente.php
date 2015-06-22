<?php
/*header ("content-type: application/json; charset=utf-8");
include('clases/consultas.php');
$rut=$_POST["rut"];
$calcula_edad=new consultas();
$busca_datos_paciente=new consultas();
$busca_datos_paciente->busca_datos_paciente($rut);
if($busca_datos_paciente->existe){
	$edad=$calcula_edad->calculaedad($busca_datos_paciente->nacimiento);
	if($busca_datos_paciente->nacimiento=='0000-00-00' or $edad==0)
		$edad='';
	$datos=array(utf8_encode($busca_datos_paciente->nombre),utf8_encode($busca_datos_paciente->paterno),utf8_encode($busca_datos_paciente->materno),$busca_datos_paciente->ficha,$edad);
}else{
	$datos=array("","","","","");
}
echo json_encode($datos);*/

header ("content-type: application/json; charset=utf-8");
include('clases/consultas.php');
$rut=$_POST["rut"];
$calcula_edad=new consultas();

if(!($iden = mysql_connect("10.6.180.186", "gestion", ""))) //.186 ahora (antes .56) vane
    die("Error: No se pudo conectar");
	
  // Selecciona la base de datos 
  if(!mysql_select_db("paso", $iden)) 
    die("Error: No existe la base de datos");
	
  // Sentencia SQL: muestra todo el contenido de la tabla "books" 
  $sentencia = "SELECT * FROM pacientes_paso where rut='$rut'"; 
  // Ejecuta la sentencia SQL 
  $resultado = mysql_query($sentencia, $iden); 
  if(!$resultado) 
    die("Error: no se pudo realizar la consulta");

 if($fila = mysql_fetch_assoc($resultado)) 
  { 
		$edad=$calcula_edad->calculaedad($fila['nacimiento']); //SE CALCULA EDAD DEL PACIENTE DE ACUERDO A SU FECHA DE NACIMIENTO
		if($fila['nacimiento']=='0000-00-00' or $edad==0){
			$edad='';
		}
		$datos=array($fila['nombre'],$fila['ape1'],$fila['ape2'],$fila['ficha'],$edad);
  }else{
	$datos=array("","","","","");
  }
  echo json_encode($datos);
?>