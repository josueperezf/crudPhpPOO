<?php 
class Routing{
	public static function controladorMetodos(){
		//creo array con los controladores posibles y sus metodos permitidos
		return
			[
			'bodega'=>[
						'index'=> 'GET',
						'create'=> 'GET',
						'store'=> 'POST',
						'edit'=> 'GET',
						'update'=> 'POST',
						'delete'=> 'GET',
					],
			'error'=>[
				'noEncontrado'=> 'GET',
			],
		];
	}
}