<? 
require("inc/incluidos.php");
require ("hd.php");

?>



<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">
<? 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Notificaciones*#";	
	require("_navegacion.php");
?>
    <div id="lateralIzq">
    	<? require("menuleft.php");?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
	    <? require("menuright.php");?>
    </div><!--lateralDer-->
    
    
    
    
    
	<div id="columnaCentro">
    
    	<div id="notificaciones" align="center">
		<? 
            require("notificaciones.php");
        
        ?>	
        </div>
			
    </div> <!--columnaCentro-->


	<? 
    	
		require("pie.php");
		
    ?> 
</div> 
</body>
</html>
