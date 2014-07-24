<? 
require("inc/incluidos.php");
require ("hd.php");
?>
<meta charset="iso-8859-1">
<body>
<div id="principal">
<? 
	require("topMenu.php"); 
	$navegacion = "Home*mural.php?idCurso=$idCurso,Informes*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
	    <? require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<? require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
	<div id="columnaCentro">
     
		
        <p class="titulo_curso">Informes de Actividades: </p>
        <hr />
        <br />
   
        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Informe de Evaluaciones
                </p>
            </div>
            
            <div id="textoJornada">
				<i>Aun no hay informes disponibles</i>
            <br><br>

            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
		<br>
			
    </div> <!--columnaCentro-->

	<? 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>