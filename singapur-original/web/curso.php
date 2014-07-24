<? 
require("inc/incluidos.php");
$idCurso = $_REQUEST["idCurso"];
$_SESSION["sesionIdCurso"] = $idCurso; 
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$jornadas = getJornadasCurso($idCurso);

/* Registro de acceso a mi curso */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);
require ("hd.php");?>

<script language="javascript">
function nueva_bienvenida(){
	
	 var division = document.getElementById("textoBienvenida");
	 AJAXPOST("cursoBienvenidaEditar.php","",division);
	
}
</script>


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
	if($idCurso != 28){
		$navegacion = "Home*curso.php?idCurso=".$idCurso;
	}else{
		$navegacion = "Home*curso.php?idCurso=$idCurso,Curso*#";
	}
	require("_navegacion.php");

?>
    <div id="lateralIzq">
	    <? require("menuleft.php");	?>
	</div>
    
    
    
    <div id="lateralDer">
	    <? require("menuright.php");?>
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
<p class="textoBienvenida"><? echo nl2br($descripcion[0]);?></p>
<br />

</div>

<? 
///////// EDITAR BIENVENIDA

if ($idPerfil == 7 || $idPerfil == 9 || $idPerfil == 20){ // APE o Admin

?>
	<p align="right"><a href="javascript:nueva_bienvenida();">Editar Bienvenida</a></p>
    
<? 
} 


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
						
									if (count($recursos) > 0){ ?>
                                        <li>
											<div class="recursos">
												

											<? echo "<h3>".getNombreAtributoDeTabla($i,"TipoRecurso")."</h3>";  ?>
                                            <ul>
                                                <? foreach ($recursos as $rec){	
												
	//											echo getLinkRecurso($rec["idRecurso"]);
												?>
                                                        <li><? echo $rec["nombreRecurso"];?> - <a name="rec_<? echo $rec["idRecurso"];?>" href="<? getLinkRecurso($rec["idRecurso"]); ?>">[ Ver ]</a> <? getLinkRecursoDownload($rec["idRecurso"]); ?></li>
                                                 <? } ?> 
                                            
                                            </ul>
                                        
                                        	</div>
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
