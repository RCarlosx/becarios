<?php

require_once('../controller/becarios_controller.php');
$becarios_controller = new Becarios_controller();

echo $becarios_controller->get_HTML_letras_becarios();