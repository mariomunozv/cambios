<?
ini_set("display_errors","on");
include("../inc/_enunciado.php");
require("inc/config.php");
Conectarse();

//relacionados = 2
//no relacionados = 1
$idFormulario = $_POST['formulario'];
$enunciados = getEnunciadosCerrados($idFormulario);

?>

<table class="tablesorter">
<tr>
<th>ID</th>
<th>Enunciado</th>
<th>Seleccionar</th>
</tr>
<?

$i=0;
foreach ($enunciados as $enunciado)
{?>
	<tr>
		<td><? echo $enunciado['idEnunciado']?></td>
		<td><? echo $enunciado['textoEnunciado'] ?></td>
		<td align="center"><input type="checkbox" name="seleccionados[]" class="campos" value=<? echo $enunciado['idEnunciado']?>></td>
	</tr>
	<? $i++;
}
?>

</table>
</body>
</html>
