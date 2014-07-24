<?
require("inc/config.php");


$idCursoCapacitacion = $_REQUEST["idCursoCapacitacion"];


function getJornadas()
{
$sql = "SELECT j.idJornada, j.nombreJornada, c.nombreCortoCursoCapacitacion, j.visibleJornada,j.muralJornada";
$sql .= " FROM jornada j, cursoCapacitacion c";
$sql .= " WHERE j.idCursoCapacitacion = c.idCursoCapacitacion";
$sql .= " AND c.estadoCursoCapacitacion = 1";
$sql .= " ORDER BY(j.idJornada) DESC";
//echo $sql;
$res = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($res))
{
	$jornadas[$i] = array(
	"idJornada" => $row["idJornada"],
	"nombreJornada" => $row["nombreJornada"],
	"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"],
	"visibleJornada" => $row["visibleJornada"],
	"tipoJornada" => $row['muralJornada']
	);
	$i++;
}
return ($jornadas);
}


function getJornadasByID($idCursoCapacitacion)
{
$sql = "SELECT j.idJornada, j.nombreJornada, c.nombreCortoCursoCapacitacion, j.visibleJornada, j.muralJornada";
$sql .= " FROM jornada j, cursoCapacitacion c";
$sql .= " WHERE j.idCursoCapacitacion = c.idCursoCapacitacion";
$sql .= " AND c.estadoCursoCapacitacion = 1";
$sql .= " AND c.idCursoCapacitacion=".$idCursoCapacitacion;
$sql .= " ORDER BY(j.nombreJornada) DESC";
//echo $sql;
$res = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($res))
{
	$jornadas[$i] = array(
	"idJornada" => $row["idJornada"],
	"nombreJornada" => $row["nombreJornada"],
	"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"],
	"visibleJornada" => $row["visibleJornada"],
	"tipoJornada" => $row['muralJornada']
	);
	$i++;
}
return ($jornadas);
}



if(isset($idCursoCapacitacion) && $idCursoCapacitacion != "")
{
	$jornadas = getJornadasByID($idCursoCapacitacion);	

}
else
{
	$jornadas = getJornadas();	
}
?>

<script language="javascript">
$(document).ready(function() 
    { 
        $("#tbl").tablesorter(); 
    } 
);
</script>

<table class="tablesorter" id="tbl">
<thead>
	<tr>
		<th>ID</th>
		<th>Jornada</th>
        <th>Tipo Jornada</th>
		<th>Curso</th>
		<th>Estado</th>
		<th>Editar</th>
	</tr>
</thead>    
<tbody>
	<? 
	foreach($jornadas as $jornada)
	{
	?>

	<tr>
		<td><? echo $jornada["idJornada"]; ?></td>
        <? switch($jornada["tipoJornada"]){
			case 0:
				echo "<td>Home</td>";
			break;
			
			case 1:
				echo "<td>Mural</td>";
			break;
			
			case 2:
				echo "<td>Recurso</td>";
			break;
			
		}?>
		<td><? echo $jornada["nombreJornada"]; ?></td>
		<td><? echo $jornada["nombreCortoCursoCapacitacion"]; ?></td>
		<?
		if($jornada["visibleJornada"]==1){
		?>
		<td style="background-color:#99CC00"><a href="javascript:estado_jornada(<? echo $jornada["idJornada"].",".$jornada["visibleJornada"]?>)">Visible</a></td>
		<? }else { ?>
		<td style="background-color:#FF0000"><a href="javascript:estado_jornada(<? echo $jornada["idJornada"].",".$jornada["visibleJornada"]?>)">Oculta</a></td>
		<? } ?>
		<td><a href="javascript:edit_jornada(<? echo $jornada["idJornada"] ?>)">Editar</a></td>
	</tr>
	<? } ?>
</tbody>
<table>