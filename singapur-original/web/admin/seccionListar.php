<?
ini_set("display_errors","on");
include("../inc/_seccion.php");
require("inc/config.php");
Conectarse();

$idFormulario = $_POST['formulario'];
$secciones = getSeccionesFormulario($idFormulario);

if($secciones != null)
{
	?><option value="NULL">Seleccione Sección</option><?
	foreach ($secciones as $seccion)
	{?>
		<option value="<? echo $seccion['idSeccionFormulario']; ?>"><? echo $seccion['tituloSeccionFormulario']; ?></option>
	<?
	}
}
else
{?>
	<option value="NULL">Sin Secciones</option>
<? 
}
?>