<?php
namespace Model;
use Db;
class Bodega extends AppModel
{
	private $id;
	private $nombre;
	private $direccion;
	private $estatus;
	
	function __construct($id=null, $nombre=null,$direccion=null, $estatus=0)
	{
		$this->setId($id);
		$this->setNombre($nombre);
		$this->setDireccion($direccion);
		$this->setEstatus($estatus);
	}
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getDireccion(){
		return $this->direccion;
	}

	public function setDireccion($direccion){
		$this->direccion = $direccion;
	}

	public function getEstatus(){

		return $this->estatus;
	}

	public function setEstatus($estatus=1){
		
		$this->estatus = $estatus;
	}
	public static function paginacion(){
		$sql="select * from bodegas where concat(nombre, ' ',direccion,' ',
		case
			when (estatus) = '1' then 'ACTIVO'
			when (estatus) = '0' then 'INACTIVO'
		end) ";
		return parent::paginar($sql);
	}
	/*
	public static function save($bodega){
		$db=Db::getConnect();

		$insert=$db->prepare('INSERT INTO bodegas VALUES (NULL, :nombre,:direccion,:estatus)');
		$insert->bindValue('nombre',$bodega->getNombre());
		$insert->bindValue('direccion',$bodega->getDireccion());
		$insert->bindValue('estatus',$bodega->getEstatus());
		$insert->execute();
	}*/
	public function save(){
		$db=Db::getConnect();
		$insert=$db->prepare('INSERT INTO bodegas VALUES (NULL, :nombre,:direccion,:estatus)');
		$insert->bindValue('nombre',$this->getNombre());
		$insert->bindValue('direccion',$this->getDireccion());
		$insert->bindValue('estatus',$this->getEstatus());
		$insert->execute();
	}
	public static function find($query=null){
		$db=Db::getConnect();
		$bodegas=[];
		if(!$query)
			$select=$db->query('SELECT * FROM bodegas order by id desc');
		else{
			$select=$db->query("SELECT * FROM bodegas as b where $query order by b.id desc");
		}
		foreach($select->fetchAll() as $bodega){
			$bodegas[]=new Bodega($bodega['id'],$bodega['nombre'],$bodega['direccion'],$bodega['estatus']);
		}
		return $bodegas;
	}
	/*
	public static function update($bodega){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE bodegas SET nombre=:nombre, direccion=:direccion, estatus=:estatus WHERE id=:id');
		$update->bindValue('nombre', $bodega->getNombre());
		$update->bindValue('direccion',$bodega->getDireccion());
		$update->bindValue('estatus',$bodega->getEstatus());
		$update->bindValue('id',$bodega->getId());
		$update->execute();
	}
	*/
	public function update(){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE bodegas SET nombre=:nombre, direccion=:direccion, estatus=:estatus WHERE id=:id');
		$update->bindValue('nombre', $this->getNombre());
		$update->bindValue('direccion',$this->getDireccion());
		$update->bindValue('estatus',$this->getEstatus());
		$update->bindValue('id',$this->getId());
		$update->execute();
	}
	public static function delete($id){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE  FROM bodegas WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>