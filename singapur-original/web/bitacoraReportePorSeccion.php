<? require("inc/incluidos.php"); ?>
<? require ("hd.php");

$idCurso = $_SESSION["sesionIdCurso"];

?>
<script>
function muestraBitacorasCapitulo(idCapitulo){  
		var division = document.getElementById("bitacoraSeccion");
		AJAXPOST("bitacoraReporteCapitulo.php","idCapitulo="+idCapitulo,division);  
	}
</script>
<p>Seleccione un Cap�tulo para consultar </p>
   <table border="0" align="center" width="100%" class="tablesorter">

    <tr >
        <th >Capitulos </th>
       
    </tr>
  

	<? 



    $seccionesPadre = getSeccionPadreBitacora($idCurso);
	
//	print_r($alumnosCurso);
    
  
    
  
                
    //print_r($alumnosCurso);
    
    
    
    foreach ($seccionesPadre as $capitulo) { 
		
		// Si no existen alumnos
		if(empty($seccionesPadre[0])){
			echo '<td colspan="6">No hay capitulos </td>';
		}
		else{
			?>
			<td valign="center">
				<div align="left">
					<a href="javascript:muestraBitacorasCapitulo(<? echo $capitulo["idSeccionBitacora"]; ?>);"><strong><? echo $capitulo["nombreSeccionBitacora"]; ?></strong></a>
				</div>
			</td>
			
			
			
			
			
			
		</tr>
		
	<? 	
		} // else (existen alumnos)
		
	} //foreach


	?>
       
</table>                
                   
                     
<div id="bitacoraSeccion"></div>