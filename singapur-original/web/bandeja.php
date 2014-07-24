<? 
ini_set("Display_Errors","On");
require("inc/incluidos.php");
require ("hd.php");?>

<body>

<div id="principal">
<? 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Mensajes*#";	
	require("_navegacion.php");
?>
    <div id="lateralIzq">
    	<? require("menuleft.php");?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
	    <? require("menuright.php");?>
    </div><!--lateralDer-->    
    
    
	<div id="columnaCentro">
     
        <p class="titulo_curso">Mensajes <? echo $_SESSION["sesionNombreUsuario"]; ?></p>
        <hr />
        <br />

       	<p align="right">
        	<? 
			boton("Nuevo Mensaje","muestraListadoParaMensaje()");
			?>
		</p>
       
       <!--Aqui se cargan las cosas-->
        <div id="nuevoMensaje"></div>
        
        <div id="listadoParaMensaje"></div>
		
        <div id="bandeja"></div>

        <br />
        <br />

	</div>  <!--columnaCentro-->
 
 <? 
    	
	require("pie.php");
	
?> 
  </div>
</body>
<script type="text/javascript">
	
		<? 
		if ($_REQUEST["mostrar"] == "recibidos"){
		?>
			mostrarRecibidos();
		<? 
		}
		
		if ($_REQUEST["mostrar"] == "enviados"){
		?>
			mostrarEnviados();
		<?
		}	
		?>
	
	
</script>
</html>
