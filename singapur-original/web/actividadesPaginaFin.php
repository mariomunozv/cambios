<? 
require("inc/incluidos.php");
include "/inc/_actividad.php";
include_once "/inc/_accesoRecurso.php";



require ("hd.php");


// Registra solo la primera vez que se finaliza la actividad
if (buscaAcceso($_SESSION["sesionIdUsuario"], 14, $_SESSION["sesionIdActividad"]) == false){
	registraAcceso($_SESSION["sesionIdUsuario"], 14, $_SESSION["sesionIdActividad"]);	
}


?>
<script>
function closer() {
	//var ventana = window.self;
	//ventana.opener = window.self;
	//ventana.close();
	location.href="home.php"
}

</script>
<body>
<div id="principal">
<? require("topActividad.php"); 
//echo count($_SESSION["paginasActividad"])."CUENTPAGINAS".$_SESSION["j"];
unset($_SESSION["j"]);
?>
	
<div id="columnaCentro">
	<p class="titulo_curso">Fin de la actividad</p>
   	<hr/>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <h2> Ha finalizado la actividad, ¡Muchas gracias!.</h2><br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

	<p align="right"><? boton("Finalizar","closer();");?></p>
        
	<div id="carga"></div> 
        
      </div><!--columnaCentro-->
         
       <? //  require("misCursos.php");?>
     
               
    
              
	<? 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
