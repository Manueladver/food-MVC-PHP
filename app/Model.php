<?php

	//Definimos la clase Model
	class Model {

		protected $conexion;

		//Conexión a la base de datos
		public function __construct($dbname, $dbuser, $dbpass, $dbhost) {

			$mvc_bd_conexion = new mysqli($dbhost, $dbuser, $dbpass);
			$error = $mvc_bd_conexion->connect_errno;

			if ($error != null) {

				die('No ha sido posible realizar la conexión con la base de datos: '.$mvc_bd_conexion->connect_error);

			}

			$mvc_bd_conexion->select_db($dbname);
			$mvc_bd_conexion->set_charset('utf8');
			$this->conexion = $mvc_bd_conexion;

		}

		//Función para sacar los alimentos de la base de datos según la consulta pasada
		private function dameAlimentosDB($sql) {

			$result = $this->conexion->query($sql);

			$alimentos = array();

			while ($row = $result->fetch_assoc()) {

				$alimentos[] = $row;

			}

			return $alimentos;
		}

		//Función con la consulta para sacar todos los alimentos
		public function dameAlimentos() {

			$sql = "SELECT * FROM alimentos ORDER BY energia ASC";

			return $this->dameAlimentosDB($sql);
		}

		//Función para buscar alimentos por el nombre
		public function buscarAlimentosPorNombre($nombre) {

			$nombre = htmlspecialchars($nombre);

			$sql = "SELECT * FROM alimentos WHERE nombre='".$nombre."' ORDER BY energia DESC";

			return $this->dameAlimentosDB($sql);
		}

		//Función para buscar alimentos por energia
		public function buscarAlimentosPorEnergia($energia) {

			$energia = htmlspecialchars($energia);

			$sql = "SELECT * FROM alimentos WHERE energia='".$energia."' ORDER BY energia DESC";

			return $this->dameAlimentosDB($sql);
		}

		//Función para buscar alimentos por energía y grasas total
		public function busquedaCombinada($energia, $grasatotal) {

			$energia = htmlspecialchars($energia);
			$grasatotal = htmlspecialchars($grasatotal);

			$sql = "SELECT * FROM alimentos WHERE energia='".$energia."' AND grasatotal='".$grasatotal."' ORDER BY nombre DESC";

			return $this->dameAlimentosDB($sql);

		}

		//Función para ordernar los alimentos
		public function ordenarPor($ctc, $tipo) {

			$ctc =  htmlspecialchars($ctc);
			$tipo =  htmlspecialchars($tipo);

			$sql = "SELECT * FROM alimentos ORDER BY $ctc $tipo";

			return $this->dameAlimentosDB($sql);

		}

		//Función borrar
		private function eliminando($sql) {

			$result = $this->conexion->query($sql);

		}

		//Función para eliminar alimento
		public function eliminarPorNombre($nombre) {

			$nombre = htmlspecialchars($nombre);

			$sql = "DELETE FROM alimentos WHERE nombre='".$nombre."'";

			return $this->eliminando($sql);

		}

		public function dameAlimento($id) {

			$id = htmlspecialchars($id);

			$sql = "SELECT * FROM alimentos WHERE id='".$id."'";

			return $this->dameAlimentosDB($sql)[0];
		}

		//Función para insertar alimentos en la base de datos
		public function insertarAlimento($n, $e, $p, $hc, $f, $g) {

			$n = htmlspecialchars($n);
			$e = htmlspecialchars($e);
			$p = htmlspecialchars($p);
			$hc = htmlspecialchars($hc);
			$f = htmlspecialchars($f);
			$g = htmlspecialchars($g);

			$sql = "INSERT INTO alimentos (nombre, energia, proteina, hidratocarbono, fibra, grasatotal) VALUES ('".$n ."','".$e."','".$p."','".$hc."','".$f."','".$g."')";
			$result = $this->conexion->query($sql);

			return $result;

		}

		//Función para validar los campos
		public function validarDatos($n, $e, $p, $hc, $f, $g) {

			return (is_string($n) & is_numeric($e) & is_numeric($p) & is_numeric($hc) & is_numeric($f) & is_numeric($g));

		}

	}

?>