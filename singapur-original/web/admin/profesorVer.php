<? require("inc/config.php");
require("_head.php");
$menu = "ini";
require("_menu.php"); 

$navegacion = "Inicio*inicio.php,Escuela: ".@$colegio["nombreColegio"]."*#";
require("_navegacion.php");

$rutProfesor = $_REQUEST["rutProfesor"];


?>
<table class="tablesorter" id="tabla">

   <tbody>
  <? 
  
  $profesor = getDatosProfesor($rutProfesor);
  
  if (count($profesor) > 0){
		
	  ?>
              
                 <tr><th>Rut</th> <td><? echo $profesor["rutProfesor"];?></td></tr>
                  <tr><th>Nombre </th> <td><? echo $profesor["nombreProfesor"];?></td></tr>
                <tr> <th>Apellido Paterno</th> <td><? echo $profesor["apellidoPaternoProfesor"];?></td></tr>
                 <tr><th>Apellido Materno </th> <td><? echo $profesor["apellidoMaternoProfesor"];?></td></tr>
                  <tr><th>Sexo</th> <td><? echo $profesor["sexoProfesor"];?></td></tr>
                <tr><th>Fecha Nacimiento </th> <td><? echo $profesor["fechaNacimientoProfesor"];?></td></tr>
                <tr> <th>Telefono</th>   <td><? echo $profesor["telefonoProfesor"];?></td></tr>
                 <tr> <th>email </th><td><? echo $profesor["emailProfesor"];?></td></tr>
                <tr> <th>Experiencia </th><td><? echo $profesor["anosExperienciaProfesor"];?></td></tr>
               <tr> <th>Asignatura a Cargo </th>  <td><? echo $profesor["asignaturaACargoProfesor"];?></td></tr>
                <tr> <th>CE </th><td><? echo $profesor["coordinadorEnlaceProfesor"];?></td></tr>
               
               
              
<? 		
 }else{ 
	 echo "<tr><td colspan='12'>No existen datos de este profesor</td></tr>"; 
  
  }
  
  ?>
</tbody>
</table>