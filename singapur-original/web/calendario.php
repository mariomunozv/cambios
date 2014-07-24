<? 
ini_set("display_errors","On");
require("inc/incluidos.php");
require ("hd.php");

?>

<body>
<div id="principal">
<? require("topMenu.php"); ?>
    <div id="lateralIzq">
    <? 
		//require("menuleft.php");
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
 
    
    <? 
		require("menuright.php");
	?>

    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
    
    	<p class="titulo_curso"><? //echo getNombreCurso($idCurso); ?></p>
  	    <? require("cal/calendarioDetalle.php");?>
        

		<? $datosEventos = getEventosProximosCurso(1); ?>
        <table class="tablesorter">
        <tr><th colspan="3">Eventos próximos</th></tr>
        <tr><th>Fecha</th><th>Titulo</th><th>Descripcion</th></tr>
            <? 	foreach ($datosEventos as $i => $value) { ?>
                <tr>
                    <? if ($value["nombreEvento"] == "No existen Eventos Proximos."){ ?>
                            <td colspan="3"><? 	echo $value["nombreEvento"];?></td>
                    <? }else{ ?>
                            <td><? echo cambiaf_a_normal($value["fechaEvento"]);?></td><td><? echo $value["nombreEvento"];?></td><td><? echo $value["descripcionEvento"];?></td>
                    <? 	} ?>
                </tr>	
            <?	}?>
        </table>
        
	</div>
    
	<? 
    	require("pie.php");    ?> 
   </div>     
</body>
</html>