<?php

	//Cargamos los controladores
	require_once __DIR__ . '/../app/Config.php';
	require_once __DIR__ . '/../app/Model.php';
	require_once __DIR__ . '/../app/Controller.php';

	//Array asociativo y parseamos la ruta. Con esto sabemos la acción que tenemos que lanzar
	$map = array(
		'inicio' => array('controller' => 'Controller', 'action' => 'inicio'),
		'listar' => array('controller' => 'Controller', 'action' => 'listar'),
		'ordenados' => array('controller' => 'Controller', 'action' => 'ordenados'),
		'ordenar' => array('controller' => 'Controller', 'action' => 'ordenar'),
		'insertar' => array('controller' => 'Controller', 'action' => 'insertar'),
		'buscar' => array('controller' => 'Controller', 'action' => 'buscarPorNombre'),
		'ver' => array('controller' => 'Controller', 'action' => 'ver'),
		'buscarAlimentosPorEnergia' => array('controller' => 'Controller', 'action' => 'buscarPorEnergia'),
		'combinada' => array('controller' => 'Controller', 'action' => 'combinada'),
		'eliminar' => array('controller' => 'Controller', 'action' => 'eliminar')
	);

	//Parseamos la ruta
	if(isset($_GET['action'])) {

		if(isset($map[$_GET['action']])) {

			$ruta = $_GET['action'];

		} else {

			header('Status: 404 Not Found');
			echo '<html><body><p>Error 404: No existe la ruta '.
			$_GET['action'].'</p></body></html>';
			exit;

		}

	} else {

		$ruta = 'inicio';

	}

	$controlador = $map[$ruta];

	//Ejecutamos el controlador asociado a la ruta
	if(method_exists($controlador['controller'], $controlador['action'])) {

		call_user_func(array(
			new $controlador['controller'], $controlador['action'])
		);

	} else {

		header('Status: 404 Not Found');
		echo '<html><body><p>Error 404: El controlador '.$controlador['controller'].'->'.$controlador['action'].' no existe</p></body></html>';

	}

?>