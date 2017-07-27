<?php

/**
*  Controlador de la página de becarios
*/
require_once("../model/model.php");

class Becarios_controller
{
	private static $becarios_model;
	private static $cantidad_becarios_desktop = 2;
	private static $cantidad_becarios_mobile = 1;

	function becarios_controller()
	{
		self::$becarios_model = new Becarios_model();
	}

	/*
		Recupera los datos de los becarios
	*/
	private function get_becarios_by_letra($letra)
	{
		return self::$becarios_model->get_becarios_by_letra($letra);
	}

	/*s
		Recupera una pagina de becarios, donde pagina es un paquete de items
	*/

	public function get_pagina_becarios($becarios, $numero_pagina, $dispositivo)
	{
		$data_becarios = array();
		$cantidad_becarios_por_pagina = self::get_cantidad_becarios_por_dispositivo($dispositivo);

		$indice_final = $numero_pagina * $cantidad_becarios_por_pagina;
		
		// el array de becarios ya debe estar ordenado
		if($numero_pagina > 1)
		{
			$indice_inicial = $indice_final - ($cantidad_becarios_por_pagina - 1);
		}
		else 
		{
			$indice_inicial = 1;
		}
		
		for ($i = $indice_inicial; $i <= $indice_final ; $i++) 
		{ 
			if(isset($becarios[$i - 1]))
			{
				$data_becarios[] = $becarios[$i - 1];  // -1 porque es el índice real del array
			}
			else 
			{
				break;
			}
			
		}
		return $data_becarios;
	}

	/*
		Recupera el código HTML de una consulta de becarios
	*/
	public function get_HTML_becarios_by_letra($letra, $numero_pagina, $dispositivo)
	{
		$data_becarios = self::get_becarios_by_letra($letra);
		$data_becarios = self::get_pagina_becarios($data_becarios,$numero_pagina,$dispositivo);
		// El código HTML que se puede cambiar por el que se necesite
		$codigo_HTML = "";
		foreach ($data_becarios as $becario) {
			$codigo_HTML.='<div class="becario">';
			$codigo_HTML.='<div class="foto">'.'<img src="img/'.$becario['foto'].'"/></div>';
			$codigo_HTML.='<div class="nombre">'.$becario['nombre'].'</div>';
			$codigo_HTML.='</div>';

		}
		return $codigo_HTML;
	}

	/*
		Recupera las letras iniciales de los nombres de los becarios
	*/
	private function get_letras_becarios()
	{
		$data_becarios = self::$becarios_model->get_todos_becarios();
		$letras_array = array();
		foreach ($data_becarios as $becario) 
		{
			$letra = substr($becario['nombre'], 0,1);
			if(!in_array($letra, $letras_array))
			{
				array_push($letras_array, $letra);
			}
		}
		// ordenar las letras
		asort($letras_array);
		return $letras_array;
	}

	/*
		Devuelve el HTML de las letras iniciales de los becarios
	*/
	public function get_HTML_letras_becarios()
	{
		$codigo_HTML = "";
		$letras = self::get_letras_becarios();
		foreach ($letras as $letra) 
		{
			$codigo_HTML .= '<span id="'.$letra.'">'.$letra.'</span>';
		}
		return $codigo_HTML;
	}

	/*
		Devuelve la cantidad de becarios por letra
	*/
	public function get_cantidad_becarios_by_letra($letra)
	{
		$data_becarios = self::$becarios_model->get_becarios_by_letra($letra);
		$cantidad_becarios= 0;
		foreach ($data_becarios as $becario) 
		{
			$cantidad_becarios += 1;
		}
		return $cantidad_becarios;
	}

	/*
		Devuelve la cantidad de becarios que se cargan según el dispositivo
	*/

	public function get_cantidad_becarios_por_dispositivo($dispositivo)
	{

		if($dispositivo == 'desktop')
		{
			return self::$cantidad_becarios_desktop;
		}
		else {
			return self::$cantidad_becarios_mobile;
		}
	}

	
}