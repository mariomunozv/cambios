<? require("inc/incluidos.php"); ?>
<? require ("hd.php");

$idCurso = $_SESSION["sesionIdCurso"];
?>
<script>
function muestraBitacorasProfe(idUsuario){  
		var division = document.getElementById("bitacoraProfe");
		AJAXPOST("bitacoraReporteProfe.php","idUsuario="+idUsuario,division);  
	}
</script>
<p>Seleccione un profesor para consultar su bit�cora</p>


<div id="bitacoraProfe"></div>
<a name="listado"></a> 
   <table border="0" align="center" width="100%" class="tablesorter">

    <tr  align="center">
        <th width="90">N&deg;</th>
        <th width="470">Participante</th>
        <th width="287">Rol </th>
        <th width="255">Ver Perfil</th>
    </tr>
  

	<? 
	//print_r($_SESSION);

    $alumnosCurso = getAlumnosCurso($idCurso);
	
//	print_r($alumnosCurso);
    
    ordenar($alumnosCurso,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
    
    $_SESSION["alumnosCurso"] = $alumnosCurso;
                
    //print_r($alumnosCurso);
    $color = ' bgcolor ="#FFFFFF"';
    $flag = 0;
    $num = 0;
    
    
    foreach ($alumnosCurso as $i => $value) { 
		$num = $num+1;
		if ($flag == 0){
			$flag = 1;
			$color = "";
		}
		else{
			$flag = 0;
			$color = ' bgcolor ="#FFFFFF"';
		}

		?>
		<tr <? echo $color;?>>
			<td valign="center">
				<? echo $num;?>
			</td>
		<?
		// Si no existen alumnos
		if(empty($alumnosCurso[0])){
			echo '<td colspan="6">No hay alumnos inscritos em el curso</td>';
		}
		else{
			?>
			<td valign="center">
				<div align="left">
					<strong><a href="#listado" onclick="muestraBitacorasProfe(<? echo $value["idUsuario"];?>)"><? echo $value["nombreCompleto"]; ?></a></strong>
				</div>
			</td>
			
			<td valign="center">
				<div align="center">
					<?
					echo getNombrePerfil($value["idPerfil"]); 
					?>
				</div>
			</td>
			
			<td>
				<div align="center">
					<a href="verPerfil.php?idUsuario=<?  echo $value["idUsuario"]; ?>" ><img src="img/profile.png" width="16" height="16" style="cursor:pointer" border="0" title="Perfil de <? echo $value["nombreCompleto"]; ?>"/></a>
				</div>
			</td>
			
			
		</tr>
		
	<? 	
		} // else (existen alumnos)
		
	} //foreach


	?>
       
</table>                
                   
               

