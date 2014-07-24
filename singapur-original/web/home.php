<? 
require("inc/incluidos.php");
require ("hd.php");
include("inc/analyticstracking.php");

?>



<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">
<?
$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"];
require("_navegacion.php");
 require("topMenu.php"); ?>
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
