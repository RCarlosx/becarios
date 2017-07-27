<?php

if(isset($_GET['letra']) and isset($_GET['pagina']) and isset($_GET['dispositivo']))
{
	/* Hacer validaciones:
		- letra sea válida
		- la letra exista en la lista de nombres de los becarios
	*/
	require_once('../controller/becarios_controller.php');
	$becarios_controller = new Becarios_controller();
	$letra = $_GET['letra'];
	$pagina = $_GET['pagina'];
	$dispositivo = $_GET['dispositivo'];
	
	$becarios_solicitados_HTML = $becarios_controller->get_HTML_becarios_by_letra($letra,$pagina,$dispositivo);
	
	// crea un array asociativo
	$data_becarios['becarios'] = $becarios_solicitados_HTML;

	// cantidad de becarios solicitados
	$data_becarios['cantidad'] = $becarios_controller->get_cantidad_becarios_por_dispositivo($dispositivo);

	$data_becarios['becarios_totales'] = $becarios_controller->get_cantidad_becarios_by_letra($letra);

	print_r(json_encode($data_becarios));
}