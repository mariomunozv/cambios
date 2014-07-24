<? 
ini_set("display_errors","on");
require("inc/incluidos.php");
require("inc/_comuna.php");
require ("hd.php");

$idUsuarioPerfil = $_REQUEST["idUsuario"];
$datos =getDatosUsuarioPorId($idUsuarioPerfil);
//print_r($datos);
$idUsuarioMira = $_SESSION["sesionIdUsuario"];
$datosColegio = getDatosColegio($datos["rbdColegio"]);
$region = getRegion($datosColegio["idComuna"]);
?>

<script language="javascript" type="text/javascript">
$(function() {
	$( "#nuevoMensaje" ).dialog({
    	autoOpen: false,
        height: 330,
		width: 500,
		modal: true,
		show: "fade",
		hide: "fade",
		buttons: {
        	Enviar: function() {
				enviaMensaje();	
				$( this ).dialog( "close" );
			},
				   
		Cancelar: function(){
				$( this ).dialog( "close" );
		},
	},
});
	
$( "#btnCrear" )
	.button()
    .click(function() {
        $( "#nuevoMensaje" ).dialog( "open" );
	});
});
	
	
$(function() {
	$( "#confirmacion" ).dialog({
		autoOpen: false,
		modal: true,
		show: "fade",
		hide: "fade",
		height: 180,
		buttons: {
		"Aceptar": function() {
		$( this ).dialog( "close" );
		}
	}
});
});

function confirmaMensaje(){
	$(function(){
		$("#confirmacion").dialog( "open" );
	});
}

function enviaMensaje(){
	var division = document.getElementById("nuevoMensaje");
	var asunto = document.getElementById("asunto").value;
	var mensaje = document.getElementById("textoMensaje").value;
	a = "idDe="+<? echo $idUsuarioMira; ?>+"&idPara="+<? echo $idUsuarioPerfil ?>+"&asunto="+asunto+"&mensaje="+mensaje;
	alert(a);
	AJAXPOST("mensajeEnviadoPerfil.php",a,division);
} 
</script>
<body>
<div id="principal">
<? 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Perfil*#";	
	require("_navegacion.php");

?>
	
    <div id="lateralIzq">
    <? require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
    <? require("menuright.php");	?>
    </div><!--lateralDer-->
    
    
	<div id="columnaCentro">
    
    <div id="confirmacion" align="center" title="Informaci&oacute;n" >
    	<span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>
    	<p>Su mensaje ha sido enviado</p>
	</div>
    <div id="nuevoMensaje" title="Enviar Mensaje">
    <form name="msj" id="msj">
        <fieldset>
            <legend style="margin-left:5px">Datos del mensaje</legend>
            <br/>
            <div style="margin-left:50px" align="left">
            <table>
            <tr>
                <td><label for="nombre">Nombre:</label></td>
                <td>
                	<input readonly type="input" nombre="nombre" id="nombre" size="50" value="<? echo $datos["nombre"]." ".$datos["apellidoPaterno"]." ".$datos["apellidoMaterno"];?>"/>
                	<input readonly type="hidden" nombre="idUsrPara" id="idUsrPara" size="50" value="<? echo $idUsuarioPerfil ?>"/>
				</td>
		    </tr>
            <tr>
                <td><label for="asunto">Asunto:</label></td>
                <td><input type="input" name="asunto" id="asunto" size="50"/></td>
			</tr>
            <tr>
                <td><label for="textoMensaje" style="vertical-align:top">Mensaje: </label></td>
                <td><textarea name="textoMensaje" id="textoMensaje" cols="47" rows="5"/></textarea></td>
             </tr>
             </table>
             <br/><br/>
            </div>
        </fieldset>
    </form>
	</div>
   	<p class="titulo_curso"><? echo getNombreUsuario($idUsuarioPerfil); ?></p>
    <hr /><br/>
	<p align="right">
	<button name="btnCrear" id="btnCrear">Enviar Mensaje</button>
    </p>
  	<? if($datos['tipoUsuario']=="Empleado Klein") {?>
    <table border="0" class="tablesorter" style="width:100%;" id="tbGeneral">
	<tr>
    	<th colspan="4" align="center"><h1>Datos Coordinador General</h1></th>
    </tr>
	<tr> 
	    <td align="center" colspan="4">
	    <img src="<? echo "subir/fotos_perfil/orig_$idUsuarioPerfil.jpg"; ?>"  border="1" onerror="this.src='img/nophoto.jpg'" width="250"/><br/><br/>
        </td>
 	</tr>
	<tr>
        <th>Nombre:</th>
        <td colspan="3"><label style="font-size:14px"><? echo $datos["nombre"]." ".$datos["apellidoPaterno"]." ".$datos["apellidoMaterno"]; ?></label></td>
	</tr>
    <tr>
        <th>Ciudad:</th>
        <td colspan="3"><label style="font-size:14px"><? echo getNombreComuna($datos["idComuna"]); ?></label></td>
	</tr>
	<tr>
		<th align="left">Instituci&oacute;n:</th>
        <td colspan="3"><p style="font-size:14px">Centro Felix Klein</p></td>        
    </tr>
    <tr>
      	<th align="left">Rol asesoria M&eacute;todo Singapur: </th>
		<td colspan="3"><label style="font-size:14px"><? echo $datos["rolEmpleadoKlein"]; ?></label></td>        
	</tr>
	<tr>
    	<th width="30%">Acerca de mi:</th>
	    <td colspan="3" style="vertical-align:middle">
		<label style="font-size:14px"><? echo $datos["acercaDeUsuario"]?></label>
        </td>
 	</tr>
    </table>
    <? } else { ?>
    <table border="0" class="tablesorter" style="width:100%;" id="tbGeneral">
	<tr>
    	<th colspan="4" align="center"><h1>Ficha Docente</h1></th>
    </tr>
	<tr> 
	    <td align="center" colspan="4">
	    <img src="<? echo "subir/fotos_perfil/orig_$idUsuarioPerfil.jpg"; ?>"  border="1" onerror="this.src='img/nophoto.jpg'" width="250"/><br/><br/>
        </td>
 	</tr>
	<tr>
        <th>Nombre:</th>
        <td colspan="3"><label style="font-size:14px"><? echo $datos["nombre"]; ?></label></td>
	</tr>
	<tr>
        <th>Apellido Paterno:</th>
        <td colspan="3"><label style="font-size:14px"><? echo $datos["apellidoPaterno"]; ?></label></td>
	</tr>
	<tr>
        <th>Apellido Materno:</th>
        <td colspan="3"><label style="font-size:14px"><? echo $datos["apellidoMaterno"]; ?></label></td>
	</tr>
	<tr>
		<th align="left">Nombre del establecimiento:</th>
        <td colspan="3"><label style="font-size:14px"><? echo $datosColegio["nombreColegio"]; ?></label></td>        
    </tr>
  	<tr>
		<th>Region/Departamento: </th>
		<td colspan="3"><label style="font-size:14px"><? echo $region; ?></label></td>        
	</tr>
  	<tr>
      	<th>Comuna/Ciudad: </th>
		<td colspan="3"><label style="font-size:14px"><? echo $datosColegio["nombreComuna"]; ?></label></td>        
	</tr>
	<tr>
    	<th width="30%">Acerca de mi:</th>
	    <td colspan="3" style="vertical-align:middle">
		<label style="font-size:14px"><? echo $datos["acercaDeUsuario"]?></label>
        </td>
 	</tr>
    </table>
    <? } ?>    
   	<p align="right">
		<? boton("Volver","history.go(-1)");?>
	</p>

</div> <!--columnaCentro-->

	<? 
    	
		require("pie.php");
		
    ?> 
   </div>
</body>
</html>
