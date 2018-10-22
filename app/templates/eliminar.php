<?php ob_start() ?>

<form name="formEliminar" action="index.php?action=eliminar" method="POST">
	<label for="nombre">nombre del alimento que quieres eliminar:</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo $params['nombre'] ?>" />

	<span>(puedes utilizar '%' como comodin)</span>
	<input type="submit" value="Eliminar" />
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 