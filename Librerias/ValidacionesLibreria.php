<?php
namespace Librerias;
class ValidacionesLibreria{
    public static function validacionTotal($arrayRequest=[],$parametros=[])
    {
        $data=['errors'=>[]];
        foreach ($parametros as $key => $value) {
            if( !array_key_exists($key,$arrayRequest)  ){
                $data['errors'][$key][]='faltan parametros';
            }
        }
        if(count($data['errors'])>0){
			$x=json_encode($data);
            header("HTTP/1.0 422 $x");
            return false;
        }
        foreach ($parametros as $key => $value) {
            if(count($value)==1){
                if($error=ValidacionesLibreria::validar($arrayRequest[$key], $value[0]) )
			    $data['errors'][$key][]= $key.': '.$error;
            }elseif(count($value)==2){
                if($error=ValidacionesLibreria::validar($arrayRequest[$key], $value[0],$value[1]) )
			    $data['errors'][$key][]= $key.': '.$error;
            }
        }
        if(count($data['errors'])>0){
			$x=json_encode($data);
            header("HTTP/1.0 422 $x");
            return false;
        }else{
            return true;
        }
    }
    public static function validar($valor='', $tipos=array(),$rango=array())
    {
        $formatos=array(
            'email'=>FILTER_VALIDATE_EMAIL,
            'entero'=>FILTER_VALIDATE_INT,
            'booleano'=>FILTER_VALIDATE_BOOLEAN,
            'flotante'=>FILTER_VALIDATE_FLOAT,
            'ip'=>FILTER_VALIDATE_IP,
            'url'=>FILTER_VALIDATE_URL,
            'rango'=>FILTER_VALIDATE_INT,
            'longitud'=>'longitud');
        foreach($tipos as $tipo)
        {
            if($tipo=='longitud')
            {
                $longitudVariable=strlen(trim($valor));
                if(($longitudVariable<$rango['inicio']) or ($longitudVariable>$rango['fin']))
                {
                    return 'longitud invalida';
                    exit();
                }
            }
            elseif($tipo=='rango')
            {
                if(isset($rango))
                {
                    if (filter_var($valor, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$rango['inicio'], "max_range"=>$rango['fin']))) === false) 
                    {
                    return 'No tiene el rango de valores permitidos';
                    exit();
                    }
                }
            }
            else
            {
                if(filter_var($valor, $formatos[$tipo]) === FALSE)
                {
                    return 'No tiene el formato de valores permitidos';
                    exit();
                }
            }
        }
        return false;
    }
    public static function mostrarError($variable='',$error=''){
        $data=['errors'=>[]];
        $data['errors'][$variable][]=$variable.': '.$error;
        if(count($data['errors'])>0){
			$x=json_encode($data);
            header("HTTP/1.0 422 $x");
            return false;
        }
    }
}
?>