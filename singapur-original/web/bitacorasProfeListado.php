<? session_start();
include "inc/conecta.php";
include "inc/_bitacora.php";
include "inc/_usuario.php";
include "inc/_profesor.php";
include "inc/_seccionBitacora.php";
include "sesion/sesion.php";
$idUsuario = $_REQUEST["idUsuario"];
$idCurso = $_REQUEST["idCurso"];
$idCapitulo = $_REQUEST["idCapitulo"];
Conectarse_seg();
$bitacoras = getBitacorasCompletadasUsuarioCapitulo($idUsuario,$idCapitulo,$idCurso);
$secciones = getSeccionBitacoraCapitulo($idCapitulo);
$i=0;
if(count($bitacoras)>0){//Se busca crear un arreglo solo con ID de Secciones, sin llamar a la BDD
foreach($bitacoras as $bitacora){ 
	$arrSeccionesCompletadas[$i] = $bitacora['idSeccionBitacora'];
	$i++;
	}
}
//print_r($secciones);
?>
<table width="10%" border="0" align="center" class="tablesorter">
	<tr>
    	<th colspan="8" align="center">Estado ingreso de apartados</th>
    </tr>
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
<? 
foreach($secciones as $seccion){
	$match = 0;
	foreach($bitacoras as $bitacora)
	{
		if($seccion["idSeccionBitacora"] == $bitacora["idSeccionBitacora"]){
			$match++;
			?>
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
                <td align="center" valign="top">Declarado</td> 
		<?
		}//fin if($seccion["idSeccionBitacora"] == $bitacora["idSeccionBitacora"])
	} //foreach($bitacoras as $bitacora)
	if($match==0){//Si hasta aquí no han habido coincidencias, muestra por defecto
	?>
     <tr>
		<td align="center" valign="top">No declarado</td>
		<td align="center" valign="top">No declarado</td>
		<td align="center" valign="top">
        	<? echo getNombreCapituloBitacora($seccion["idSeccionBitacora"]);?>
        </td>
        <td align="center" valign="top">
        	<? echo $seccion["nombreSeccionBitacora"];?>
        </td>
		<td align="center" valign="top">No declarado</td>
		<td align="center" valign="top">No declarado</td>
		<td align="center" valign="top">No declarado</td>
		<td align="center" valign="top">No declarado</td>
    <? }//fin del if
	} //fin del foreach ?>
    </tr>
</table>