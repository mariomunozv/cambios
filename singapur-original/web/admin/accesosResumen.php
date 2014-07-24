<? 
//session_start();
require("inc/config.php");
require("../inc/_detalleColegioProyecto.php");
require("../inc/_usuario.php");
require("../inc/_profesor.php");
require("../inc/_empleadoKlein.php");
require("../inc/_cursoCapacitacion.php");

require("../inc/_funciones.php");



function getCursosUsuario($idUsuario){
	$sql = "SELECT * FROM `inscripcionCursoCapacitacion` a join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$datosCursosUsuario[$i] = array(
			"idCursoCapacitacion"=> $row["idCursoCapacitacion"],
			"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"],
			"nombreCursoCapacitacion" => $row["nombreCursoCapacitacion"]
			);
		$i++;
	}
	if ($i == 0){
		$datosCursosUsuario[$i] = array();	
	} 
	return($datosCursosUsuario);
}
require("_head.php");
$menu = "ini";
//require("_menu.php"); 
$navegacion = "Inicio*inicio.php";
//require("_navegacion.php");
 
$cursosCapacitacion = getCursosCapacitacion();

/*if($_REQUEST["modo"] == "aceptar"){
	$sql = "update evaluacion set eva_decision = 'A', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}
if($_REQUEST["modo"] == "rechazar"){
	$sql = "update evaluacion set eva_decision = 'R', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}*/
?>
<script language="javascript">

$(document).ready(function() 
    { 
        $("#tab").tablesorter(); 
    } 
); 


function actualizaCurso(){
	
	cursoListado(document.getElementById("idCurso").value);
	
} 
function cursoListado(curso){
	
	location.href="accesosResumen.php?idCurso="+curso;
} 
function volver(){
	
	location.href="../home.php";
} 
class_activo('boton_accesos','activo');

</script>
<span class="titulo_form">Adminitracion Sistema</span><br />
<br />

 <? boton("Volver","volver();");?>
<table class="tablesorter" >
            	<tr> 
                	<th>Curso Capacitacion</th>
                    
                </tr>
                <tr>
                	
                    <td><label>
                      <select name="idCurso" id="idCurso" onchange="actualizaCurso()">
                      		<option value=""><? echo "Seleccione un Curso";?></option>
                       <? foreach ($cursosCapacitacion as $curso){?>
                      		<option value="<? echo $curso["idCursoCapacitacion"];?>" <? if (@$idCurso == $curso["idCursoCapacitacion"]){echo 'selected="selected"';}?>><? echo $curso["nombreCortoCursoCapacitacion"];?></option>
                      <? }?>
                      </select>
                    </label></td>
                    
                </tr>
            </table>
<? 
	
	function getTiposAccesos(){
		
		$sql = "SELECT * FROM tipoRecursoObservado";
		$res = mysql_query($sql);
		$i =0;
					while ($row = mysql_fetch_array($res)) {
						$tipoRecurso[$i] = array(
						"idTipoRecursoObservado" => $row["idTipoRecursoObservado"],
						"nombreRecursoObservado" => $row["nombreRecursoObservado"],
						"categoriaRecursoObservado" => $row["categoriaRecursoObservado"]
						);	
					$i++;
					}
					
					return($tipoRecurso);
		
		}
   
	
		  function getAccesosUsuario($idUsuario){
			  	$sql = "SELECT * FROM `accesoRecurso` a left join tipoRecursoObservado b on a.idTipoRecursoObservado = b.idTipoRecursoObservado WHERE idUsuario = ".$idusuario;

				$res = mysql_query($sql);
				$i =0;
					while ($row = mysql_fetch_array($res)) {
						if ($row["idLinkAccesoRecurso"] != ""){
							$nombreRecurso = getNombreRecurso($row["idLinkAccesoRecurso"]);
							}else{
							$nombreRecurso = "";	
						}
						$acceso[$i] = array(
						"idAccesoRecurso" => $row["idAccesoRecurso"],
						"idUsuario" => $row["idUsuario"],
						"idTipoRecursoObservado" => $row["idTipoRecursoObservado"],
						"fechaAccesoRecurso" => $row["fechaAccesoRecurso"],
						"nombreRecursoObservado" => $row["nombreRecursoObservado"],
						"categoriaRecursoObservado" => $row["categoriaRecursoObservado"],
						"nombreRecurso" => $nombreRecurso
						);	
					$i++;
					}
					
					return($accesoUsuario);
		 }
			  
			  function getNombreRecurso($idRecurso){
					  $sql = "SELECT * FROM recurso WHERE idRecurso = ".$idRecurso;
					  //echo $sql;
					  $res = mysql_query($sql);
					  $row = mysql_fetch_array($res);
					  $nombre = $row["nombreRecurso"];
					  return ($nombre);
				  }
//	      $acceso = getAccesos();
		 // print_r($acceso);
		// echo $acceso[0]["idAccesoRecurso"]."<--";		  
		  ?>
          <?
 function getNombrePerfil ( $idPerfil){
	$sql = " SELECT * FROM `perfil` WHERE idPerfil = ".$idPerfil;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["nombrePerfil"];
	
}



function getAlumnosCurso($idCursoCapacitacion){
$sql = "SELECT * FROM `inscripcionCursoCapacitacion` WHERE idCursoCapacitacion= ".$idCursoCapacitacion ;
$res = mysql_query($sql);
$i=0;
	while($row = mysql_fetch_array($res)){
			$alumnosCurso[$i] = array(
			"idUsuario"=> $row["idUsuario"],
			"idPerfil"=> $row["idPerfil"]);
			
			$i++;	
	}
	if ($i == 0){
		$alumnosCurso[$i] = array();	
	} 
		
	return($alumnosCurso);
	
}


function getAccesoTipoUsuario($idTipo,$idUsuario){
	$sql ="SELECT COUNT(*)  FROM `accesoRecurso` WHERE `idUsuario` = ".$idUsuario."  AND `idTipoRecursoObservado` = ".$idTipo;
//	$sql = "SELECT COUNT(*) FROM accesoRecurso WHERE idAccesoRecurso = "."'$idTipo'"." AND idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
//	echo $sql." - ";
	$accesos = mysql_result($res,0);
	echo $accesos;
	return;
	}
	
$idCurso = @$_REQUEST["idCurso"];
$tipoAcceso = getTiposAccesos();

if($idCurso >=10 and $idCurso <=17){
	
?>


<table border="0" align="center" width="100%" class="tablesorter" id="tab">
  <thead>                    
    <tr align="center" bgcolor="#CCCCCC">
    	 <th width="500">Colegio</th>
         <th width="500">Nombre                    </th>
         <? foreach ($tipoAcceso as $valor){?>
                      <th width="60"><? echo $valor["nombreRecursoObservado"];?></th>
         <?  }?>
         <th>Detalle</th>
    </tr>
    </thead>
    <tbody>
    <? $alumnosCurso = getAlumnosCurso($idCurso);
	$color = ' bgcolor ="#FFFFFF"';
	$flag = 0;
	foreach ($alumnosCurso as $i => $value) { 
				$datosU = getDatosGenerico($value["idUsuario"]);   
					
					if ($flag == 0){
							$flag = 1;
							$color = "#FEFFc0";
					}
					else{
						$flag = 0;
						$color = ' bgcolor ="#FFFFFF"';
				}
				?>
                
              
                          <tr bgcolor="<? echo $color;?>" class="ui-state-highlight">
                              
						<?
						// Si no existen clases en la bitacora se despliega un mensaje con un colspan
                       
                        ?> <td><? echo @$datosU["nombreColegio"];?></td>
                            <td valign="center">
                              <div align="left"><a href="accesosUsuario.php?idUsuario=<? echo $value["idUsuario"];?>">
							  <? echo $datosU["nombreParaMostrar"]; ?>                              </a></div></td><? $user = $value["idUsuario"]; ?>
                              <? foreach ($tipoAcceso as $valor){?>
                            <td valign="center"><div align="center">
                                <? echo getAccesoTipoUsuario($valor["idTipoRecursoObservado"],$value["idUsuario"]); ?>
                              </div></td><? } ?> 
                              <td><a href="accesosUsuarioActividad.php?idUsuario=<? echo $user; ?>">ver</a></td>
                            
  </tr>
       
                        
				<? 	
						// else (existen clases en la bitacora)
                } //foreach
                ?>
                   </tbody>
                  </table>
                  

                
            
                

<? }else{
	echo " Debe seleccionar un curso";
	}?>

<? require("_pie.php"); ?>
