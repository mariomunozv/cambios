<? 
require("inc/incluidos.php");
//echo $_SESSION["sesionIdCurso"];
require ("hd.php");
?>

<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">

<? require("topMenu.php"); ?>

<?
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
            require("alumnosCurso2.php");
        
        ?>	
        </div>
			
    </div> <!--columnaCentro-->


	<? 
    	
		require("pie.php");
		
    ?> 
</div>
</body>
</html>
