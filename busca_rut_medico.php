<?php
include('clases/consultas.php');
$id_cirujano=$_POST["id_cirujano"];
$busca_rut_medico=new consultas();
$busca_rut_medico->busca_rut_medico($id_cirujano);
echo $busca_rut_medico->rut;
?>