<?
include("../inc/_enunciado.php");
require("inc/config.php");
Conectarse();

$condicion = $_POST['enunciados'];

//relacionados = 2
//no relacionados = 1

$enunciados = getEnunciados($condicion);

?>

<table class="tablesorter">
<tr>
<th>Enunciado</th>
<th>Seleccionar</th>
</tr>
<?
$i=0;
foreach ($enunciados as $enunciado)
{?>
	<tr>
		<td><? echo $enunciado['textoEnunciado'] ?></td>
		<td align="center"><input type="checkbox" name="seleccionados[]" class="campos" value=<? echo $enunciado['idEnunciado']?>></td>
	</tr>
	<? $i++;
}
?>

</table>
</body>
</html>
