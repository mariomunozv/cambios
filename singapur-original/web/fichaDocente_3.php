<? 
//ini_set("display_errors","on");
require("inc/incluidos.php");
require ("hd.php");

$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 7, 'NULL');
$datos = getDatosGenerico($idUsuario);
$datosColegio = getDatosColegio($datos["rbdColegio"]);
$region = getRegion($datosColegio["idComuna"]);
//print_r($datos);
//print_r($datosColegio);
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
/*	
function marcaCursoActual(){
	var cursos = document.getElementById("form1").checkbox;
	var cont = 0;
	for (var x=0; x < cursos.length; x++) {
			cont = cont + 1;
	}
	alert(cont);
}

marcaCursoActual();
*/
</script>
<meta charset="iso-8859-1"/>    
<body>
<div id="principal">
<? require("topMenu.php"); ?>
	
	<div id="aka">
<div class="olo" align="center">
<form id="form1" name="form1" method="post" action="miPerfilGuarda.php" enctype="multipart/form-data">
<table border="0" class="tablesorter" style="width:400px;">
	<tr>
    	<th colspan="4" align="center"><h1>Ficha Docente</h1></th>
    </tr>
	<tr> 
    	<th>Actualizar Imagen:</th>
	    <td align="center" colspan="3">
	    <img src="<? echo "subir/fotos_perfil/orig_".$_SESSION["sesionImagenUsuario"]; ?>"  border="1"/><br/><br/>
        <p><input type="file" name="file" id="file" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  width="20px" /></span>
        Tama&ntilde;o M&aacute;ximo 1MB, Formato JPG</p></td>
 	</tr>
	<tr>
        <th>Nombre:</th>
        <td colspan="3"><input type="text" name="nombre" id="nombre" size="100" value="<? echo $datos["nombreProfesor"]; ?>"/></td>  </tr>
	<tr>
        <th> Apellido Paterno:</th>
        <td colspan="3"><input type="text" name="apellidoPaterno" size="100" id="apellidoPaterno" value="<? echo $datos["apellidoPaternoProfesor"];?>"/></td>
	</tr>
	<tr>
        <th>Apellido Materno:</th>
        <td colspan="3"><input type="text" name="apellidoMaterno" size="100" id="apellidoMaterno" value="<? echo $datos["apellidoMaternoProfesor"]; ?>"/></td>
	</tr>
	<tr>
		<th align="left">Nombre del establecimiento:</th>
		<td style="vertical-align:middle"><input type="text" name="colegio" id="colegio" value="<? echo $datosColegio["nombreColegio"]; ?>" readonly/></td>
        <th>RBD:</th>
        <td style="vertical-align:middle"><input type="text" name="rbd" id="rbd" value="<? echo $datos["rbdColegio"]; ?>" readonly/></td>
	</tr>
  	<tr>
		<th>Region/Departamento: </th>
        <td colspan="3"><input type="text" name="region" size="100" id="region" value="<? echo $region; ?>" readonly/></td>
	</tr>
  	<tr>
      	<th>Comuna/Ciudad: </th>
		<td colspan="3"><input type="text" name="comuna" size="100" id="comuna" value="<? echo $datosColegio["nombreComuna"]; ?>" readonly/></td>
	</tr>
	<tr>
    	<th>Acerca de mi:
        <p style="font-size:9px" align="left">(Describa los aspectos que quiera compartir con otros docentes que interact&uacute;an en la plataforma virtual, tales como experiencia profesional, intereses personales, entre otros)</p></th>
	    <td colspan="3" style="vertical-align:middle"><textarea name="acercaDeUsuario" cols="75" rows="7"><? echo $datos["acercaDeUsuario"]?></textarea></td>
 	</tr>
	<tr>
    	<th>Rut/C&eacute;dula:</th>
	    <td colspan="3">
	      <input name="rut" value="<? echo $datos["rutProfesor"]; ?>" readonly size="100"/>
         </td>
	</tr>
	<tr>
    	<th>Fecha de Nacimiento:<br>Actualizar:</th>
	    <td colspan="3" style="vertical-align:middle"><? echo $datos["fechaNacimientoProfesor"]?><br>
    	  <input size="100" type="text" name="fechaNacimiento" id="datepicker"/>
	      <input name="fechaNacimiento_h" type="hidden" value="<? echo $datos["fechaNacimientoProfesor"]?>"  /></td>
	</tr>
	<tr>
    	<th>Correo Electr�nico:</th>
	    <td colspan="3"><input size="30" type="text" name="email" id="email" value="<? echo $datos["emailProfesor"]?>" size="100"/></td>
  	</tr>
	<tr>
    	<th align="left">Tel�fono del Establecimiento:</th>
	    <td style="vertical-align:middle"><input size="10" type="text" name="telefonoColegio" id="telefonoColegio" value="<? echo $datosColegio["telefonoColegio"]?>" readonly/></td>
        <th>Tel�fono M�vil</th>
		<td style="vertical-align:middle"><input size="10" type="text" name="telefono" id="telefono" value="<? echo $datos["telefonoProfesor"]?>"/></td>
	</tr>
	<tr>
    	<th>A�os de Docencia</th>
	    <td colspan="3"><input type="text" name="experiencia" id="experiencia" value="<? echo @$datos["anosExperienciaProfesor"]?>" size="100"/></td>
	</tr>
	<tr>
    	<th>A�os de Docencia en Establecimiento actual:</th>
	    <td style="vertical-align:middle" colspan="3"><input type="text" name="experienciaColegioActual" id="experienciaColegioActual" size="100" value="<? echo @$datos["anosExperienciaEnColegio"]?>"/></td>
	</tr>
	<tr>
    	<th>Curso(s) en que hace clases de matem�tica durante el 2013:
        <p style="font-size:9px">Puede Seleccionar m�s de una opci�n</p></th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="1"/>1� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="5"/>5� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="2"/>2� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="6"/>6� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="3"/>3� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="7"/>7� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="4"/>4� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="8"/>8� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="otro"/>Otro</td>
                    <td><input type="checkbox"/>Ninguno</td>
                </tr>
			</table>
		</td>
	</tr>

	<tr>
        <th align="left">�Tiene especializaci�n en matem�ticas?:</th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="especializacion" id="espcializacion">
	            <option value="">Seleccionar</option>
	            <option value="Si">Si</option>
	            <option value="No">No</option>                
            </select>
        </td>
	</tr>
    
    
	<tr>
    	<th align="left">�Cu�nto tiempo ha trabajado con los textos del M�todo Singapur Implementando en aula la propuesta?</th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="1"/>1 a�o</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="2"/>2 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="3"/>3 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="4"/>4 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="Nunca"/>Nunca</td>
                </tr>
			</table>
		</td>
	</tr>
    
    <tr>
    	<th>�En qu� Nivel(es)?:
        <p style="font-size:9px">Puede Seleccionar m�s de una opci�n</p></th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="1"/>1� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="2"/>2� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="3"/>3� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="4"/>4� B�sico</td>
                </tr>
			</table>
		</td>
	</tr>
	<tr>
    	<td colspan="4" align="right">
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