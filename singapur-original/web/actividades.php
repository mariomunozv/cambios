<? 
ini_set("display_errors","ON");
require("inc/incluidos.php");

include_once("inc/_actividad.php");
include_once("inc/_pauta.php");
include_once("inc/_formulario.php");

 
function getIdsTipoPaginasActividad($idActividad){
	$sql ="SELECT * FROM actividadPagina WHERE idActividad = ".$idActividad." ORDER BY ordenActividadPagina ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
			$paginasActividad[$i] = array(
			"idActividadPagina"=> $row["idActividadPagina"],
			"idActividad"=> $row["idActividad"],
			"nombreActividadPagina" => $row["nombreActividadPagina"],
			"tipoActividadPagina" => $row["tipoActividadPagina"],
			"ordenActividadPagina" => $row["ordenActividadPagina"]);
			$i++;	
	}
	if ($i == 0){
		$paginasActividad[$i] = array();	
	} 
	return($paginasActividad);
}

function isActividad($idActividad){

	$sql ="SELECT * FROM lista WHERE idActividad = ".$idActividad." ";
	$res = mysql_query($sql);
	$isActividad = false;

	while($row = mysql_fetch_array($res)){
		$isActividad = true;
	}

	return $isActividad;
}
	
function isPautaItem($idActividad,$idUsuario){

	$sql ="SELECT * FROM pautaItem as PI inner join lista as L on PI.idLista = L.idLista WHERE  idActividad = ".$idActividad." and idUsuario = ".$idUsuario." ";
	
	$res = mysql_query($sql);
	$isPautaItem = false;

	while($row = mysql_fetch_array($res)){
		$isPautaItem = true;
	}

	return $isPautaItem;
}
	
// Curso
$idCurso = $_SESSION["sesionIdCurso"];



// Usuario
if (isset($_REQUEST["idUsuarioRevisado"])){
	// Alguien esta revisando la actividad (un asesor), viene un idusuario por GET
	$_SESSION["sesionIdUsuarioRevisado"] = $_REQUEST["idUsuarioRevisado"];
}
else{
	// Para que no se mantenga la variable de sesion si se utilizó antes
	unset($_SESSION["sesionIdUsuarioRevisado"]);
}





$idUsuario = $_SESSION["sesionIdUsuario"];	

$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$idActividad = $_REQUEST["idActividad"];

$datosActividad = getDatosActividad($idActividad);
//print_r($datosActividad);


$_SESSION["sesionIdActividad"] = $idActividad;


//registraAcceso($_SESSION["sesionIdUsuario"], 13, $idActividad);


require ("hd.php");?>

<body>
<div id="principal">
<? require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
//$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"].",".$datosActividad["tituloActividad"]."*#";
//require("_navegacion.php");

?>

	
<div id="lateralIzq">
	<? 	require("menuleft.php") ?>
</div>
    
    
<div id="lateralDer">
	<? 	require("menuright.php") ?>
</div>
    
	<div id="columnaCentro">
     
        <p class="titulo_curso"><? echo $datosActividad["tituloActividad"]; ?></p>
        <hr />
        <br />
    	<p class="textoBienvenida" align="justify">
        <? echo nl2br($datosActividad["bienvenidaActividad"]); ?>
        </p>
        
        
        
        
    <!-- Si lista no tiene idActividad entonces dejar tal cual-->
    <?if(isActividad($idActividad)){ ?>
       <center>
       	<table>
       		<tr>
       			<td>
       				<a href="<? echo $datosActividad["linkActividad"]; ?>" target="_blank"><img src="img/documentos.png"  title="Ver actividad" border="0" width="128" height="128" /></a></p>
        
       			</td>
       			<? if (isPautaItem($idActividad,$idUsuario)){?>
       			<td>
       				<a href="<? echo "actividadrevision.php?idActividad=" . $idActividad; ?>"><img src="img/lupa.png" width="50px" height="100px" title="Ver resultados" border="0" width="128" height="128" /></a></p>
        
       			</td>
       			<? } ?>
       		</tr>
       		<tr>
       			<td>
       				<a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" href="<? echo $datosActividad["linkActividad"]; ?>" target="_blank">
			       		<span class="ui-button-text">Comenzar Actividad</span>
			       </a>
       			</td>
       			<? if (isPautaItem($idActividad,$idUsuario)){?>
       			<td>
       				<a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" href="<? echo "actividadrevision.php?idActividad=" . $idActividad; ?>">
			       		<span class="ui-button-text">Revisión</span>
       				</a>
       			</td>
       			<? } ?>
       		</tr>

       	</table>

       	<br><br>

       	<? boton("Volver","history.back();"); ?>

       </center>
       	

    <? } else{ ?>
    	<p align="center"><a href="<? echo $datosActividad["linkActividad"]; ?>" target="_blank"><img src="img/documentos.png"  title="Ver actividad" border="0" width="128" height="128" /></a></p>
        
    	<p align="center"><strong><a  href="<? echo $datosActividad["linkActividad"]; ?>" target="_blank"><? echo $datosActividad["tituloActividad"]; ?></a></strong>
        <br /><br /> 
       <? boton("Volver","history.back();"); ?>
       </p>


    <? } ?>
    <? if ($datosActividad["linkActividad"] == "actividadesPagina.php"){
			
			$paginas = getIdsTipoPaginasActividad($idActividad);
			
			$_SESSION["paginasActividad"] = $paginas;
			$_SESSION["j"] = 0;
			
		}?>
      <? if ($datosActividad["linkActividad"] == "actividadesPaginaSeccion.php"){
			
			$paginas = getIdsTipoPaginasActividad($idActividad);
			
			$_SESSION["paginasActividad"] = $paginas;
			$_SESSION["j"] = 0;
			
		}
		
		//print_r($paginas);
		
		// Comentarios y Notificaciones

		////// ACTUALIZACION NOTIFICACION
		/* Se actualiza el estado de notificacion en caso de entrar a traves de las notificaciones */
		if (isset($_REQUEST["idNotificacion"])){
			$idNotificacion = $_REQUEST["idNotificacion"];
			actualizaEstadoNotificacion($idNotificacion);
			
			// Recibo el idPauta del formulario donde se hizo el comentario y obtengo el idFormulario
			$idFormulario = getIdFormulario($_REQUEST["idPauta"]);
			$datosFormulario = getDatosFormulario($idFormulario);
			// Busco la página en donde se encuentra ese formulario
			$idPaginaActual = $datosFormulario["idActividadPagina"];
			
			// Reccorro las paginas de esta actividad y si encuentro la pagina buscada dejo la variable $j para que se vaya directamente a esa pagina
			$numPagina = 0;
			foreach ($paginas as $pagina){
				if ($pagina["idActividadPagina"] == $idPaginaActual){
					$_SESSION["j"] = $numPagina;
				}
				$numPagina++;
				
			}
			
			
		}
		
		
		
		?>
       
        
      </div><!--columnaCentro-->
         
       <? //  require("misCursos.php");?>
     
               
    
              
	<? 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
