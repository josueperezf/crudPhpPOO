<?php
namespace Model;
use Db;
class AppModel{
    public static function paginar($query){

        //buscar la url base que hace la llamada
        /*
        $ruta=$_SERVER['REQUEST_URI'];
		$buscaCortar='&action=';
		$pos = strpos($ruta, $buscaCortar);
		if(strpos($ruta, '&', $pos+1)){
			$desp=strpos($ruta, '&', $pos+1);
			$ruta = substr($ruta, 0, $desp);
        }
        */
        //fin de  busqueda de la url
        //busqueda de url limpia
        //esto es solo para esta estructura, xq correr.php no carga layout
        $QUERY_STRING_RUTA=$_SERVER['QUERY_STRING'];
		$buscaCortar='&action=';
		$pos = strpos($QUERY_STRING_RUTA, $buscaCortar);
		if(strpos($QUERY_STRING_RUTA, '&', $pos+1)){
			$desp=strpos($QUERY_STRING_RUTA, '&', $pos+1);
			$QUERY_STRING_RUTA = substr($QUERY_STRING_RUTA, 0, $desp);
        }

        $ruta='correr.php?'.$QUERY_STRING_RUTA;
        //fin de busqueda de url limpia
        $db=Db::getConnect();
        $busqueda='';
        $campoOrdernar='id';
        $orderBy='desc';
        $pagina=1;
        if(array_key_exists('busqueda',$_REQUEST))
            $busqueda=$_REQUEST['busqueda'];
        if(array_key_exists('campoOrdernar',$_REQUEST))
            $campoOrdernar=$_REQUEST['campoOrdernar'];
        if(array_key_exists('orderBy',$_REQUEST))
            $orderBy=$_REQUEST['orderBy'];
        if(array_key_exists('page',$_REQUEST))
            $pagina=$_REQUEST['page'];	
        if($pagina==0)
            $pagina=1;
        $pagina--;
        $sql= $query."
                        like '%$busqueda%' 
                    order by $campoOrdernar $orderBy
                    ";
        //echo $sql;
        $select=$db->query($sql);
        $total = $select->rowCount();
        //Define el número 0 para empezar a paginar multiplicado por la cantidad de resultados por página
        $cantidad_resultados_por_pagina = 10;
        //$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
        $final=$pagina* $cantidad_resultados_por_pagina;
        //$total_registros = pg_num_rows($resHMN);
        $total_registros=$total;
        $total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 
        $sql.="
        LIMIT $cantidad_resultados_por_pagina offset $final
        ";
        //echo $sql;
        //$resHMN=$conexHM->sentencia($sql);
        $select=$db->query($sql);
        //$porPagina=$total = $select->rowCount();
        $porPagina= $select->rowCount();

         //$porPagina = pg_num_rows($resHMN);
         if(!$porPagina)
            $porPagina=1;
        
        $data=array();
        
        foreach($select->fetchAll() as $reg){
            array_push($data, $reg);
        }
            $pagMostrar=$pagina+1;	
        $aux=array(
                'data'=>$data,
                'total'=>$total,
                'path'=>$ruta,
                'pagination'=>array(
                                    'path'=>$ruta,
                                    'current_page'=>$pagina++,
                                    'per_page'=>$porPagina,
                                    //ultima pagina
                                    'last_page'=>ceil($total / $cantidad_resultados_por_pagina),
                                    ),
                //pagina actual
                'current_page'=>$pagina++,
                'per_page'=>$porPagina,
                //ultima pagina
                'last_page'=>ceil(($total / $cantidad_resultados_por_pagina)),
                //mostrando desde
                'from'=>($pagMostrar*$cantidad_resultados_por_pagina)-$cantidad_resultados_por_pagina,
                //mostrando hasta
                'to'=>(($pagMostrar*$cantidad_resultados_por_pagina)-$cantidad_resultados_por_pagina)+count($data),
                'campoOrdernar'=>$campoOrdernar,
                'orderBy'=> $orderBy
            );
            //echo('<pre>');
        //echo json_encode( $aux);
        return $aux;
    }
}