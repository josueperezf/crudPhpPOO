<?php 
use Model\Bodega;
use Librerias\ValidacionesLibreria;
class BodegaController
{
	function __construct()
	{
		
	}

	function index(){
		$sql="select * from bodegas where concat(nombre, ' ',direccion,' ',
		case
			when (estatus) = '1' then 'ACTIVO'
			when (estatus) = '0' then 'INACTIVO'
		end) ";
		$paginacion=Bodega::paginar($sql);
		$bodegas=$paginacion['data'];
		require_once('Views/Bodega/index.php');
	}

	function create(){
		require_once('Views/Bodega/create.php');
	}

	function store(){
		//valido los campos que llegan por metodo post 
		if(!ValidacionesLibreria::validacionTotal($_POST,
			[
				'nombre'=>[array('longitud'),array('inicio'=>3,'fin'=>'100')],
				'direccion'=>[array('longitud'),array('inicio'=>3,'fin'=>'100')],
			])
		){
			exit();
		}
		$nombre=strtoupper(trim($_POST['nombre']));
		$direccion=strtoupper(trim($_POST['direccion']));
		//valido sino exite otra bodega con el mismo nombre
		$bodega=Bodega::find("b.nombre='$nombre'");
		if(count($bodega)>0){
			//nombre repetido
			ValidacionesLibreria::mostrarError('nombre', 'Ya existe un elemento con este valor');
			exit();
		}

		$bodega= new Bodega(null, $nombre,$direccion,'1');
		$bodega->save($bodega);
		http_response_code(201);
		//header('Location: '.'?controller=bodega&action=index');
	}

	function edit(){
		
		$id=$_GET['id'];
		$bodega=Bodega::find("b.id=$id");
		$bodega=$bodega[0];
		if(!$bodega)
			header('Location: '.'correr.php?controller=error&action=noEncontrado');
		require_once('Views/Bodega/edit.php');
	}

	function update(){
		//valido los campos que me envian
		if(!ValidacionesLibreria::validacionTotal($_POST,
			[
				'id'=>[array('entero')],
				'nombre'=>[array('longitud'),array('inicio'=>3,'fin'=>'100')],
				'direccion'=>[array('longitud'),array('inicio'=>3,'fin'=>'100')],
			])
		){
			exit();
		}
		$estatus=1;
		if (!isset($_POST['estatus']))
			$estatus=0;
		$id=$_POST['id'];
		//le quito los espacios en blanco y coloco todo en mayuscula
		$nombre=strtoupper(trim($_POST['nombre']));
		$direccion=strtoupper(trim($_POST['direccion']));
		//busco en base de datos si ese id existe
		$bodega=Bodega::find("b.id=$id");
		$bodega=$bodega[0];
		if(!$bodega){
			header('Location: '.'correr.php?controller=error&action=noEncontrado');
			exit();
		}
		//busco si el nombre esta repetido
		$bodega=Bodega::find("b.id!=$id and  b.nombre='$nombre'");
		if(count($bodega)>0){
			//nombre repetido
			ValidacionesLibreria::mostrarError('nombre', 'Ya existe un elemento con este valor');
			exit();
		}
		$bodega = new Bodega($_POST['id'],$nombre,$direccion,$estatus);
		Bodega::update($bodega);
		http_response_code(200);
		//$this->show();
		//header('Location: '.'?controller=bodega&action=index');

	}
	function delete(){
		if(!ValidacionesLibreria::validacionTotal($_GET,
			[
				'id'=>[array('entero')],
			])
		){
			exit();
		}
		$id=$_GET['id'];
		//busco si el id pasado existe en la base de datos
		$bodega=Bodega::find("b.id=$id");
		if(count($bodega)==0){
			header('Location: '.'?controller=bodega&action=index');
			exit();
		}
		//como la funcion find me retorna un array, tomo solo el primero q es el unico q retornara
		$bodega=$bodega[0];
		$bodega->delete($bodega->getId());
		//$this->show();
		header('Location: '.'?controller=bodega&action=index');
	}

	function search(){
		if (!empty($_POST['id'])) {
			$id=$_POST['id'];
			$bodega=Bodega::find(" b.id=$id");
			$bodegas=$bodega;
			//var_dump($id);
			//die();
			require_once('Views/Bodega/index.php');
		} else {
			$bodegas=Bodega::find();
			require_once('Views/Bodega/index.php');
		}
	}
}
?>