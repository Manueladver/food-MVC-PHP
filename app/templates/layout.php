<!DOCTYPE html>

	<html lang="es">

		<head>
			<meta charset="utf-8">
			<title>Desarrollo web en entorno servidor - tema 10 - MVC</title>
			<link rel="stylesheet" href="<?php echo'css/'.Config::$mvc_vis_css ?>"/>
		</head>

		<body>

			<header>
				<h1>Información de alimentos</h1>
			</header>

			<nav>
				<ul>
					<li><a href="index.php?action=inicio">Inicio</a></li>
					<li><a href="index.php?action=listar">Ver alimentos</a></li>
					<li><a href="index.php?action=ordenados">Ver alimentos ordenados</a></li>
					<li><a href="index.php?action=insertar">Insertar alimento</a></li>
					<li><a href="index.php?action=buscar">Buscar por nombre</a></li>
					<li><a href="index.php?action=buscarAlimentosPorEnergia">Buscar por energía</a></li>
					<li><a href="index.php?action=combinada">Búsqueda combinada</a></li>
					<li><a href="index.php?action=eliminar">Eliminar por nombre</a></li>

				</ul>
			</nav>
			
			<main>
				<?php echo $contenido ?>
			</main>

			<footer id="pie">
				<p>- DWES -</p>
			</footer>

		</body>

	</html>