<? 
require("inc/incluidos.php");
require ("hd.php");

?>



<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">
<? require("topMenu.php"); ?>
    <div id="lateralIzq">
    <? 
		require("caja_misCursos.php");
		require("caja_glosarioPalabra.php");
		require("caja_mensajes.php");
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
    <? 		require("caja_bienvenida.php"); ?>
	<br>


	<?	require("caja_calendario.php");
	
	?>
    
    
    </div><!--lateralDer-->
    
    
    
    
    
	<div id="columnaCentro">
    
    	<div id="notificaciones" align="center">
		<? 
            require("evaluacionAprendizajesPuntajes.php");
        
        ?>	
        </div>
			
    </div> <!--columnaCentro-->


	<? 
    	
		require("pie.php");
		
    ?> 
</div> 
</body>
</html>
