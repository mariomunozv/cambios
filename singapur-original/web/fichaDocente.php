<? 
ini_set("display_errors","on");
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


//echo @$datos["cursoActual"]; 

$cursos = @$datos["cursoActual"];
$niveles = @$datos["nivelExperienciaSingapur"];
$xpSingapur = @$datos["experienciaSingapur"];
$especializacion= @$datos["especializacion"];

function marcaCurso($cursos, $curso){
	$pos = strpos($cursos, $curso);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}

function marcaNivel($niveles, $nivel){
	$pos = strpos($niveles, $nivel);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}

function marcaXpSingapur($xpSingapur, $xp){
	$pos = strpos($xpSingapur, $xp);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}


function seleccionaEspecializacion($especializacion, $espc){
	$pos = strpos($especializacion, $espc);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}


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
	
function despliegaTabla(){
	$("#trDesplegable").show();
}

function ocultaTabla(){
	$("#trDesplegable").hide();
}

function creaPDF(idUsuario)
{
	window.location.href = "creaPDF.php?idUsuario="+idUsuario;
}

function editaPerfil()
{
	window.location.href = "fichaDocenteEdita.php";
}


</script>

<meta charset="iso-8859-1"/>    
<body>
<div id="principal">
<? 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Ficha Docente*#";	
	require("_navegacion.php");

?>
	
	<div>
<div align="center">
<br/>
<p align="right" style="width:800px"><button name="pdf" id="pdf" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  onclick="creaPDF(<? echo $idUsuario; ?>)"><span class="ui-button-text">Exportar a PDF</span></button> &nbsp; <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  onclick="editaPerfil()"><span class="ui-button-text">Editar Perfil</span></button></p>
<table border="0" class="tablesorter" style="width:800px;" id="tbGeneral">
	<tr>
    	<th colspan="4" align="center"><h1>Ficha Docente</h1></th>
    </tr>
	<tr> 
    	<th width="20%">Actualizar Imagen:</th>
	    <td align="center" colspan="3">
	    <img src="<? echo "subir/fotos_perfil/orig_".$_SESSION["sesionImagenUsuario"]; ?>"  border="1" onerror="this.src='img/nophoto.jpg'" width="250px"/><br/><br/>
		</td>
 	</tr>
	<tr>
        <th>Nombre:</th>
        <td colspan="3"><label><? echo $datos["nombreProfesor"]; ?></label></td>  
	</tr>
	<tr>
        <th> Apellido Paterno:</th>
        <td colspan="3"><label><? echo $datos["apellidoPaternoProfesor"];?></label></td>
	</tr>
	<tr>
        <th>Apellido Materno:</th>
        <td colspan="3"><label><? echo $datos["apellidoMaternoProfesor"]; ?></label></td>
	</tr>
	<tr>
		<th align="left">Nombre del establecimiento:</th>
		<td style="vertical-align:middle" width="30%"><label><? echo $datosColegio["nombreColegio"];?></label></td>
        <th>RBD:</th>
        <td style="vertical-align:middle"><label><? echo $datos["rbdColegio"]; ?></label></td>
	</tr>
  	<tr>
		<th>Region/Departamento: </th>
        <td colspan="3"><label><? echo $region; ?></label></td>
	</tr>
  	<tr>
      	<th>Comuna/Ciudad: </th>
		<td colspan="3"><label><? echo $datosColegio["nombreComuna"]; ?></label></td>
	</tr>
	<tr>
    	<th>Acerca de mi:</th>
	    <td colspan="3" style="vertical-align:middle"><label style="border:thin"><? echo $datos["acercaDeUsuario"]?></label></td>
 	</tr>
	<tr>
    	<th>Rut/C&eacute;dula:</th>
	    <td colspan="3">
	      <label><? echo $datos["rutProfesor"]; ?></label>
		</td>
	</tr>
	<tr>
    	<th>Fecha de Nacimiento:</th>
	    <td colspan="3" style="vertical-align:middle">
        	<label><? echo $datos["fechaNacimientoProfesor"]?></label>
		</td>
	</tr>
	<tr>
    	<th>Correo Electrónico:</th>
	    <td colspan="3"><label><? echo $datos["emailProfesor"]?></label></td>
  	</tr>
	<tr>
    	<th align="left">Teléfono del Establecimiento:</th>
	    <td style="vertical-align:middle"><label><? echo $datosColegio["telefonoColegio"]?></label></td>
        <th width="15%">Teléfono Móvil</th>
		<td style="vertical-align:middle"><label><? echo $datos["telefonoProfesor"]?></label></td>
	</tr>
	<tr>
    	<th>Años de Docencia</th>
	    <td colspan="3"><label><? echo @$datos["anosExperienciaProfesor"]; ?></label></td>
	</tr>
	<tr>
    	<th>Años de Docencia en Establecimiento actual:</th>
	    <td style="vertical-align:middle" colspan="3"><label><? echo @$datos["anosExperienciaEnColegio"]?></label></td>
	</tr>
	<tr>
    	<th>Curso(s) en que hace clases de matemática durante el 2013:</th>
        <td colspan="3" style="vertical-align:middle">
        <label><? echo $cursos;?></label>
	</tr>

	<tr>
        <th align="left">¿Tiene especialización en matemáticas?:</th>
        <td colspan="3" style="vertical-align:middle">
        	<label><? echo $especializacion ?></label>
        </td>
	</tr>
	<tr>
    	<th align="left">¿Cuánto tiempo ha trabajado con los textos del Método Singapur Implementando en aula la propuesta?</th>
        <td colspan="3">
			<label><? echo $xpSingapur; ?></label>
        </td>
	</tr>
    
    <tr id="trDesplegable">
    	<th>¿En qué Nivel(es)?:</th>
        <td colspan="3">
			<label><? echo $niveles ?></label>
		</td>
	</tr>
</table>
      </div> <!--demo-->
	</div> <!--columnaCentro-->
</div> 
   
</body>
</html>