function addBodega(){
	libAjax('form1','correr.php?controller=bodega&action=store','divModal' ,
	function(respuesta){
		if(respuesta==201){
			libAjaxGet('correr.php?controller=bodega&action=index','divIndex',function(){ });
			$('#modal1').modal('close');
			toastr.success("Operacion Exitosa");
		}
	});
	return false;
}
function editBodega(){
	libAjax('form1','correr.php?controller=bodega&action=update','divModal' ,
	function(respuesta){
		if(respuesta==200){
			//libAjaxGet('correr.php?controller=bodega&action=index','divIndex',function(){ });
			changePage("correr.php?controller=bodega&action=index");
			$('#modal1').modal('close');
			toastr.success("Operacion Exitosa");
		}
	});
	return false;
}
/*

function indexBodega(){
	prueba2= new Paginador('vista/bodega_json.php', 'datos',function(data){
		tablaBody=$('#datos');
		data=data.data;
        for(let i=0; i<data.length;i++){
			let informacion=data[i];
			let htlm=`<tr>
			<td>`+informacion.id+`</td>
			<td>`+informacion.nombre+`</td>
			<td>`+informacion.direccion+`</td>
            <td>`+informacion.estatus+`</td>`;
            if(informacion.estatus=='ACTIVO'){
                htlm+=`<td>
                    <a href='#modal' class='btn  btn-sm  btn btn-info' data-toggle='modal' data-target='#exampleModalLong '  onClick=libAjaxGet('controlador.php?opt=viewStockBod&id=`+informacion.id+`/','divModal') >Ver Stock </a> 
                    <a href='#modal' class='btn  btn-sm  btn btn-info' data-toggle='modal' data-target='#exampleModalLong '  onClick=libAjaxGet('controlador.php?opt=editBod&id=`+informacion.id+`/','divModal') >Editar </a> 
                    <a href='#modal' class='btn  btn-sm  btn btn-danger' onClick=cambioEstatusBodega(`+informacion.id+`,'0') >Eliminar </a>
                </td>`;
            }
            if(informacion.estatus=='INACTIVO'){
                htlm+=`<td>
                    <a href='#modal' class='btn  btn-sm  btn btn-primary' onClick=cambioEstatusBodega(`+informacion.id+`,'1') >Restaurar </a>
                </td>`;
            }
		    htlm+=`</tr>`;
			tablaBody.append(htlm);
		}
	});
	prueba2.listar();
}
function addBodega(){
    if(chequear(document.getElementById('nombre')))
	if(chequearLogitud(document.getElementById('nombre'),2,100))
	if(chequear(document.getElementById('direccion')))
	if(chequearLogitud(document.getElementById('direccion'),6,200))
	{
		libAjax('form1','/bodega/controlador.php?opt=storeBod','divModal' ,function()
		{
			prueba2.listar();
			$('.modal').modal('hide');
			toastr.success('Operacion Exitosa');
		})	
    }
	return false;
}
function editBodega(){
    if(chequear(document.getElementById('nombre')))
	if(chequearLogitud(document.getElementById('nombre'),2,100))
	if(chequear(document.getElementById('direccion')))
	if(chequearLogitud(document.getElementById('direccion'),6,200))
	{
		libAjax('form1','/bodega/controlador.php?opt=updateBod','divModal' ,function()
		{
			prueba2.listar();
			$('.modal').modal('hide');
			toastr.success('Operacion Exitosa');
		})	
    }
	return false;
}
function cambioEstatusBodega(id,estatus){
    document.getElementById('id').value=id;
    document.getElementById('estatus').value=estatus;
    libAjax('form2','/bodega/controlador.php?opt=cambioEstatusBodega','divModal' ,function()
    {
        prueba2.listar();
        toastr.success('Operacion Exitosa');
    })
}

function indexProducto(){
	prueba2= new Paginador('vista/producto_json.php', 'datos',function(data){
		tablaBody=$('#datos');
		data=data.data;
        for(let i=0; i<data.length;i++){
			let informacion=data[i];
			let htlm=`<tr>
			<td>`+informacion.id+`</td>
			<td>`+informacion.codigo+`</td>
			<td>`+informacion.nombre+`</td>
			<td>`+informacion.marca_nombre+`</td>
			<td>`+informacion.detalle_unidad_medida_nombre+`</td>
			<td>`+informacion.stock_minimo+`</td>
            <td>`+informacion.estatus+`</td>`;
            if(informacion.estatus=='ACTIVO'){
                htlm+=`<td>
                    <a href='#modal' class='btn  btn-sm  btn btn-info' data-toggle='modal' data-target='#exampleModalLong '  onClick=libAjaxGet('controlador.php?opt=editPro&id=`+informacion.id+`','divModal') >Editar </a> 
                    <a href='#modal' class='btn  btn-sm  btn btn-danger' onClick=cambioEstatusProducto(`+informacion.id+`,'0') >Eliminar </a>
                </td>`;
            }
            if(informacion.estatus=='INACTIVO'){
                htlm+=`<td>
                    <a href='#modal' class='btn  btn-sm  btn btn-primary' onClick=cambioEstatusProducto(`+informacion.id+`,'1') >Restaurar </a>
                </td>`;
            }
		    htlm+=`</tr>`;
			tablaBody.append(htlm);
		}
	});
	prueba2.listar();
}

function addProducto(){
    if(chequearSelect(document.getElementById('catalogo_id')))
    if(chequearSelect(document.getElementById('denominacion_id')))
	if(chequearSelect(document.getElementById('unidad_medida_id')))
	if(chequearSelect(document.getElementById('detalle_unidad_medida_id')))
	if(chequearSelect(document.getElementById('marca_id')))
	if(chequear(document.getElementById('codigo')))
	if(chequearLogitud(document.getElementById('codigo'),2,50))
	if(chequear(document.getElementById('stock_minimo')))
	{
		libAjax('form1','/bodega/controlador.php?opt=storePro','divModal' ,function()
		{
			prueba2.listar();
			$('.modal').modal('hide');
			toastr.success('Operacion Exitosa');
		})	
	}
	return false;
}

function editProducto(){
    if(chequearSelect(document.getElementById('catalogo_id')))
    if(chequearSelect(document.getElementById('denominacion_id')))
	if(chequearSelect(document.getElementById('unidad_medida_id')))
	if(chequearSelect(document.getElementById('detalle_unidad_medida_id')))
	if(chequearSelect(document.getElementById('marca_id')))
	if(chequear(document.getElementById('codigo')))
	if(chequearLogitud(document.getElementById('codigo'),2,50))
	if(chequear(document.getElementById('stock_minimo')))
	{
		libAjax('form1','/bodega/controlador.php?opt=updatePro','divModal' ,function()
		{	
			prueba2.listar();
			$('.modal').modal('hide');
			toastr.success('Operacion Exitosa');
		})	
	}
	return false;
}
function cambioEstatusProducto(id,estatus){
    document.getElementById('id').value=id;
    document.getElementById('estatus').value=estatus;
    libAjax('form2','/bodega/controlador.php?opt=cambioEstatusProducto','divModal' ,function()
    {
        prueba2.listar();
        toastr.success('Operacion Exitosa');
    })
}
//inicio movimiento
function indexMovimiento(){
	prueba2= new Paginador('vista/movimiento_json.php', 'datos',function(data){
		tablaBody=$('#datos');
		data=data.data;
        for(let i=0; i<data.length;i++){
			let informacion=data[i];
			let htlm=`<tr>
			<td>`+informacion.id+`</td>
			<td>`+informacion.tipo_movimiento_nombre+`</td>
			<td>`+informacion.detalle_tipo_movimiento_nombre+`</td>
			<td>`+informacion.fecha+`</td>
			<td>`+informacion.bodega_nombre+`</td>`;
                htlm+=`<td>
                    <a href='#modal' class='btn  btn-sm  btn btn-info' data-toggle='modal' data-target='#exampleModalLong '  onClick=libAjaxGet('controlador.php?opt=showMov&id=`+informacion.id+`','divModal') >Ver Productos relacionados</a> 
                </td>`;
		    htlm+=`</tr>`;
			tablaBody.append(htlm);
		}
	});
	prueba2.listar();
}

function addMovimiento(){
    if(chequearSelect(document.getElementById('bodega_id')))
    if(chequearSelect(document.getElementById('detalle_tipo_movimiento_id'))){
		if(document.getElementById('indiceFila').value>0)
		{
			libAjax('form1','/bodega/controlador.php?opt=storeMov','divModal' ,function()
			{
				prueba2.listar();
				$('.modal').modal('hide');
				toastr.success('Operacion Exitosa');
			})	
		}else{
			toastr.error('Debe agregar Productos para cargar al almacen');
			document.getElementById('codigo_buscar').focus();

		}
	}
	return false;
}
//fin movimiento


*/