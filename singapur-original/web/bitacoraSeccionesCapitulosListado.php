<? 
session_start();
include "inc/conecta.php";
include "inc/_bitacora.php";
include "inc/_usuario.php";
include "inc/_profesor.php";
include "sesion/sesion.php";
$idUsuario = $_REQUEST["idUsuario"];
$idCurso = $_REQUEST["idCurso"];
Conectarse_seg();
//$idPadre = $_REQUEST["idPadre"];
//$secciones = getSeccionesHijas($idPadre);
//print_r($secciones);
$hayBitacora = 0;
$bitacoras = getBitacorasUsuarioCurso($idUsuario,$idCurso);
//print_r($bitacoras);
$hayBitacora = count($bitacoras);
if($hayBitacora > 0){
?>
<table width="10%" border="0" align="center" class="tablesorter">
	<tr>
	    <th>Usuario que ingresó Bitácora</th>
        <th>Profesor</th>
	    <th>Capítulo</th>
        <th>Apartado</th>
        <th align="left">Horas de implementación</th>
        <th align="left">Fecha inicio</th>
        <th align="left">Fecha término</th>
        <th>Estado</th>
    </tr>
    <? foreach($bitacoras as $bitacora){?>
    <tr>
		<td align="center" valign="top">
        	<? echo getNombreUsuario($bitacora["usuarioIngresa"]);?>
        </td>
		<td align="center" valign="top">
        	<? echo getNombreUsuario($bitacora["idUsuario"]);?>
        </td>
		<td align="center" valign="top">
        	<? echo getNombreCapituloBitacora($bitacora["idSeccionBitacora"]);?>
        </td>
        <td align="center" valign="top">
        	<? echo $bitacora["nombreBitacora"];?>
        </td>
		<td align="center" valign="top">
        	<? echo $bitacora["tiempoBitacora"];?>
        </td>
		<td align="center" valign="top">
        	<? echo $bitacora["fechaInicio"];?>
        </td>
		<td align="center" valign="top">
        	<? echo $bitacora["fechaTermino"];?>
        </td>        
		<td align="center" valign="top">
        	<? echo $bitacora["estadoBitacora"];?>
        </td>        
	<? } ?>
    </tr>
</table>

<?
}else{
	echo "No hay Bitacoras Ingresadas";
}

?>

