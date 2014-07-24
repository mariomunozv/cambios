<? require("inc/config.php");
require("../inc/_profesor.php");
$rbdColegio = $_REQUEST["rbdColegio"];
?>
<table class="tablesorter" id="tabla">

   <thead>         
  <tr>
    <th>Rut</th>
    <th>Nombre </th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno </th>
    <th>Sexo</th>
    <th>Fecha Nacimiento </th>
    <th>Telefono</th>  
    <th>email </th>
    <th>Experiencia </th>
    <th>Asignatura a Cargo </th> 
    <th>CE </th>
    
	<th>Opciones</th>
   
  </tr>
  </thead>
  <tbody>
  <? 
   
  $profesores = getProfesoresColegio($rbdColegio);
 
  
  if (count($profesores) > 0){
		foreach ($profesores as $profesor){  
	  ?>
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='normal'" class="normal">
                <td><? echo $profesor["rutProfesor"];?></td>
                <td><? echo $profesor["nombreProfesor"];?></td>
                <td><? echo $profesor["apellidoPaternoProfesor"];?></td>
                <td><? echo $profesor["apellidoMaternoProfesor"];?></td>
                <td><? echo $profesor["sexoProfesor"];?></td>
                <td><? echo $profesor["fechaNacimientoProfesor"];?></td>
                <td><? echo $profesor["telefonoProfesor"];?></td>
                <td><? echo $profesor["emailProfesor"];?></td>
                <td><? echo $profesor["anosExperienciaProfesor"];?></td>
                <td><? echo $profesor["asignaturaACargoProfesor"];?></td>
                <td><? echo $profesor["coordinadorEnlaceProfesor"];?></td>
                <td>Editar - Activar - <a href="profesorVer.php?rutProfesor=<? echo $profesor["rutProfesor"];?>">Ver +</a></td>
               
              </tr>
<? 		}
 }else{ 
	 echo "<tr><td colspan='12'>No existen profesores</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>