<div class="container">
	<h2>Actualizar Bodega</h2>
	<form action="?controller=bodega&action=update" name='form1' id='form1' method="POST" onsubmit="return editBodega()">
		<input type="hidden" name="id" id='id' value="<?php echo $bodega->getId() ?>" >
		<div class="form-group">
			<label for="text">Nombres</label>
			<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $bodega->getNombre() ?>">
			<span class="helper-text" data-error=""  data-success="right" ></span>
		</div>
		<div class="form-group">
			<label for="text">Direccion</label>
			<input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $bodega->getDireccion(); ?>">
			<span class="helper-text" data-error=""  data-success="right" ></span>
		</div>
		<div class="form-group">
			<label for="estatus">
				<input type="checkbox" id='estatus' name="estatus" <?php if($bodega->getEstatus()) echo 'checked' ?> />
				<span>Activo</span>
			</label>
		</div><br>
		<button type="submit" class="btn btn-primary">Actualizar</button>

	</form>
</div>