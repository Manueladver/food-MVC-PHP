<?php ob_start() ?>

<table>
	<tr>
		<th>Alimento (por 100g)</th>
		<th>Energía (Kcal)</th>
		<th>Grasa (g)</th>
	</tr>

	<?php foreach ($params['alimentos'] as $alimento): ?>

	<tr>
		<td><a href="index.php?action=ver&id=<?php echo $alimento['id']?>"><?php echo $alimento['nombre'] ?></a></td>
		<td><?php echo $alimento['energia']?></td>
		<td><?php echo $alimento['grasatotal']?></td>
	</tr>

	<?php endforeach; ?>

</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>