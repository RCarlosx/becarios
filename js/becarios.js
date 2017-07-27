/**
	* Maneja los eventos respecto a la caja de becarios
**/

var pagina = 1;
var letra = 'l';
var indice_becario = 0;
var cantidad_becarios_letra= 0;

function get_becarios() {
	dispositivo = get_dispositivo_navegacion();
	$.ajax({
	    // la URL para la petición
	    url : 'php/respuestasAjax/get_becarios.php',
	 
	    // la información a enviar
	    data : "letra="+letra+"&pagina="+pagina+'&dispositivo='+dispositivo,
	 
	    // especifica si será una petición POST o GET
	    type : 'GET',
	 
	    // el tipo de información que se espera de respuesta
	    dataType : 'json',
	 
	    // código a ejecutar si la petición es satisfactoria;
	    // la respuesta es pasada como argumento a la función
	    success : function(response) {
	    	$html = $('.galeria_becarios').html();
	    	$('.galeria_becarios').html($html + response.becarios);
	    	indice_becario += response.cantidad;
	    	cantidad_becarios_letra = response.becarios_totales;
	    	validar_mostrar_mas();
	    },
	 
	    // código a ejecutar si la petición falla;
	    // son pasados como argumentos a la función
	    // el objeto de la petición en crudo y código de estatus de la petición
	    error : function(xhr, status) {
	        console.log(status);
	    },
	 
	});
}

function get_indice_letras() {
	$.ajax({
	    // la URL para la petición
	    url : 'php/respuestasAjax/get_indice_letras.php',
	    dataType : 'text',
	    success : function(response) {
	    	$('.indice_letras').html(response);
	    },	 
	    error : function(xhr, status) {
	        console.log(status);
	    },
	});
}

function get_cantidad_becarios_por_letra()
{
	$.ajax({
	    // la URL para la petición
	    url : 'php/respuestasAjax/get_cantidad_becarios_letra.php?letra='+letra,
	    dataType : 'text',
	    success : function(response) {
	    	cantidad_becarios_letra = parseInt(response);
	    	//console.log("cantiadd de becario");
	    },	 
	    error : function(xhr, status) {
	        console.log(status);
	    },
	});
}

function get_dispositivo_navegacion() {
	// verificar si ipad también entra aquí
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
	{
	    return 'mobile';
	}
	else 
	{
		return 'desktop';
	}
}

function validar_mostrar_mas() {
	// verifica si debe mostrarse aun la flecha derecha
	// Eliminar la flecha anterior a la solicitud
	$('#flecha_derecha').remove();
	if(indice_becario < cantidad_becarios_letra)
	{
		$('.galeria_becarios').append('<div id="flecha_derecha"></div>');

	}
}


$(function(){
	$('div.indice_letras').on('click','span',function()
		{
			letra = $(this).attr('id');
			pagina = 1; // reincia la página
			indice_becario = 0; // reinicia el indice becario
			$('.galeria_becarios').html('');
			get_becarios();
		});

	$('.contenedor_principal').on('click','div#flecha_derecha',function()
		{
			pagina+=1;
			get_becarios();
		});
});


// Cuando el DOM del index terminó de descargarse
$(document).ready(function()
{
	get_indice_letras();
	get_becarios();
});



