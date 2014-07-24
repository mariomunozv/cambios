<? 
require("inc/incluidos.php");



function getNRespuestasTemaUsuario($idTema,$idUsuario){
	$sql = "SELECT COUNT(*) as total FROM `mensajeTema` a left join comentario b on a.idUsuario = b.idUsuario WHERE a.idTema = ".$idTema." AND a.idUsuario = ".$idUsuario." ORDER BY fechaMensajeTema ASC";
	echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if($row["total"] > 0){
		$total = $row["total"];
		}else{
			$total = "-";
	}
	return($total);
}

function getTemasCurso($idCurso){
	$sql = "SELECT * FROM tema WHERE estadoTema = 1 and idCursoCapacitacion= ".$idCurso." ORDER BY fechaTema DESC";
	echo $sql;
	$res = mysql_query($sql);
	$temas = array();
	$i=0;
	while ($row = mysql_fetch_array($res)){
	
	$temas[$i] = array( 
		"tituloTema" => $row["tituloTema"],
		"idTema" => $row["idTema"],
		);	
	$i++;
	
	}
	
   	return ($temas);
}

function getCursosProfesor($rutProfesor){
	$sql = "SELECT * FROM cursoColegio cu join nivel ni on cu.idNivel = ni.idNivel WHERE cu.rutProfesor = '$rutProfesor' AND cu.anoCursoColegio = YEAR(NOW())";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	$cursos = array();
	while ($row = mysql_fetch_array($res)){
	
	$cursos[$i] = array( 
		"rbdColegio" => $row["rbdColegio"],
		"anoCursoColegio" => $row["anoCursoColegio"],
		"letraCursoColegio" => $row["letraCursoColegio"],
		"idNivel" => $row["idNivel"],
		"rutProfesor" => $row["rutProfesor"],
		"nombreNivel" => $row["nombreNivel"],
		"nombreCurso" => $row["nombreNivel"]." ".$row["letraCursoColegio"]." - ".$row["anoCursoColegio"]
		);	
	$i++;
	
	}
	return($cursos);
	
}



function accedioRecursoUsuario($idUsuario,$idRecurso){
	$sql = "SELECT COUNT( * ) AS veces FROM accesoRecurso WHERE idUsuario = ".$idUsuario." AND idTipoRecursoObservado = 9 AND idLinkAccesoRecurso = ".$idRecurso;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if ($row["veces"] > 0){
		
		$entro = $row["veces"];
		}else{
		$entro = "-";
		}
	return($entro);

} 

function getDatosColegio($rbdColegio){
	$sql = "SELECT * FROM colegio a left join comuna  b on a.idComuna = b.idComuna WHERE rbdColegio = ".$rbdColegio;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosColegio = array( "rbdColegio" => $row["rbdColegio"],
					  "nombreColegio" => $row["nombreColegio"],
					  "emailColegio" => $row["emailColegio"],
					  "nombreComuna" => $row["nombreComuna"],
					  "direccionColegio" => $row["direccionColegio"],
					  "telefonoColegio" => $row["telefonoColegio"],
					  "paginaWebColegio" => $row["paginaWebColegio"],
					 "logoColegio" => $row["logoColegio"] );	
	return($datosColegio);
} 


function getNombreColegio($rbdColegio){
	$sql = "SELECT nombreColegio FROM colegio WHERE rbdColegio =".$rbdColegio;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return ($row[0]);
}




require ("hd.php");



?>

<script>

$(document).ready(function() {
	// call the tablesorter plugin
	$("#orden1").tablesorter({
		// pass the headers argument and assing a object
		headers: {
			0: {sorter: false},
			1: {sorter: false},
			2: {sorter: false},
			3: {sorter: false},
			4: {sorter: false},
			5: {sorter: false},
			6: {sorter: false},
			
			
			10: {sorter: false},
			11: {sorter: false},
			12: {sorter: false},
			13: {sorter: false},
			14: {sorter: false},
			15: {sorter: false},
			16: {sorter: false},
			17: {sorter: false},
			18: {sorter: false},
			19: {sorter: false},
			20: {sorter: false},
			21: {sorter: false},
			22: {sorter: false},
			23: {sorter: false},
			24: {sorter: false},
			25: {sorter: false},			
			26: {sorter: false},
			27: {sorter: false},
			28: {sorter: false},
			29: {sorter: false},
			
			30: {sorter: false}
			
			
		}
	});
});



$(document).ready(function() 
    { 
        $("#pruebas").tablesorter(); 
    } 
); 


$(document).ready(function() 
    { 
        $("#foros").tablesorter(); 
    } 
); 
   
 function actualizaCurso(){
	
	cursoListado(document.getElementById("idCurso").value);
	
} 
function cursoListado(curso){
	
	location.href="informeParticipacion.php?idCurso="+curso;
} 
function volver(){
	
	location.href="home.php";
} 
</script>

<body>
<div id="principal">


 
    
    
 <? $idCurso = @$_REQUEST["idCurso"];
 $cursosCapacitacion = getCursosCapacitacion();?>   
    
    
    
     


<p class="titulo_curso"><? echo "Informe CURSO:"; ?></p>
    
 <? boton("Volver","volver();");?>
     
    <br />
    <table class="tablesorter">
            	<tr> 
                	<th>Curso Capacitacion</th>
                    
                </tr>
                <tr>
                	
                    <td><label>
                      <select name="idCurso" id="idCurso" onChange="actualizaCurso()">
                      		<option value=""><? echo "Seleccione un Curso";?></option>
                       <? foreach ($cursosCapacitacion as $curso){?>
                      		<option value="<? echo $curso["idCursoCapacitacion"];?>" <? if (@$idCurso == $curso["idCursoCapacitacion"]){echo 'selected="selected"';}?>><? echo $curso["nombreCortoCursoCapacitacion"];?></option>
                      <? }?>
                      </select>
                    </label></td>
                    
                </tr>
            </table>
            
            
<? 

if($idCurso >=10 and $idCurso <=17){
	




$jornadas = getJornadasCurso($idCurso);
?>            
<p class="titulo_curso"><? echo getNombreCurso(@$idCurso); ?></p>
<hr /><br>
 <table border="0" align="center" width="100%" class="tablesorter" id="orden1">
 <thead>
 <tr>
 <th colspan=3 ></th>
 <? foreach($jornadas as $jornada){
	 		@$recursos = getTiposRecursosJornada($jornada["idJornada"],9,1);
			$colspan = count($recursos); 
			echo "<th colspan='".$colspan."'>";
			echo $jornada["nombreJornada"];
            echo "</th>";
 }
 ?>
 </tr>
 


    <tr  align="center">
       
        <th width="10">E</th>
        <th width="470">Participante</th>
        <th width="287">Rol </th>
        
        <? 
		$o=0;
		foreach($jornadas as $jornada){
			$o++;
			$f=0;
		    @$recursos = getTiposRecursosJornada($jornada["idJornada"],9,1);
			
			if (count($recursos) > 0){ 
					foreach ($recursos as $rec){	
							$f++;
							echo "<th><div title='".$rec["nombreRecurso"]."'>".$f."/".$o."</div>";
							echo "</th>";
					 } 
             }
		echo "</th>";
		}?> 
                           
                       
	    
        
    </tr>
  
</thead>
<tbody>
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
	    $datosU = getDatosGenerico($value["idUsuario"]);   
		
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
		<tr <? echo $color;?> onMouseOver="this.className='normalActive'" onMouseOut="this.className='normal'" class="normal">
			
            <td><? echo $datosU["rbdColegio"];?></td>
		<?
		// Si no existen alumnos
		if(empty($alumnosCurso[0])){
			echo '<td colspan="6">No hay alumnos inscritos em el curso</td>';
		}
		else{
			?>
			<td valign="center">
				<div align="left">
					<strong><a href="#listado" onClick="muestraBitacorasProfe(<? echo $value["idUsuario"];?>)"><? echo $datosU["nombreParaMostrar"]; ?></a></strong>
				</div>
			</td>
			
			<td valign="center">
				<div align="center">
					<?
					echo getNombrePerfil($value["idPerfil"]); 
					?>
				</div>
			</td>
		<? 
		$o=0;
		foreach($jornadas as $jornada){
			$o++;
			$f=0;
		    @$recursos = getTiposRecursosJornada($jornada["idJornada"],9,1);
			if (count($recursos) > 0){ 
					foreach ($recursos as $rec){	
							$f++;
							echo "<td><div title='".$rec["nombreRecurso"]."'>".accedioRecursoUsuario($value["idUsuario"],$rec["idRecurso"])."</div></td>";
							//echo "<th><div title='".$rec["idRecurso"]."'>".$f."/".$o."</div>";
							echo "</td>";
					 } 
             }
		echo "</td>";
		}?> 	
			
			
			
		</tr>
		
	<? 	
		} // else (existen alumnos)
		
	} //foreach


	?>
 </tbody>      
</table>                

    <table border="0" align="center" width="100%" class="tablesorter" id="pruebas">
 <thead>
 <tr>
 <th colspan=3> Evaluaciones</th>
<?
	 		$pruebas[0] = array("idLista" => 13,"nombrePrueba" => "prueba1");
			
			
			foreach($pruebas as $prueba){
				$colspan = count($pruebas); 
				echo "<th colspan='".$colspan."'>";
				echo $prueba["nombrePrueba"];
				echo "</th>";
			}
 ?>
 </tr>

    <tr  align="center">
      
        <th width="400">E</th>
        <th width="470">Participante</th>
        <th width="287">Rol </th>
        <th>&nbsp;</th>
       
                           
                       
	    
        
    </tr>
  
</thead>
<tbody>
	<? 
	//print_r($_SESSION);

  
	
//	print_r($alumnosCurso);
    
    ordenar($alumnosCurso,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
    
    
                
    //print_r($alumnosCurso);
    $color = ' bgcolor ="#FFFFFF"';
    $flag = 0;
    $num = 0;
    
    
    foreach ($alumnosCurso as $i => $value) { 
 $datosU = getDatosGenerico($value["idUsuario"]); 
 
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
		<tr <? echo $color;?> onMouseOver="this.className='normalActive'" onMouseOut="this.className='normal'" class="normal">
			
            <td><? 	
			echo getNombreColegio($datosU["rbdColegio"]);
			?></td>
		<?
		// Si no existen alumnos
		if(empty($alumnosCurso[0])){
			echo '<td colspan="6">No hay alumnos inscritos em el curso</td>';
		}
		else{
			?>
			<td valign="center">
				<div align="left">
					<strong><? echo $datosU["nombreParaMostrar"]; ?></strong>
				</div>
			</td>
			
			<td valign="center">
				<div align="center">
					<?
					echo getNombrePerfil($value["idPerfil"]); 
					?>
				</div>
			</td><td>
		<? 
		$o=0;
		
		
		$cursos = getCursosProfesor($value["rutProfesor"]);
		if (count($cursos) > 0){
             echo "<table class=tablesorter><tr>";
			 foreach ($cursos as $curso){  
				  ?>

                <td><? echo $curso["idNivel"].$curso["letraCursoColegio"];?>
              
                
                  
                
  <a rel="shadowbox;height=700;width=950" href="evaluacionAlumnoResumen.php?nombreProfesor=<? echo $datosU["nombre"]." ".$datosU["apellidoPaterno"];?>&rbdColegio=<? echo $curso["rbdColegio"];?>&idNivel=<? echo $curso["idNivel"];?>&anoCursoColegio=<? echo $curso["anoCursoColegio"];?>&letraCursoColegio=<? echo $curso["letraCursoColegio"];?>&escala=<? echo $escala."&nombreNivel=".$curso["nombreNivel"];?>"><img border="0" src="img/ver.gif" width="14" height="14" alt="Ver más" title="Ver más" /> </a>
  </td>
</a>
               
             
<? 		}
	echo "</tr></table>";
 }else{ 
	 echo "NC"; 
  
  }
   ?>
		
			
			</td>
			
		</tr>
		
	<? 	
		} // else (existen alumnos)
		
	} //foreach


	?>
       
       
   </tbody>    
</table>        
<? /*////////////////////////////////////////////////// // TEMAS CURSO    

  <table border="0" align="center" width="100%" class="tablesorter" id="foros">
  <thead>
 <tr>
 <th colspan=3 ></th>
<?
	 		$temas = getTemasCurso($idCurso);
			foreach($temas as $tema){
				$colspan = count($tema); 
				echo "<th>";
				echo '<a href="temaDetalle.php?idForo='.$tema["idTema"].'&flag=1">'.$tema["tituloTema"].'</a>';

				echo "</th>";
			}
 ?>
 </tr>

    <tr  align="center">
      
        <th width="400">E</th>
        <th width="470">Participante</th>
        <th width="287">Rol </th>
        <th colspan="<? echo count($temas);?>">&nbsp;</th>
       
                           
                       
	    
        
    </tr>
  
</thead>
<tbody>
	<? 
	//print_r($_SESSION);

  
	
//	print_r($alumnosCurso);
    
    ordenar($alumnosCurso,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
    
    
                
    //print_r($alumnosCurso);
    $color = ' bgcolor ="#FFFFFF"';
    $flag = 0;
    $num = 0;
    
    
    foreach ($alumnosCurso as $i => $value) { 
 $datosU = getDatosGenerico($value["idUsuario"]);   
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
		<tr <? echo $color;?> onMouseOver="this.className='normalActive'" onMouseOut="this.className='normal'" class="normal">
			
            <td><? echo @$datosU["rbdColegio"];?></td>
		<?
		// Si no existen alumnos
		if(empty($alumnosCurso[0])){
			echo '<td colspan="5">No hay alumnos inscritos em el curso</td>';
		}
		else{
			?>
			<td valign="center">
				<div align="left">
					<strong><? echo $datosU["nombreParaMostrar"]; ?></strong>
				</div>
			</td>
			
			<td valign="center">
				<div align="center">
					<?
					echo getNombrePerfil($value["idPerfil"]); 
					?>
				</div>
			</td>
		<? 
		$o=0;
		
		
		
		if (count($temas) > 0){
             
			 foreach ($temas as $tema){  
				  ?>

                <td>
					<? echo getNRespuestasTemaUsuario($tema["idTema"],$value["idUsuario"]);?>
                 </td>
               
               
               
                </a>
               
             
<? 		}
	
 }else{ 
	 echo "ST"; 
  
  }
   ?>
		
			
			
			
		</tr>
		
	<? 	
		} // else (existen alumnos)
		
	} //foreach


	?>
       
   </tbody>    
       
</table>
*/
}else{
	echo " Debe seleccionar un curso";
	}?>
<? /////////////////////////////////TEMAS CURSO?>

           
	<? 
    
    	require("pie.php");

    ?>      

                
</div><!--principal-->
</body>
</html>
