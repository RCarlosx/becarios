<?php

/**
* Origen de datos
*/
class Becarios_model 
{
	private static $data_becarios;


	function Becarios_model() 
	{
		self::$data_becarios[] = array('nombre' => 'juan','foto' => 'juan.png');
		self::$data_becarios[] = array('nombre' => 'pedro','foto' => 'pedro.png');
		self::$data_becarios[] = array('nombre' => 'maria','foto' => 'maria.png');
		self::$data_becarios[] = array('nombre' => 'leon','foto' => 'leon.png');
		self::$data_becarios[] = array('nombre' => 'fernando','foto' => 'fernando.png');
		self::$data_becarios[] = array('nombre' => 'jair','foto' => 'jair.png');
		self::$data_becarios[] = array('nombre' => 'lucia','foto' => 'lucia.png');
		self::$data_becarios[] = array('nombre' => 'leopoldo','foto' => 'leopoldo.png');
		self::$data_becarios[] = array('nombre' => 'leonardo','foto' => 'leonardo.png');
		self::$data_becarios[] = array('nombre' => 'leopoldo','foto' => 'leopoldo.png');
		self::$data_becarios[] = array('nombre' => 'leonardo','foto' => 'leonardo.png');
		self::$data_becarios[] = array('nombre' => 'leopoldo','foto' => 'leopoldo.png');
		self::$data_becarios[] = array('nombre' => 'leonardo','foto' => 'leonardo.png');
	}

	// devuelve a los becarios cuyo nombre comience con una letra
	public function get_becarios_by_letra($letra) 
	{	
		foreach (self::$data_becarios as $becario) 
		{
			if(substr($becario['nombre'], 0, 1) == $letra) 
			{
				$data_becarios_array[] = $becario;
			}
		}
		return $data_becarios_array;
	} 

	// devuelve a los becarios
	public function get_todos_becarios() 
	{	
		foreach (self::$data_becarios as $becario) 
		{
			$data_becarios_array[] = $becario;
		}

		return $data_becarios_array;
	} 



}