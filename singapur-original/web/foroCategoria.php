<?
require("inc/incluidos.php");
require ("hd.php");

$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 10, 'NULL');
$idCategoria = $_GET["idCategoria"];
$nombreTemaCategoria = getNombreCategoria($idCategoria);
$idPerfilUsuario= $_SESSION["sesionPerfilUsuario"];
$temas = getTemaCurso($idCategoria,$_SESSION["sesionIdCurso"]);
?>

<script language="javascript">
$(function(){

	<? /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		headers: {  
			5: { sorter: false },
			6: { sorter: false }  // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({ 
			container: $("#pager"),
			positionFixed: false,
			size:1 //Numero de registros tb
			});  
}); 

function nuevoTema(idCategoria){  
	var division = document.getElementById("nuevoTema");
	var a = "categoria="+idCategoria;
	AJAXPOST("temaNuevo.php",a,division);  
}


</script> 

<body>
<div id="principal">
<? 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Foro*#";	
	require("_navegacion.php");
?>
	
    <div id="lateralIzq">
    <? 
        require ("menuleft.php");
        require ("categoriaForo.php");
    ?> 
    </div>
    <div id="lateralDer">
	    <? require("menuright.php"); ?>
    </div><!--lateralDer-->
    
     <div id="columnaCentro">
	 	<p class="titulo_curso">Foros de Conversación</p>
		<hr/><br/>
      	<? //if ($nombreTemaCategoria == "Conversemos" || $idPerfilUsuario > 3){
			if ($idPerfilUsuario > 4){?>
			<p align="right"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" name="neoTema" id="neoTema" onClick="nuevoTema(<? echo $idCategoria ?>)" ><span class="ui-button-text">Nuevo Tema</span></button></p>
		<?	//boton("Nuevo Tema","nuevoTema($idCategoria)");
		  } ?>
          	 
		 <div id="nuevoTema"></div>
		 <div id="listaTema">
         	<table class="tablesorter">
            	<tr class="ui-state-active" >
					<th width="17%">&nbsp;Tema</th>
					<th>Descripci&oacute;n</th>
			    </tr>
                <? foreach($temas as $tema){ ?>
		        <tr class="style1">
                	<td valign="top" bgcolor="#D9E3EC" align="left"><a href="temaDetalle.php?idForo=<? echo $tema["idTema"];?>&amp;flag=<? echo 1; ?>"><? echo $tema["tituloTema"];?></a></td>
                    <td height="50" align="justify" valign="top" bgcolor="#D9E3EC"><? echo $tema["mensajeInicialTema"];?></td>
                </tr>
                <tr>
	                <td colspan="2"><span>Comenzado por <? echo getNombreUsuario($tema["idUsuario"]); ?> <br />
                     Respuestas:
                          <? getRespuestaTema($tema["idTema"]);?>
                          <br />
                          Ultimo Usuario:
                          <? 
					   $ultimoMensajeTema = getUltimoMensajeTema($tema["idTema"]);
					   $datosMensajeTema = getDatosMensajeTema($ultimoMensajeTema);
					   echo cambiaf_a_normal($datosMensajeTema["fechaMensajeTema"]);
					   ?>
                        </span>
    	            </td>
                </tr>
                <? } ?>
	        </table>
                  </div>
	  </div><!-- Fin <div id="columnaCentro"> -->
   
	<? require("pie.php"); ?> 
</div> <!--Fin <div id="principal">-->
</body>
</html>