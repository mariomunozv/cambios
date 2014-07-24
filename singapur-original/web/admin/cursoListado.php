
<? require("inc/config.php"); 
require("inc/funcionesAdmin.php");
ini_set('display_errors','On');

$rbdColegio = $_REQUEST["rbdColegio"];

function cuentaAlumnosCurso($letraCursoColegio,$anoCursoColegio,$rbdColegio,$idNivel){
	$sql = "SELECT Count(rutAlumno) AS resultado FROM matricula where rbdColegio = '$rbdColegio' and idNivel = $idNivel and anoCursoColegio = $anoCursoColegio and letraCursoColegio = '$letraCursoColegio'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	echo $row["resultado"];
	
	}

?>
<table class="tablesorter" id="tabla">
   <thead>         
  <tr>
    <th>Curso</th>
    <th>Año</th>
    <th>Profesor Jefe </th>
    
	<th>N alumnos</th>
    <th>Opciones</th>
  </tr>
  </thead>
  <tbody> 
  <? 
  
  $cursos = getCursosColegio($rbdColegio);
 

  if (count($cursos) > 0){
		foreach ($cursos as $curso){  
		
	  ?>
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='normal'" class="normal">
                <td><? echo $curso["nombreNivel"]." ".$curso["letraCursoColegio"];?></td>
                <td><? echo $curso["anoCursoColegio"];?></td>
                <td><? echo $curso["nombreProfesor"];?> <? echo $curso["apellidoPaternoProfesor"];?></td>
                  <td><? cuentaAlumnosCurso($curso["letraCursoColegio"],$curso["anoCursoColegio"],$rbdColegio,$curso["idNivel"]);?> </td>
                
                <td>Editar - Activar - <a href="cursoDetalle.php?rbdColegio=<? echo $rbdColegio;?>&idNivel=<? echo $curso["idNivel"];?>&anoCursoColegio=<? echo $curso["anoCursoColegio"];?>&letraCursoColegio=<? echo $curso["letraCursoColegio"];?>">Ver Ficha</a></td>
               
               
              </tr>
<? 		}
 }else{ 
	 echo "<tr><td colspan='5'>No existen Cursos en este colegio</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>