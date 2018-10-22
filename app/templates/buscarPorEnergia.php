<?php ob_start() ?>

<form name="formBusqueda" action="index.php?action=buscarAlimentosPorEnergia" method="POST">
	<label for="energia">energia alimento:</label>
	<input type="number" name="energia" id="energia" value="<?php echo $params['energia'] ?>" />

	<span>(puedes utilizar '%' como comodin)</span>
	<input type="submit" value="buscar" />
</form>

<?php if (count($params['resultado']) > 0): ?>
	<table>
		<tr>
			<th>Alimento (por 100g)</th>
			<th>Energía (Kcal)</th>
			<th>Grasa (g)</th>
		</tr>

		<?php foreach ($params['resultado'] as $alimento) : ?>

		<tr>
			<td>
				<a href="index.php?action=ver&id=<?php echo $alimento['id'] ?>"><?php echo $alimento['nombre'] ?></a>
			</td>
			<td><?php echo $alimento['energia'] ?></td>
			<td><?php echo $alimento['grasatotal'] ?></td>
		</tr>
		
		<?php endforeach; ?>
	</table>

	<?php endif; ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 