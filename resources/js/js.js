function addBodega(){
	if(chequear(document.getElementById('nombre')))
	if(chequearLogitud(document.getElementById('nombre'),2,100))
	if(chequear(document.getElementById('direccion')))
	if(chequearLogitud(document.getElementById('direccion'),6,200))
	{
		libAjax('form1','correr.php?controller=bodega&action=store','divModal' ,
		function(respuesta){
			if(respuesta==201){
				libAjaxGet('correr.php?controller=bodega&action=index','divIndex',function(){ });
				$('#modal1').modal('close');
				toastr.success("Operacion Exitosa");
			}
		});
	}
	return false;
}
function editBodega(){
	if(chequear(document.getElementById('id')))
	if(chequearEnteroPositivo(document.getElementById('id')))
	if(chequear(document.getElementById('nombre')))
	if(chequearLogitud(document.getElementById('nombre'),2,100))
	if(chequear(document.getElementById('direccion')))
	if(chequearLogitud(document.getElementById('direccion'),6,200))
	{
		libAjax('form1','correr.php?controller=bodega&action=update','divModal' ,
		function(respuesta){
			if(respuesta==200){
				//libAjaxGet('correr.php?controller=bodega&action=index','divIndex',function(){ });
				changePage("correr.php?controller=bodega&action=index");
				$('#modal1').modal('close');
				toastr.success("Operacion Exitosa");
			}
		});
	}
	return false;
}