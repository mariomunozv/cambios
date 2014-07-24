<?
require("inc/config.php");
include "../inc/_funciones.php";

$idActividadPagina = $_REQUEST["idActividadPagina"];

function getContenidoPagina($idActividadPagina)
{
	$sql = "SELECT * FROM contenidoPagina WHERE idActividadPagina = ".$idActividadPagina." Order By(ordenContenidoPagina)";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res))
	{
		$contenidos[$i] = array(
		"idContenidoPagina" => $row["idContenidoPagina"],
		"idTipoContenidoPagina" => $row["idTipoContenidoPagina"],
		"idActividadPagina" => $row["idActividadPagina"],
		"textoContenidoPagina" => $row["textoContenidoPagina"],
		"ordenContenidoPagina" => $row["ordenContenidoPagina"]
		);
		$i++;
	}
	return ($contenidos);
}

$contenidos = getContenidoPagina($idActividadPagina);

boton("Nuevo Contenido", "new_contenido($idActividadPagina);");
?>

<script>
$('#tblAcPagCon').tableDnD({
        onDrop: function(table, row) {
           var a = $.tableDnD.serialize();
		   var division = document.getElementById("nuevo");
		   AJAXPOST("actividadesPaginaContenidoOrdenar.php",a,division);
        },
    });
	
$(".elimina").button({
   icons: {
      primary: 'ui-icon-trash'
   },
}) 
</script>

<style>
.elimina{
	padding: 4px 0;
}
</style>


<table class="tableSorter" id="tblAcPagCon">
	<tr class="nodrop nodrag">
		<th>idContenidoPagina</th>
		<th>idTipoContenidoPagina</th>
		<th>idActividadPagina</th>
		<th>textoContenidoPagina</th>
		<th>Orden</th>
   		<th>Editar</th>
   		<th>Eliminar</th>
	</tr>
	<? 
	foreach($contenidos as $contenido)
	{
	?>
	<tr id="<? echo $contenido["idContenidoPagina"];?>">
   		<td><? echo $contenido["idContenidoPagina"]; ?></td>
		<td><? echo $contenido["idTipoContenidoPagina"]; ?></td>
		<td><? echo $contenido["idActividadPagina"]; ?></td>
		<td><? echo $contenido["textoContenidoPagina"];?></td>
   		<td><? echo $contenido["ordenContenidoPagina"];?></td>
		<td><a href="javascript:edit_contenido(<? echo $contenido["idContenidoPagina"].",".$contenido["idActividadPagina"]?>)">Editar</a></td>
		<td><a href="javascript:delete_contenido(<? echo $contenido["idContenidoPagina"].",".$contenido["idActividadPagina"]?>)" class="elimina"/></td>
	</tr>
	<? } ?>
</table>
