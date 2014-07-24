<? 
require("inc/incluidos.php");
//echo $_SESSION["sesionIdCurso"];
require ("hd.php");

?>

<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">
<? 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Participantes*#";	
	require("_navegacion.php");
	$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
?>

    <div id="lateralIzq">
    <? 
		require("menuleft.php"); 
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
    <? 		require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
    
    
    
	<div id="columnaCentro">
    
    	<div id="notificaciones" align="center">
		<? 
            require("alumnosCurso.php");
        
        ?>	
        </div>
			
    </div> <!--columnaCentro-->


	<? 
    	
		require("pie.php");
		
    ?> 
</div>
</body>
</html>
