<?php
include('clases/consultas.php');
$busca_habitaciones=new consultas();
$tipo_habitacion=$_POST["tipo_habitacion"];
$busca_habitaciones->busca_habitaciones($tipo_habitacion);
echo "<b>Habitación(*) </b><select id='habitacion'> <option value='0'>--Seleccione--</option>";
while($busca_habitaciones->sgte_busca_habitaciones()){
	echo "<option value='".$busca_habitaciones->id_habitacion."'>".$busca_habitaciones->nombre_habitacion."</option>";
}
echo "</select>";
?>