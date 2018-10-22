<?php ob_start() ?>

<table>
	<tr>
		<th>Alimento (por 100g)</th>
		<th>Energía (Kcal)</th>
		<th>Grasa (g)</th>
	</tr>

	<?php foreach ($params['resultado'] as $alimento): ?>

	<tr>
		<td><a href="index.php?action=ver&id=<?php echo $alimento['id']?>"><?php echo $alimento['nombre'] ?></a></td>
		<td><?php echo $alimento['energia']?></td>
		<td><?php echo $alimento['grasatotal']?></td>
	</tr>

	<?php endforeach; ?>

</table>

<form name="formBusqueda" action="index.php?action=ordenados" method="POST">
	<label for="orden">Ordenar por 
		<select name="ctc">
			<option value="nombre">Nombre</option>
			<option value="energia">Energía</option>
			<option value="grasatotal">Grasa</option>
		</select>
		en sentido
		<select name="tipo">
			<option value="ASC">Ascendente</option>
			<option value="DESC">Descendente</option>
		</select>
	</label>

	<input type="submit" value="buscar" />
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>