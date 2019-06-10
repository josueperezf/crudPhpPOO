<?php
if(!isset($paginacion)){
    exit();
}
    $buscar='';
    $page=0;
    $url=$paginacion['path'];
    $offset= 3;
    $campoOrdernar='id';
    $orderBy= 'desc';
    $pagination=[
        'total'			=> $paginacion['total'],
        'current_page'	=> $paginacion['current_page'],
        'per_page'		=> $paginacion['per_page'],
        'last_page'		=> $paginacion['last_page'],
        'from'			=> $paginacion['from'],
        'to'			=> $paginacion['to'],

    ];
?>

<hr>
	<h5 class='pull-left'> Mostrando desde el <?=$pagination['from']?> hasta el <?=$pagination['to']?>, de un total de <?=$pagination['total']?> de registros
	</h5>
	<ul class=' pagination' >
<?php
    if($pagination['current_page'] > 1){
		?>
		<li class=' waves-effect' >
			<?php

				$paginaA=$url.'&page='.($pagination['current_page'] - 1);
				//echo $paginaA;
			?>
				<a class='page-link'  href="#!"
				onclick="changePage('<?=$paginaA?>')"
				><span>Atras</span></a></li>
		<?php
	}
    if($pagination['to']){
		$from = $pagination['current_page'] - $offset;
		if($from < 1){$from = 1;} 
		$to = $from + ($offset * 2);
		if($to >= $pagination['last_page']){
			$to = $pagination['last_page'];}
			$pagesArray = [];
			while($from <= $to){
				$pagesArray[]= $from;
				$from++;
			}
			for($q=0;$q<count($pagesArray); $q++){
				$pagActva='';
				if($pagesArray[$q] == $pagination['current_page'])
					$pagActva='active';
                $paginaA=$url.'&page='.$pagesArray[$q];
				?>
				<li class=' <?=$pagActva?> '>
					<a class=' active' href="#!" onclick="changePage('<?=$paginaA?>')" >  <?php echo $pagesArray[$q];?> </a>
				</li>
				<?php
			}
	}
	if($pagination['current_page'] < $pagination['last_page']){
		$paginaA=$url.'&page='.($pagination['current_page'] + 1);
		?>
		<li class='page-item'><a class='page-link' href="#!" onclick="changePage('<?=$paginaA?>')" ><span>Siguiente</span></a></li>
		<?php
	}
	?>
	</ul>
	<script>
		campoOrdernar="<?= $paginacion['campoOrdernar'];?>";
		orderBy="<?= $paginacion['orderBy'];?>";
		ruta="<?= $url;?>";
		function ordenar(NuevocampoOrdernar){
			if(campoOrdernar==NuevocampoOrdernar){
                if(orderBy=='desc')
                    orderBy='asc';
                else
                    orderBy='desc';
            }else{
                campoOrdernar=NuevocampoOrdernar;
                orderBy='desc'
            }
			changePage(ruta);
		}
		function changePage(url){
			anexo='&campoOrdernar='+campoOrdernar+'&orderBy='+orderBy;
			url=url+anexo+'&busqueda='+document.getElementById('busqueda').value;
			libAjaxGet(url ,'divIndex');
		}
	</script>