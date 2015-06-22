function openOffersDialog(tipo) {
	//$('#contenido2').html("<center><img src='images/loading2.gif' width='100px'></center>");
	$('#overlay').fadeIn('fast', function() {
		$('#boxpopup').css('display','block');
        $('#boxpopup').animate({'left':'30%'},500);
    });
	if(tipo == 'cirujano')
		$('#contenido3').html("<h2><center>NUEVO CIRUJANO</center></h2><br><B>Nombre: </B><input type='text' id='nombre_cirujano' style='width:400px; color:#888; text-transform: uppercase;' value='APELLIDO1 APELLIDO2 NOMBRE' onfocus='inputFocus(this)' onblur='inputBlur(this)'><br><br><center><DIV id='botones'><input type='button' value='Agregar' onclick='nuevo_cirujano();'><input type='button' value='Cancelar' onclick='closeOffersDialog(\"boxpopup\");'></DIV></center>");
	else if (tipo == 'anestesista')
	{
		$('#contenido3').html("<h2><center>NUEVO ANESTESISTA</center></h2><br><b>Nombre: </b><input type='text' id='nombre_anestesista' style='width:400px; color:#888; text-transform: uppercase;' value='APELLIDO1 APELLIDO2 NOMBRE' onfocus='inputFocus(this)' onblur='inputBlur(this)'><br><br><center><DIV id='botones'><input type='button' value='Agregar' onclick='nuevo_anestesista();'><input type='button' value='Cancelar' onclick='closeOffersDialog(\"boxpopup\");'></DIV></center>");
	}
	/*$.ajax({
			type: "POST",
			url: "detalle_ppv.php",
			data: "fonasa="+fonasa+"&sigges="+sigges+"&prog_0="+prog_0,
			success: function(datos){
				$('#contenido').html(datos);
			}
		});*/
	
}
function inputFocus(i){
    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
}
function inputBlur(i){
    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
}
function closeOffersDialog(prospectElementID) {
	$(function($) {
		$(document).ready(function() {
			$('#' + prospectElementID).css('position','absolute');
			$('#' + prospectElementID).animate({'left':'-100%'}, 500, function() {
				$('#' + prospectElementID).css('position','fixed');
				$('#' + prospectElementID).css('left','100%');
				$('#overlay').fadeOut('fast');
				$('#contenido3').html("");
			});
		});
	});
}
