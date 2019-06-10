<div class="container">
  <h2>Nueva Bodega</h2>
  <form name='form1' id='form1'  onsubmit="return addBodega()" method="POST">
    <div class="input-field">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control" id="nombre" name="nombre">
      <span class="helper-text" data-error=""  data-success="right" ></span>
    </div>
    <div class="input-field">
      <label for="text">Direccion</label>
      <input type="text" name="direccion" id='direccion' class="form-control">
      <span class="helper-text" data-error=""  data-success="right" ></span>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
</div>






