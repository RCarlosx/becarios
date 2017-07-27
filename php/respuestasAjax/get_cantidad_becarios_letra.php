<?php

if(isset($_GET['letra']))
{
	require_once('../controller/becarios_controller.php');
	$becarios_controller = new Becarios_controller();
	$letra = $_GET['letra'];

	echo $becarios_controller->get_cantidad_becarios_by_letra($letra);
}