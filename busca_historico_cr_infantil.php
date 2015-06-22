<?php
$dir="historicos_cr_infantil/";
$rut=$_POST["rut"];
//echo "<BR>".$rut;
$i=0;
$directorio=opendir($dir);
while($archivo = readdir($directorio)){ 
        if($archivo!="." && $archivo!=".." && $archivo!="...."){
			$separado=explode(" ",$archivo);
			if($separado[0]==$rut){
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
				
				$largo=count($separado);
				if($largo==2){
					$fecha=explode(".",$separado[1]);
					$fecha=$fecha[0];
					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$fecha."</td><td>Pediatría</td><td><a href='descargar.php?ruta=historicos_cr_infantil&archivo=".$archivo."'>Descargar</a></td></tr>";
				}else if($largo>2){
					//echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$separado[1]."</td><td>Pediatría</td><td><a onclick='descarga(\"historicos_cr_infantil/".$archivo."\");'>Descargar</a></td></tr>";
					//echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$separado[1]."</td><td>Pediatría</td><td><a href='=historicos_cr_infantil/".$archivo."'>Descargar</a></td></tr>";
					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$separado[1]."</td><td>Pediatría</td><td><a href='descargar.php?ruta=historicos_cr_infantil&archivo=".$archivo."'>Descargar</a></td></tr>";
				}
				
				
			}
		}
}
$dir="historicos_cr_infantil/traslado_UPC";
$j=0;
$directorio=opendir($dir);
while($archivo = readdir($directorio)){ 
        if($archivo!="." && $archivo!=".." && $archivo!="...."){
			$separado=explode(" ",$archivo);
			if($separado[0]==$rut){
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
				
				$largo=count($separado);
				if($largo==2){
					$fecha=explode(".",$separado[1]);
					$fecha=$fecha[0];
					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$fecha."</td><td>Traslado UPC</td><td><a href='descargar.php?ruta=".$dir."&archivo=".$archivo."'>Descargar</a></td></tr>";
				}else if($largo>2){

					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$separado[1]."</td><td>Traslado UPC</td><td><a href='descargar.php?ruta=".$dir."&archivo=".$archivo."'>Descargar</a></td></tr>";
				}
				
				
			}
		}
}


$dir="historicos_cr_infantil/neonatologia";
$k=0;
$directorio=opendir($dir);
while($archivo = readdir($directorio)){ 
        if($archivo!="." && $archivo!=".." && $archivo!="...."){
			$separado=explode(" ",$archivo);
			if($separado[0]==$rut){
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
				
				$largo=count($separado);
				if($largo==2){
					$fecha=explode(".",$separado[1]);
					$fecha=$fecha[0];
					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$fecha."</td><td>Neonatologia</td><td><a href='descargar.php?ruta=".$dir."&archivo=".$archivo."'>Descargar</a></td></tr>";
				}else if($largo>2){

					echo "<tr style='font-size:10pt;text-align:center;'><td >".$separado[0]."</td><td>".$separado[1]."</td><td>Neonatologia</td><td><a href='descargar.php?ruta=".$dir."&archivo=".$archivo."'>Descargar</a></td></tr>";
				}
				
				
			}
		}
}

if($i==0 && $j==0 && $k==0){
	//echo "<br><center><h2>No existen registros historicos de CR Infantil</h2></center>";
}
else{
	echo "</table>";
}
?>