function openOffersDialog(fonasa,sigges,prog_0,tipo) {
	$('#contenido2').html("<center><img src='images/loading2.gif' width='100px'></center>");
	$('#overlay').fadeIn('fast', function() {
		$('#boxpopup').css('display','block');
        $('#boxpopup').animate({'left':'30%'},500);
    });
	$.ajax({
			type: "POST",
			url: "detalle_ppv.php",
			data: "fonasa="+fonasa+"&sigges="+sigges+"&prog_0="+prog_0+"&tipo="+tipo,
			success: function(datos){
				$('#contenido2').html(datos);
			}
		});
	
}

function closeOffersDialog(prospectElementID) {
	$(function($) {
		$(document).ready(function() {
			$('#' + prospectElementID).css('position','absolute');
			$('#' + prospectElementID).animate({'left':'-100%'}, 500, function() {
				$('#' + prospectElementID).css('position','fixed');
				$('#' + prospectElementID).css('left','100%');
				$('#overlay').fadeOut('fast');
				$('#contenido2').html("");
			});
		});
	});
}
