<?
ini_set("display_errors","ON");
require("inc/_formulario.php");
require("inc/incluidos.php");
//require("hd.php");

$formularios = getEncuestas();

?>
	<option value="">Seleccione un Formulario</option>
<? foreach($formularios as $encuesta) {?>
	<option value="<? echo $encuesta["idFormulario"];?>"><? echo $encuesta["nombreFormulario"];?></option>
<? } ?>
