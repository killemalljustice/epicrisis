<?php
$dir="historicos_cr_infantil/";
$fecha_inicio=$_POST["fecha_inicio"];
$separado=explode('/',$fecha_inicio);
$fecha_inicio=$separado[2]."-".$separado[1]."-".$separado[0];
$fecha_termino=$_POST["fecha_termino"];
$separado=explode('/',$fecha_termino);
$fecha_termino=$separado[2]."-".$separado[1]."-".$separado[0];
//echo "<BR>".$rut;
$i=0;
//echo $fecha_inicio." ".strtotime($fecha_inicio)."<br>";
//echo $fecha_termino." ".strtotime($fecha_termino)."<br>";
$fecha_inicio_numero=strtotime($fecha_inicio);
$fecha_termino_numero=strtotime($fecha_termino);
$directorio=opendir($dir);
$i=0;
while($archivo = readdir($directorio)){ 
        if($archivo!="." && $archivo!=".." && $archivo!="...."){
			$separado_1=explode(" ",$archivo);
			$largo=count($separado_1);
				if($largo==2){
					$fecha=explode(".",$separado_1[1]);
					$fecha=$fecha[0];
				}else if($largo>2){
					$fecha=$separado_1[1];
				}
				
				$separado=explode('-',$fecha);
				$fecha_invertida=$separado[2]."-".$separado[1]."-".$separado[0];
				$fecha_numero=strtotime($fecha_invertida);
				if($fecha_numero>=$fecha_inicio_numero && $fecha_numero<=$fecha_termino_numero){
					//echo $fecha."<br>";
					if($i==0){
						echo "<br><br><table width='100%' border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0' >
					<tr bgcolor='#CCCCCC'>
					<td align=center colspan='4'><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>HISTORICOS CR INFANTIL</b></font></strong></td>
					</tr>
					<tr bgcolor='#CCCCCC'>
					<td align=center ><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>RUT</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Fecha</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Tipo</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Descargar</b></font></strong></td>
					</tr>";
						$i++;
					}
					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado_1[0]."</td><td>".$fecha."</td><td>Pediatría</td><td><a href='descargar.php?ruta=historicos_cr_infantil&archivo=".$archivo."'>Descargar</a></td></tr>";
				}
		}
}
$dir="historicos_cr_infantil/traslado_UPC";
$directorio=opendir($dir);
$j=0;
while($archivo = readdir($directorio)){ 
        if($archivo!="." && $archivo!=".." && $archivo!="...."){
				//echo "ARCHIVO: ".$archivo."<br>";
			$separado_1=explode(" ",$archivo);
			$largo=count($separado_1);
				if($largo==2){
					$fecha=explode(".",$separado_1[1]);
					$fecha=$fecha[0];
				}else if($largo>2){
					$fecha=$separado_1[1];
				}
				//echo "ANTES DEL EXPLODE ".$fecha."<br>";
				$separado=explode('-',$fecha);
				$fecha_invertida=$separado[2]."-".$separado[1]."-".$separado[0];
				$fecha_numero=strtotime($fecha_invertida);
				if($fecha_numero>=$fecha_inicio_numero && $fecha_numero<=$fecha_termino_numero){
					//echo $fecha."<br>";
					if($j==0 && $i==0){
						echo "<br><br><table width='100%' border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0' >
					<tr bgcolor='#CCCCCC'>
					<td align=center colspan='4'><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>HISTORICOS CR INFANTIL</b></font></strong></td>
					</tr>
					<tr bgcolor='#CCCCCC'>
					<td align=center ><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>RUT</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Fecha</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Tipo</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Descargar</b></font></strong></td>
					</tr>";
						$j++;
					}
					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado_1[0]."</td><td>".$fecha."</td><td>Traslado UPC</td><td><a href='descargar.php?ruta=".$dir."&archivo=".$archivo."'>Descargar</a></td></tr>";
				}
		}
}
$dir="historicos_cr_infantil/neonatologia";
$directorio=opendir($dir);
$k=0;
while($archivo = readdir($directorio)){ 
        if($archivo!="." && $archivo!=".." && $archivo!="...."){
				//echo "ARCHIVO: ".$archivo."<br>";
			$separado_1=explode(" ",$archivo);
			$largo=count($separado_1);
				if($largo==2){
					$fecha=explode(".",$separado_1[1]);
					$fecha=$fecha[0];
				}else if($largo>2){
					$fecha=$separado_1[1];
				}
				//echo "ANTES DEL EXPLODE ".$fecha."<br>";
				$separado=explode('-',$fecha);
				$fecha_invertida=$separado[2]."-".$separado[1]."-".$separado[0];
				$fecha_numero=strtotime($fecha_invertida);
				if($fecha_numero>=$fecha_inicio_numero && $fecha_numero<=$fecha_termino_numero){
					//echo $fecha."<br>";
					if($j==0 && $i==0 && $k==0){
						echo "<br><br><table width='100%' border='1' style='border-collapse: collapse' cellpadding='0' cellspacing='0' >
					<tr bgcolor='#CCCCCC'>
					<td align=center colspan='4'><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>HISTORICOS CR INFANTIL</b></font></strong></td>
					</tr>
					<tr bgcolor='#CCCCCC'>
					<td align=center ><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>RUT</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Fecha</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Tipo</b></font></strong></td>
					<td align=center><font style='font-size:8pt;' face='Verdana, Arial, Helvetica, sans-serif' color=#000000><b>Descargar</b></font></strong></td>
					</tr>";
						$k++;
					}
					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado_1[0]."</td><td>".$fecha."</td><td>Neonatologia</td><td><a href='descargar.php?ruta=".$dir."&archivo=".$archivo."'>Descargar</a></td></tr>";
				}
		}
}
if($i==0 && $j==0 && $k==0){
	//echo "<br><center><h2>No existen registros historicos de CR Infantil entre las fechas indicadas</h2></center>";
}
else{
	echo "</table>";
}

?>