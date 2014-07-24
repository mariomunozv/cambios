<? 

require("inc/incluidos.php");
require ("hd.php");

$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 7, 'NULL');

$datos = getDatosGenerico($idUsuario);

//print_r($datos);

//print_r($_SESSION);
?>


<script type="text/javascript">
	$(function() {
		$('#datepicker').datepicker({
			changeMonth: true,
			changeYear: true
		});
		
		$('#datepicker').datepicker('option', {dateFormat: "yy-mm-dd"});
		$("#datepicker").datepicker($.datepicker.regional['es']);
		$("#datepicker").datepicker({ minDate: new Date(2010, 1 - 1, 1) });



	});
</script>
    
<body>
<div id="principal">
<? require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <? require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    
    
	<div id="lateralDer">
    <? require("menuright.php");	?>
    </div><!--lateralDer-->
    
	<div id="columnaCentro">
     
		<p class="titulo_curso"><? echo $_SESSION["sesionNombreUsuario"]; ?></p>
        <hr />
        <br />

		<div class="demo">
                
<form id="form1" name="form1" method="post" action="miPerfilGuarda.php" enctype="multipart/form-data">
<table width="400" border="0" class="tablesorter">
  <tr> 
    <td colspan="2">
    <img src="<? echo "subir/fotos_perfil/orig_".$_SESSION["sesionImagenUsuario"]; ?>"   />
    </td>
    
  </tr>
  <tr>
    <th>Actualizar Imagen:</th>
    <td><span class="ui-button-text"><input type="file" name="file" id="file" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  /></span>Tamaño Máximo 1MB, Formato JPG</td>
  </tr>
  
   
  <tr>
    <th>Rut :</th>
    <td>
      <input name="rut" type="hidden" value="<? echo $datos["rut"]; ?>" />
      <? echo $datos["rut"]; ?>   </td>
  </tr>
  <tr>
    <th>Usuario :</th>
    <td><? echo $datos["loginUsuario"]; ?></td>
  </tr> 
  
  <tr>
    <th>Actualizar password :</th>
    <td><input type="password" name="password" id="password" value=""/> 
      (Dejar en blanco para mantener actual)</td>
  </tr>

  <tr>
    <th>&Uacute;ltimo acceso:</th>
    <td><? echo fechaConFormato($datos["ultimoAccesoUsuario"]); ?></td>
  </tr>

  <tr>
    <th>Nombre :</th>
    <td><input type="text" name="nombre" id="nombre" value="<? echo $datos["nombre"]; ?>"/></td>
  </tr>
  
  <tr>
    <th> Apellido Paterno :</th>
    <td><input type="text" name="apellidoPaterno" id="apellidoPaterno" value="<? echo $datos["apellidoPaterno"];?>"/></td>
  </tr>
  <tr>
    <th>Apellido Materno :</th>
    <td><input type="text" name="apellidoMaterno" id="apellidoMaterno" value="<? echo $datos["apellidoMaterno"]; ?>"/></td>
  </tr>
  <tr>
    <th>Sexo :</th>
    <td>
          <input type="radio" name="sexo" value="M" id="M" <?  if ($datos["sexo"] == "M") echo 'checked="checked"' ?>/>
          M
          <input type="radio" name="sexo" value="F" id="F" <?  if ($datos["sexo"] == "F") echo 'checked="checked"' ?>/>
          F	</td>
  </tr>
  <tr>
    <th>Fecha de Nacimiento:<br>Actualizar:</th>
    <td><? echo $datos["fechaNacimiento"]?><br>
      <input size="10" type="text" name="fechaNacimiento" id="datepicker" />
      <input name="fechaNacimiento_h" type="hidden" value="<? echo $datos["fechaNacimiento"]?>" /></td>
  </tr>
  <tr>
    <th>Tel&eacute;fono :</th>
    <td><input size="10" type="text" name="telefono" id="telefono" value="<? echo $datos["telefono"]?>"/></td>
  </tr>
  <tr>
    <th>Email :</th>
    <td><input size="30" type="text" name="email" id="email" value="<? echo $datos["email"]?>"/></td>
  </tr>
  <tr>
    <th>Acerca de mi :</th>
    <td><textarea name="acercaDeUsuario" cols="50" rows="5"><? echo $datos["acercaDeUsuario"]?></textarea></td>
  </tr>
  <tr>
    <th>Mis intereses :</th>
    <td><textarea name="interesesUsuario" cols="50" rows="5"><? echo $datos["interesesUsuario"]?></textarea></td>
  </tr>
  
  <? 
  if ($_SESSION["sesionPerfilUsuario"] < 3){
  
  ?>
  
  <tr>
    <th>A&ntilde;os de experiencia docente:</th>
    <td><input type="text" size="3" name="experiencia" id="experiencia" value="<? echo @$datos["anosExperiencia"]?>"/></td>
  </tr>
  <tr>
    <th>Asignatura a Cargo :</th>
    <td><input type="text" name="asignaturaACargo" id="asignaturaACargo" value="<? echo @$datos["asignaturaACargo"]?>"/></td>
  </tr>
  <!--<tr>
    <th>Coordinador de Enlace:</th>
    <td>--><input type="hidden" name="coordinadorEnlace" id="coordinadorEnlace" value="0" <?  /*if ($datos["coordinadorEnlaceProfesor"] == 1) echo 'checked="checked"'*/ ?> /><!--</td>
  </tr>-->
  
  <? 
  }
  ?>
  
  <tr>
    <td colspan="2" align="right">
		<p align="right"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  onclick="document.form1.submit()"><span class="ui-button-text">Actualizar Datos</span></button></p>
	</td>
  </tr>
</table>
</form>

      </div> <!--demo-->
	
    </div> <!--columnaCentro-->

     <? 
    	
		require("pie.php");
		
    ?> 
</div> 
   
</body>
</html>