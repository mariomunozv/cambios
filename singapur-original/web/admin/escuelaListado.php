<? require("inc/config.php");
require("../inc/_detalleColegioProyecto.php");
?> 
 <p> <table class="tablesorter" id="tabla">
   <thead>         
  <tr>
    <th>RBD</th>
    <th>Nombre </th>
    <th>Comuna</th>
    <th>Email</th>
	<th>Opciones</th>
    
  </tr>
  </thead>
  <tbody>
  <? 
 
    $colegios = getColegios(1);

  
  if (count($colegios) > 0){
		foreach ($colegios as $colegio){  
	  ?> 
              <tr>
                <td><? echo $colegio["rbdColegio"];?></td>
                <td><? echo $colegio["nombreColegio"];?></td>
                <td><? echo $colegio["nombreComuna"];?></td>
                <td><? echo $colegio["emailColegio"];?></td>
                <td>Editar - Activar - <a href="escuelaDetalle.php?rbdColegio=<? echo $colegio["rbdColegio"];?>">Ver Ficha</a></td>
               
              </tr>
<? 		}
 }else{ 
	 echo "<tr><td colspan='5'>No existen colegio registrados</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>