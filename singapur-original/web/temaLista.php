<?
require("inc/incluidos.php");
require ("hd.php");
?>

<table width="100%" border="0" cellspacing="2" class="tablesorter">
	<tr class="ui-state-active" >
		<th width="17%">&nbsp;Tema</th>
		<th>Descripci&oacute;n</th>
    </tr>
		<?
			$res = getTemaCurso(@$_REQUEST["categoria"],$_SESSION["sesionIdCurso"]); 
			if (@mysql_num_rows($res) > 0 ){
			while($row = mysql_fetch_array($res)){
				//$datosDeUsuario = getNombreUsuario($row["idUsuario"]);	
			
				?>
                <tr class="style1">
                	<td valign="top" bgcolor="#D9E3EC" align="left"><a href="temaDetalle.php?idForo=<? echo $row["idTema"];?>&amp;flag=<? echo 1; ?>"><? echo $row["tituloTema"];?></a></td>
                    <td height="50" align="justify" valign="top" bgcolor="#D9E3EC"><? echo $row["mensajeInicialTema"];?></td>
                </tr>
                <tr>
                	<td colspan="2"><span class="style3">Comenzado por <? echo getNombreUsuario($row["idUsuario"]); ?> <br />
                          Respuestas:
                          <? getRespuestaTema($row["idTema"]);?>
                          <br />
                          Ultimo Usuario:
                          <? 
					   $ultimoMensajeTema = getUltimoMensajeTema($row["idTema"]);
					   $datosMensajeTema = getDatosMensajeTema($ultimoMensajeTema);
					   echo cambiaf_a_normal($datosMensajeTema["fechaMensajeTema"]);
					   ?>
                        </span></td>
                 </tr>
                      <? } }else{	 ?>
                 <tr >
                        <td colspan="3" align="center"><br />
                          No hay ningun foro disponible por el momento.<br /></td>
                 </tr>
                      <?	   }?>
</table>