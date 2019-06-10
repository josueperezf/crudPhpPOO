$(document).ready(function(e)
{
	toastr.options = {
		"closeButton": true,
		"debug": true,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": true,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "2000",
		"extendedTimeOut": "4000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
		};
	});
//libreria para el manejo de ajax ENVIO TOODA la data del formulario

function libAjax(formulario,url,divActualizar,callback=null)
{
	var respuesta='';
	var estatus=0;
	var parametros= $('#'+formulario+'').serialize();
	$.ajax({
			data:  parametros,
			url:   url,
			type:  'POST',
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			beforeSend: function(){
				//$("#"+divActualizar+"").html("<div align='center' ><img src='../Imagenes/142car.gif'></div>");
				},
			success:  function (response,textStatus, status) {
				respuesta=response;
				estatus=status.status;
					//$("#"+divActualizar+"").html(response);
			},
			error:function(e){
				//console.log(e);
				
				mostrarErrors(e);
				//console.log('tiene error');
			}
			
	}).done(function(){
		$("#"+divActualizar+"").html(respuesta);
		if(callback){
			callback(estatus);
		}
			
	});
}



function libAjaxGet(url,divActualizar,callback=null)
{
	var respuesta='';
	var estatus=0;
	$.ajax({
			url:   url,
			type:  'GET',
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			beforeSend: function(){
				//$("#"+divActualizar+"").html("<div align='center' ><img src='../Imagenes/142car.gif'></div>");
				},
			success:  function (response,textStatus, status) {
				respuesta= response;
				estatus=status.status;
			},
			error:function(e){
				mostrarErrors(e);
			}
	}).done(function(){
		$("#"+divActualizar+"").html(respuesta);
		if(callback){
			callback(estatus);
		}
	});
}


/*
function libAjaxGet(url,divActualizar,callback=null)
{
	$.get(url, function( data ) {
		$( "#"+divActualizar).html( data );

	}).done(function(){
		if(callback){
			callback();
		}
	});

}
*/
function mostrarErrors(e)
{

	if(e.status==422){
		//esta parte la hice porque no supe como enviar datos cuando envio estatus 422
		var p=JSON.parse(e.statusText);
		var resp=p;
	}else{
		var resp=e.responseJSON;
	}
	
	var texto="";
	$('form input').removeClass('invalid');
	$('form div .helper-text').attr({'data-error':""});
	if((e.status==0)|| (e.status >= 500))
	{
		toastr.error("Error de servidor");
	}else if (e.status == 401) 
	{
			toastr.error("Usuario no autenticado");
			location.reload();
		}else if ((e.status >= 402) && (e.status <= 403)) 
	{
		toastr.error("Acceso denegado");
	}
		else if(e.status == 404)
	{
		toastr.error("Solicitud no encontrada en servidor");
		}
	else if((e.status > 404) && (e.status < 452))
	{
		String.prototype.replaceAll = function(search, replacement)
		{
			var target = this;
			return target.split(search).join(replacement);
		};
		var auxiliar='';
		for (var i in resp.errors)
		{
			auxiliar=resp.errors[i][0];
			auxiliar = auxiliar.replaceAll(' id ', ' ');
			$('#'+i+'').addClass('invalid');
			$('#'+i+'').parent().find('.helper-text').attr({'data-error':auxiliar});
		texto=texto+' '+auxiliar+'<br>';
		//console.log(resp.errors[i][0]);
		}
		toastr.error(texto);
	}
}




function trim(cadena)
{
	for(i=0; i<cadena.length; )
	{
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(i+1, cadena.length);
		else
			break;
	}

	for(i=cadena.length-1; i>=0; i=cadena.length-1)
	{
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(0,i);
		else
			break;
	}
	return cadena;
}
function chequearEntero(k){
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
    if (isNaN(k.value)){
		//no es numero
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Este campo debe contener numeros enteros"});
		return false;
    }
    else{
        if (k.value % 1 == 0) {
            //Es un numero entero
			return true;
        }
        else{
			//window.location.reload(true);
			$('#'+k.id+'').addClass('invalid');
			$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Este campo debe contener numeros enteros"});
			return false;
        }
    }
}
function chequearEnteroPositivo(k){
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
    if (isNaN(k.value)){
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Este campo debe contener numeros enteros"});
		return false;
    }
    else{
        if (k.value % 1 == 0) {
			if(k.value<0){
				$('#'+k.id+'').addClass('invalid');
				$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Este campo debe contener numeros enteros y positivos"});
				return false;
			}
            //Es un numero entero
			return true;
        }
        else{
			//window.location.reload(true);
			$('#'+k.id+'').addClass('invalid');
			$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Este campo debe contener numeros enteros"});
			return false;
        }
    }
}

function chequearLogitud(k,inicio,fin)
{
	$('#'+k.id+'').removeClass('is-invalid');
	$('#'+k.id+'').parent().find('.invalid-feedback').text('');
	if((k.value.length>=inicio) && (k.value.length<=fin))
	{
		//document.getElementById("mensaje").innerHTML='';
		return true;
	}else
	{
		$('#'+k.id+'').addClass('is-invalid');
		$('#'+k.id+'').parent().find('.invalid-feedback').text('Este campo debe contener Minimo '+inicio+', maximo '+fin +' caracteres. Logitud actual '+k.value.length);
		k.focus();
		return false;
	}
}
//usado para verificar los campos vacios
function chequear(k)
{
	$('#'+k.id+'').removeClass('is-invalid');
	$('#'+k.id+'').parent().find('.invalid-feedback').text('');

	String.prototype.replaceAll = function(search, replacement)
	{
    	var target = this;
    	return target.split(search).join(replacement);
	};
	
	//document.getElementById(k.id).value=trim(document.getElementById(k.id).value);
	cadena = trim(document.getElementById(k.id).value);
	cadena = cadena.replace(/(^\s*)|(\s*$)/g,""); 
	cadena = cadena.replaceAll('{', '');
	cadena = cadena.replaceAll('}', '');
	cadena = cadena.replaceAll('[', '');
	cadena = cadena.replaceAll(']', '');
	cadena = cadena.replaceAll('"', '');
	cadena = cadena.replaceAll('--', '');
	cadena = cadena.replaceAll('#', '');
	cadena = cadena.replaceAll('&', '');
	cadena = cadena.replaceAll('%', '');
	cadena = cadena.replaceAll('(', '');
	cadena = cadena.replaceAll(')', '');
	cadena = cadena.replaceAll('\\', '');
	cadena = cadena.replaceAll("'", '');
	cadena = cadena.replaceAll("||", '');
	cadena = cadena.replaceAll(" OR ", '');
	cadena = cadena.replaceAll("^", '');
	cadena = cadena.replaceAll("$", '');
	
	document.getElementById(k.id).value=cadena;
	if(cadena.length==0)
	{
		$('#'+k.id+'').addClass('is-invalid');
		$('#'+k.id+'').parent().find('.invalid-feedback').text('No debe estar Vacio');
	 k.focus();
	 return false;
	}else{
		//document.getElementById("mensaje").innerHTML='';
		return true;
	}
}//fin de funcion chequear

function comparar(k,j)
{
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
	$('#'+j.id+'').removeClass('invalid');
	$('#'+j.id+'').parent().find('.helper-text').attr({'data-error':""});
	if( k.value!=j.value)
	{
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Los valores introducidos deben ser iguales"});
		$('#'+j.id+'').addClass('invalid');
		$('#'+j.id+'').parent().find('.helper-text').attr({'data-error':"Los valores introducidos deben ser iguales"});
		k.focus();
		 return false;
  }else{
		//document.getElementById("mensaje").innerHTML="";
		return true;
	  }
}
function chequearEnMinuscula(k)
{
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
	cadena = k.value;
	cadena = cadena.replace(/(^\s*)|(\s*$)/g,""); 

	if(cadena.length==0)
	{
		//document.getElementById("mensaje").innerHTML='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Existen campos obligatorios vacios</div>';
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"No debe estar Vacio"});
	 	k.focus();
	 	return false;
	}else{
		//document.getElementById("mensaje").innerHTML='';
		return true;
	}
}//fin de funcion chequear
//SELECCIONAR ELEMENTOS DE LA LISTA
function chequearSelect(k)
{
	$('#'+k.id+'').removeClass('is-invalid');
	$('#'+k.id+'').parent().find('.invalid-feedback').text('');
	if(k.value==0)
	{
		//document.getElementById("mensaje").innerHTML='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Lo Sentimos: algun elemento de la lista debe ser seleccionado</div>';
		$('#'+k.id+'').addClass('is-invalid');
		$('#'+k.id+'').parent().find('.invalid-feedback').text('Algun elemento de la lista debe ser seleccionado');
	 	k.focus();
	 	return false;
		}else{
			//document.getElementById("mensaje").innerHTML="";
			return true;
	}		
}
function chequearTexto(k)
{
	//usado para verificar  que la cadena solo texto
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
	document.getElementById(k.id).value = k.value.toUpperCase();
	document.getElementById(k.id).value=trim(document.getElementById(k.id).value);

	if(!isNaN(k.value))
	{
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Este campo no debe contener solo texto"});
		k.focus();
		return false;
	
	}else{
		//document.getElementById("mensaje").innerHTML="";
		return true;
	}
}

function chequearTelef(k)
{
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
	if( !(/^\d{4}-\d{7}$/.test(k.value)) )
	{
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"telefono invalido, formato es: 0000-0000000"});
		k.focus();
		return false;
  }else{
		//document.getElementById("mensaje").innerHTML="";
		return true;
	  }
}
function validarEmail(theElement)
{
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
	var evaluar = theElement.value;
	var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	if (filter.test(evaluar))
	{
		//document.getElementById("mensaje").innerHTML="";
		return true;}
	else{
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"Lo Sentimos: Correo electronico invalido"});
		//document.getElementById("mensaje").innerHTML='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Lo Sentimos: Correo electronico invalido</div>'
		//"<font color='#FF0000'><img src='images/inactivo.PNG' width='14' height='12'>Lo Sentimos: Correo electronico invalido</font>";
	theElement.focus();
	return false;}
}

function chequearNumero(k)
{
	$('#'+k.id+'').removeClass('is-invalid');
	$('#'+k.id+'').parent().find('.invalid-feedback').text('');
	if(k.value<0)
	{
		$('#'+k.id+'').addClass('is-invalid');
		$('#'+k.id+'').parent().find('.invalid-feedback').text('Valor invalido');
		//document.getElementById("mensaje").innerHTML="<font color='#FF0000'><img src='images/inactivo.PNG' width='14' height='12'>Este campo Invalido</font>";
		k.focus();
		return false;
	}
	else{
		//document.getElementById("mensaje").innerHTML="";
		return true;}
}
function buscarPuntos(k)
{
	$('#'+k.id+'').removeClass('invalid');
	$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':""});
	var busca='.';
	if(k.value.indexOf(busca)>0)
	{
		$('#'+k.id+'').addClass('invalid');
		$('#'+k.id+'').parent().find('.helper-text').attr({'data-error':"debe poseer Numeros sin puntos."});
		//document.getElementById("mensaje").innerHTML="<font color='#FF0000'><img src='images/inactivo.PNG' width='14' height='12'>Este campo debe poseer solo Numeros, no puede contener puntos.</font>";
		k.focus();
		return false;
	}
	else{
		//document.getElementById("mensaje").innerHTML="";
		return true;
		}
}

function ocultar(div)
{
  		$( "#"+div+"").hide('explode');
}




function chequearCheckbox()
{
	var sAux="";
	var frm = document.getElementById("form");
	var control=false;
	for (i=0;i<frm.elements.length;i++)
	{
		if(frm.elements[i].type=='checkbox'){
			if(frm.elements[i].checked==true)
			{
				control=true;
			}
		}
	}
	if(control==false)
	{
		document.getElementById("mensaje").innerHTML='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Debe seleccionar al menos un documento para el Grado</div>';
		return false;
	}else
	{
		document.getElementById("mensaje").innerHTML='';
		return true;
	}
}
