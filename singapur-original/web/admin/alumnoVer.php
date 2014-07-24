<? //session_start();
require("inc/config.php");
require("_head.php");
$menu = "ini";
require("_menu.php"); 

$navegacion = "Inicio*inicio.php,Escuela: "."*#";
require("_navegacion.php");
$usuario = $_REQUEST["usuario"];

$datosUsuario = getDatosUsuario($usuario);


?>
<table class="tablesorter" id="tabla">

   <tbody>
  <? 
  
  $alumno = getDatosAlumno($datosUsuario["rut"]);
  
  if (count($alumno) > 0){
		
	  ?>
              
                 <tr><th>Rut</th> <td><? echo $alumno["rutAlumno"];?></td></tr>
                  <tr><th>Nombre </th> <td><? echo $alumno["nombreAlumno"];?></td></tr>
                <tr> <th>Apellido Paterno</th> <td><? echo $alumno["apellidoPaternoAlumno"];?></td></tr>
                 <tr><th>Apellido Materno </th> <td><? echo $alumno["apellidoMaternoAlumno"];?></td></tr>
                  <tr><th>Sexo</th> <td><? echo $alumno["sexoAlumno"];?></td></tr>
                <tr><th>Fecha Nacimiento </th> <td><? echo $alumno["fechaNacimientoAlumno"];?></td></tr>
             <tr><th>Tipo Usuario </th> <td><? echo $datosUsuario["tipoUsuario"];?></td></tr>
              <tr><th>Email </th> <td><? echo $datosUsuario["emailUsuario"];?></td></tr>
               <tr><th>Usuario </th> <td><? echo $datosUsuario["loginUsuario"];?></td></tr>
                <tr><th>Ultimo Acceso </th> <td><? echo $datosUsuario["ultimoAccesoUsuario"];?></td></tr>
       
               
               
              
<? 		
 }else{ 
	 echo "<tr><td colspan='12'>No existen datos de este Alumno</td></tr>"; 
  
  }
  
  ?>
</tbody>
</table>