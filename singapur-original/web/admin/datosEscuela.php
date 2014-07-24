<? require("inc/config.php");

require("../inc/_colegio.php");

?>
<? 
$rbdColegio = $_REQUEST["rbdColegio"];
$colegio = getDatosColegio($rbdColegio);?>
<p> <table class="tablesorter" >
   <thead>         
  <tr>
    <th>RBD</th>
    <th>Nombre </th>
    <th>Comuna</th>
    <th>Email</th>
    <th>Direccion</th>
    <th>Telefono</th>
    <th>Web</th> 
    <th>Logo</th>
	<th>Opciones</th> 
   
  </tr> 
  </thead>
  <tbody>
  <? 
  

  
 
		
	  ?>
              <tr>
                <td><? echo $colegio["rbdColegio"];?></td>
                <td><? echo $colegio["nombreColegio"];?></td>
                <td><? echo $colegio["nombreComuna"];?></td>
                <td><? echo $colegio["emailColegio"];?></td>
                 <td><? echo $colegio["direccionColegio"];?></td>
                  <td><? echo $colegio["telefonoColegio"];?></td>
                   <td><? echo $colegio["paginaWebColegio"];?></td>
                   <td><? echo $colegio["logoColegio"];?></td>
                <td>Editar </td>
               
              </tr>
<? 		
 
  
  ?>
 </tbody> 
</table>