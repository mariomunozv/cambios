<? 
require("inc/incluidos.php");
require ("hd.php");

function DatosUsuario($idUsuario){
	$sql = "SELECT * from usuario WHERE idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosUsuario = array("rutAlumno" => $row["rutAlumno"],"rutProfesor" => $row["rutProfesor"],"tipoUsuario" => $row["tipoUsuario"]);
	return($datosUsuario);
	
	}

function cuentaAlumnosCurso($letraCursoColegio,$anoCursoColegio,$rbdColegio,$idNivel){
	$sql = "SELECT Count(rutAlumno) AS resultado FROM matricula where rbdColegio = '$rbdColegio' and idNivel = $idNivel and anoCursoColegio = $anoCursoColegio and letraCursoColegio = '$letraCursoColegio'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	echo $row["resultado"];
	
	}

function getCursosProfesor($rutProfesor){
	$sql = "SELECT * FROM cursoColegio cu join nivel ni on cu.idNivel = ni.idNivel WHERE cu.rutProfesor = '$rutProfesor'";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	$cursos = array();
	while ($row = mysql_fetch_array($res)){
	
	$cursos[$i] = array( 
		"rbdColegio" => $row["rbdColegio"],
		"anoCursoColegio" => $row["anoCursoColegio"],
		"letraCursoColegio" => $row["letraCursoColegio"],
		"idNivel" => $row["idNivel"],
		"rutProfesor" => $row["rutProfesor"],
		"nombreNivel" => $row["nombreNivel"],
		"nombreCurso" => $row["nombreNivel"]." ".$row["letraCursoColegio"]." - ".$row["anoCursoColegio"]
		);	
	$i++;
	
	}
	return($cursos);
	
}

if(@$_REQUEST["escala"] != ""){
	$escala = $_REQUEST["escala"];
}else{
	$escala = 0.5;
	}
if($_SESSION["sesionIdCurso"] == 1 || $_SESSION["sesionIdCurso"] == 2 || $_SESSION["sesionIdCurso"] == 3  ){
	$pruebas = array(1,4);
	
	}
if($_SESSION["sesionIdCurso"] == 4 || $_SESSION["sesionIdCurso"] == 5 || $_SESSION["sesionIdCurso"] == 6  ){
	$pruebas = array(2,5);
	
	}
if($_SESSION["sesionIdCurso"] == 7 ){
	$pruebas = array(3,6);
	
	$noEntrar = 1;
	}	
//registraAcceso($_SESSION["sesionIdUsuario"], 17, 'NULL'); 
$datosUsuario = DatosUsuario($_SESSION["sesionIdUsuario"]);

?>
<script>
function muestraCurso(rbdColegio,idNivel,anoCursoColegio,letraCursoColegio,escala,nombreNivel,idLista){
	
	a = "rbdColegio="+rbdColegio+"&idNivel="+idNivel+"&anoCursoColegio="+anoCursoColegio+"&letraCursoColegio="+letraCursoColegio+"&escala="+escala+"&nombreNivel="+nombreNivel+"&idLista="+idLista;
	var division = document.getElementById("lugarCarga");
	AJAXPOST("evaluacionAlumnoListadoResumen.php",a,division);
	
} 
</script>


<body> 


<div id="principal">
<? require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <? 
		require("caja_misCursos.php");
        require("caja_glosarioPalabra.php");
       require("caja_participantes.php");
        require("caja_mensajes.php");
	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
  
		<? 
        require("caja_bienvenida.php");
        require("caja_calendario.php");
        ?>
    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     
		
       <div id="tituloPagina"><h1>Mis Cursos</h1></div><br>

<p>
En el siguiente listado usted encontrará los cursos que tiene asignados en el Sistema. Para ingresar al listado de los alumnos debe presionar<img src="img/ver.gif" width="14" height="14" alt="Ver más" title="Ver más" /> <strong>"Ver más"</strong>. 
</p>


<table class="tablesorter" id="tabla">
   <thead> 
          
  <tr>
    <th>Curso</th>
    <th>Año</th>
    <th>Profesor Jefe </th>
    
	<th>N alumnos</th>
    <th>Opciones</th>
  </tr>
  </thead>
  <tbody> 
  <? 
  
  $cursos = getCursosProfesor($datosUsuario["rutProfesor"]);
 

  if (count($cursos) > 0){
		foreach ($cursos as $curso){  
		
$nombre = getNombreProfesor($datosUsuario["rutProfesor"]);

	  ?>
              <tr onMouseOver="this.className='normalActive'" onMouseOut="this.className='normal'" class="normal">
                <td><? echo $curso["nombreNivel"]." ".$curso["letraCursoColegio"];?></td>
                <td><? echo $curso["anoCursoColegio"];?></td>
                <td><? echo $nombre;?> </td>
                  <td><? cuentaAlumnosCurso($curso["letraCursoColegio"],$curso["anoCursoColegio"],$curso["rbdColegio"],$curso["idNivel"]);?> </td>
                
  <td>
  <? 
  $i=0;
  foreach ($pruebas as $idLista){
	  $i++;
	 // echo $idLista."<-";
	  ?>
  <a href="javascript:muestraCurso(<? echo $curso["rbdColegio"];?>,<? echo $curso["idNivel"];?>,<? echo $curso["anoCursoColegio"];?>,'<? echo $curso["letraCursoColegio"];?>',<? echo $escala.",'".$curso["nombreNivel"]."',".$idLista; ?>)"><img border="0" src="img/ver.gif" width="14" height="14" alt="Ver más" title="Ver más" /> Prueba <? echo $i;?></a>
  <? } ?>
  
  </td>
               
               
               
                </a>
               
              </tr>
<? 		}
 }else{ 
	 echo "<tr><td colspan='5'>No existen Cursos asociados a este profesor</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>

            
           
  <div id="lugarCarga"></div>          
      
  <?
if(@$_SESSION["sesionRbdColegio"] != ""){?>
	<script>

	
	
	muestraCurso(<? echo $_SESSION["sesionRbdColegio"];?>,<? echo $_SESSION["sesionIdNivel"];?>,<? echo $_SESSION["sesionAnoCursoColegio"];?>,'<? echo $_SESSION["sesionLetraCursoColegio"];?>',<? echo $escala.","."'".$_SESSION["sesionNombreNivel"]."'"; ?>);

		
	</script>
	<?
	}
?>      
        
			
    </div> <!--columnaCentro-->

	<? 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>
