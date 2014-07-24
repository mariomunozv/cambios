<? 
require("inc/incluidos.php");

$idCurso = $_REQUEST["idCurso"];
$_SESSION["sesionIdCurso"] = $idCurso; 
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$jornadas = getJornadasRecurso($idCurso);

/* Registro de acceso a mi curso */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);
require ("hd.php");?>

<script>
function registraMuestra(link,idRecurso){
	
	//alert(link+"--"+idRecurso);
	location.target="n";
	location.href='recurso.php?idRecurso='+idRecurso;
	
	}	
</script>

<body>
<div id="principal">
<? 
	require("topMenu.php");
	$navegacion = "Home*curso.php?idCurso=$idCurso,Recursos*#";
	require("_navegacion.php")


 ?>
    <div id="lateralIzq">
    
    <? 
		require("menuleft.php");
	?>
	</div>
    
    
    
     <div id="lateralDer">
    <? 		
		require("menuright.php");
	?>
    
    
    </div><!--lateralDer-->
    
     <div id="columnaCentro" >
     
<p class="titulo_curso"><? echo getNombreCurso($idCurso); ?></p>
    <hr />
    <br />
<? 

$descripcionTotal = $datosCurso2["descripcionCursoCapacitacion"];
$descripcion =  explode("#", $descripcionTotal);


?>
<div id="textoBienvenida">
<p class="textoBienvenida"><? echo nl2br($descripcion[2]);?></p>
<br />

</div>

 
<? 

$i = 0;
	foreach ($jornadas as $value){	   
	$i++; ?>  

        <div id="cajaCentralFondo" >
        <div id="cajaCentralTop">
        	<p class="titulo_jornada">
			<? 
                echo @$value["nombreJornada"];
            ?>
            </p>
    	</div>
        
        <div id="textoJornada">
			<? echo @nl2br($value["descripcionJornada"]);?>
		</div>
        <br>
    	

            <ul >
                <li>
				   <? 
                   for ($i = 1; $i <= 6; $i++){
                   
                   ?>
                       
                       
                       <ul >
                        <? @$recursos = getTiposRecursosJornada($value["idJornada"],$idPerfil,$i);
							//print_r($recursos);
						
									if (count($recursos) > 0){ 
										
									?>
                                    
                                        <li><? echo getNombreAtributoDeTabla($i,"TipoRecurso")  ?>
                                            <ul>
                                                <? foreach ($recursos as $rec){	?>
                                                         <li><? echo $rec["nombreRecurso"];?> - <? getLinkRecursoDownload($rec["idRecurso"]); ?></li>
                                                 <? } ?> 
                                            
                                            </ul>
                                        
                                        </li>
                                   <? } ?> 
                           
                       </ul>
					<? 
					}
					   
					?>
     
                </li>
            </ul>
        <div id="cajaCentralDown">&nbsp; </div>
        </div>
        
        <br />
<? }?>
    
      </div> 
    
     
       <? //  require("misCursos.php");?>
     
               
    
              
	<? 
    
    	require("pie.php");

    ?>      

                
</div><!--principal-->
</body>
</html>
