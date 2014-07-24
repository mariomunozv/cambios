<div class="titulo_div">Eventos próximos</div>
<div class="info_div">
<? 
require("cal/calendario2.php");
$idCurso = $_SESSION["sesionIdCurso"];
?>
 
<?
//$datosEventos = getEventosProximosCurso(1);
$datosEventos = getTodosEventosProximos();
?>

<ul>
	<? 
		foreach ($datosEventos as $i => $value) { 
			if ($value["nombreEvento"] == "No existen Eventos Proximos."){ ?>
    			<li><? 	echo $value["nombreEvento"];?></li>
    <?		}else{
    
    ?>
    			<li>
                <p align="left">
                <strong>
                <? echo cambiaf_a_normal($value["fechaEvento"]);?>: </strong><? echo $value["nombreEvento"];?>
				</p>
                </li>
    <? 
			} 
		}
	?>
    </ul>
</div>      
