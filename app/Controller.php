<?php

	//Definimos la clase Controller
	class Controller {

		//Función inicio
		public function inicio() {

			$params = array(
				'mensaje' => 'Bienvenido a la aplicación de alimentos',
				'fecha' => date('d-m-y')
			);

			require __DIR__ . '/templates/inicio.php';

		}

		//Función listar alimentos
		public function listar() {

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			$params = array('alimentos' => $m->dameAlimentos());

			require __DIR__ .'/templates/mostrarAlimentos.php';

		}

		//Función selecionar orden
		public function ordenados() {

			$params = array(
				'ctc' => '',
				'tipo' =>'',
				'resultado' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			$params = array('resultado' => $m->dameAlimentos());

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['ctc'] = $_POST['ctc'];
				$params['tipo'] = $_POST['tipo'];
				$params['resultado'] = $m->ordenarPor(
					$_POST['ctc'],
					$_POST['tipo']
				);

			}

			require __DIR__ .'/templates/ordenados.php';

		}

		//Función insertar alimentos
		public function insertar() {

			$params = array(
				'nombre' => '',
				'energia' => '', 
				'proteina' => '',
				'hc' => '', 
				'fibra' => '',
				'grasa' => '' 
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				//Comprobar campos formulario
				if ($m->validarDatos($_POST['nombre'], $_POST['energia'], $_POST['proteina'], $_POST['hc'], $_POST['fibra'], $_POST['grasa'])) {

					$m->insertarAlimento(
						$_POST['nombre'], 
						$_POST['energia'],
						$_POST['proteina'], 
						$_POST['hc'],
						$_POST['fibra'], 
						$_POST['grasa']
					);

					header('Location: index.php?action=listar');

				} else {

					$params = array( 
						'nombre' => $_POST['nombre'],
						'energia' => $_POST['energia'],
						'proteina' => $_POST['proteina'],
						'hc' => $_POST['hc'], 
						'fibra' => $_POST['fibra'], 
						'grasa' => $_POST['grasa']
					);
					
					$params['mensaje'] = 'No se ha podido insertar el alimento. Revisa el formulario';

				}

			}

			require __DIR__ .'/templates/formInsertar.php';

		}

		//Función buscar alimentos por nombre
		public function buscarPorNombre() {

			$params = array(
				'nombre' => '',
				'resultado' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['nombre'] = $_POST['nombre'];
				$params['resultado'] = $m->buscarAlimentosPorNombre(
					$_POST['nombre']
				);

			}

			require __DIR__ .'/templates/buscarPorNombre.php';

		}

		//Función buscar alimentos por energia
		public function buscarPorEnergia() {

			$params = array(
				'energia' => '',
				'resultado' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['energia'] = $_POST['energia'];
				$params['resultado'] = $m->buscarAlimentosPorEnergia(
					$_POST['energia']
				);

			}

			require __DIR__ .'/templates/buscarPorEnergia.php';

		}

		//Función buscar alimentos combinada
		public function combinada() {

			$params = array(
				'energia' => '',
				'grasatotal' => '',
				'resultado' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['energia'] = $_POST['energia'];
				$params['grasatotal'] = $_POST['grasatotal'];
				$params['resultado'] = $m->busquedaCombinada(
					$_POST['energia'],
					$_POST['grasatotal']
				);

			}

			require __DIR__ .'/templates/combinada.php';

		}

		//Función para eliminar alimentos
		public function eliminar() {

			$params = array(
				'nombre' => '',
				'resultado' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['nombre'] = $_POST['nombre'];
				$params['resultado'] = $m->eliminarPorNombre(
					$_POST['nombre']
				);

				header('Location: index.php?action=listar');

			}

			require __DIR__ .'/templates/eliminar.php';

		}  

		//Función ver alimento
		public function ver() {

			if (!isset($_GET['id'])) {

				throw new Exception('Pagina no encontrada');
			}

			$id = $_GET['id'];

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			$alimento = $m->dameAlimento($id);

			$params = $alimento;

			require __DIR__ . '/templates/verAlimento.php';
		}

	}

?>