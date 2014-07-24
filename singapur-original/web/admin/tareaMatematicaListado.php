<?

require("inc/config.php");

include "../inc/_tareaMatematica.php";

?> 

<script language="javascript">

$(function() {
	<? /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		sortList: [[1,0]] 
	});  
}); 
</script>

<br />

<table class="tablesorter" id="tabla">
    <thead>         
        <tr>
            <th>ID</th>
            <th width="400">Nombre</th>
            <th>Campo</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        

		<?
    
    $arreglo = getTareasMatematicas();
    foreach($arreglo as $elemento){
        
    	?>
        <tr onmouseover="this.className='normalActive'" onmouseout="this.className='normal'" class="normal">
            <td><? echo $elemento["idTareaMatematica"]; ?> </td>
            <td><? echo $elemento["nombreTareaMatematica"]; ?> </td>
			<?
            //$nombreCampo = getNombreAtributoDeTabla($elemento["idCampo"],"Campo")
            ?>
            <td><? echo $elemento["idCampo"]; ?> </td>
            
            <td><a href="#" onclick="javascript:edit_(<? echo $elemento["idTareaMatematica"]; ?>)">Editar</a></td>
        </tr>

		<?		
	}
		
   
        
    ?>  
    </tbody> 
</table>

            