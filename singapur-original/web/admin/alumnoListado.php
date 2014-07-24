<?
ini_set('display_errors','On');
require("inc/config.php"); 
require("inc/funcionesAdmin.php");
$rbdColegio = $_REQUEST["rbdColegio"];
$idNivel = $_REQUEST["idNivel"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];


?>

<script>
function activaDesactiva(rutAlumno,modo){
	var division = document.getElementById("activa");
	AJAXPOST("cargaMasivaAlumnos.php","modo="+modo+"&rut="+rutAlumno,division);
	
} 
</script>
<h2>Alumnos</h2>
<a class="button" href="javascript:newAlumno();"><span><div class="add"><? echo "Nuevo Alumno"; ?></div></span></a>
<a class="button" href="javascript:cargaMasiva();"><span><div class="add"><? echo "Cargar Listado Alumnos"; ?></div></span></a>


<table class="tablesorter" id="tabla"> 
   <thead>         
  <tr>
  <th>N</th>
    <th>Usuario</th>
    <th>Nombre </th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    
    
    
	<th>Opciones</th>
   
  </tr>
  </thead>
  <tbody>
 
  <? 
  
$alumnos = getAlumnosCurso($rbdColegio,$idNivel,$anoCursoColegio,$letraCursoColegio);
 
  
  if (count($alumnos) > 0){
	  $i = 1;
		foreach ($alumnos as $alumno){ 

		if($alumno["estadoAlumno"] == 1){
			$modo = "Desactivar";
			}else{
				
			$modo = "Activar";
				}

	
	  ?>
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='normal'" class="normal">
              <td><? echo $i;?></td>
                <td><? echo $alumno["usuario"];?></td>
                <td><? echo $alumno["nombreAlumno"];?></td>
                <td><? echo $alumno["apellidoPaternoAlumno"];?></td>
                <td><? echo $alumno["apellidoMaternoAlumno"];?></td>
                <td><a href="javascript:editAlumno('<? echo $alumno["usuario"]; ?>');" >Editara</a> -  
                <a href="alumnoVer.php?usuario=<? echo $alumno["usuario"];?>">Ver +</a>
                <a href="javascript:activaDesactiva('<? echo $alumno["rutAlumno"]; ?>','<? echo $modo;?>');"><? echo $modo;?></a></td>
               
              </tr>
<? 	$i++;	}
 }else{ 
	 echo "<tr><td colspan='12'>No existen Alumnos en este curso.</td></tr>"; 
  
  }
  
  ?>
   <div id="activa"></div>
 </tbody> 
</table>