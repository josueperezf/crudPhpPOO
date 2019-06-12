<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	// es ajax
	}
	else{
		?>
		<div class="container">
			<h2>Bodegas</h2>
			<button class="waves-effect waves-light btn modal-trigger"  href="#modal1" onClick="$('.modal').modal();libAjaxGet('correr.php?controller=bodega&action=create','divModal',function(){ })">
				Nuevo
			</button>
			<div class="input-field">
      			<label for="text">Busqueda</label>
				<input class="form-control" id="busqueda" name='busqueda' name="id" type="text" onkeyup="libAjaxGet('correr.php?controller=bodega&action=index&busqueda='+this.value ,'divIndex',function(){}) ">
			</div>
		</div>
		<?php
	}
?>
<div id='divIndex'>
	<div class="container">
		<div class="table-responsive">
			<table class="table table-hover responsive-table highlight striped">
				<thead>
					<tr>
						<th onclick="ordenar('id')">Id</th>
						<th onclick="ordenar('nombre')">Nombre</th>
						<th onclick="ordenar('direccion')">Direccion</th>
						<th onclick="ordenar('estatus')">Estatus</th>
						<th>Accion</th>
					</tr>
					<tbody>
						<?php foreach ($bodegas as $bodega) {?>
						<tr>
							<td><?php echo $bodega['id']; ?> </td>
							<td><?php echo $bodega['nombre']; ?></td>
							<td><?php echo $bodega['direccion']; ?></td>
							<td>
								<?php if ( $bodega['estatus']==1):?>
									ACTIVO
								<?php  else:?>
									INACTIVO
								<?php endif; ?></td>
							<td>
							<button class="waves-effect waves-light btn modal-trigger"  href="#modal1" onClick="$('.modal').modal();libAjaxGet('correr.php?controller=bodega&action=edit&id=<?php echo $bodega['id'] ?>','divModal',function(){})">
								Editar
							</button>
								<a class='waves-effect waves-light btn red' href="?controller=bodega&action=delete&id=<?php echo $bodega['id'] ?>">Eliminar</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>

				</thead>
			</table>
			<?php
				require_once('Views/Helpers/paginacion.php');
			?>
		</div>
	</div>
</div>