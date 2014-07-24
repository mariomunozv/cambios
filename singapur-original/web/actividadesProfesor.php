<? 
require("inc/incluidos.php");

$idPerfil =  $_SESSION["sesionPerfilUsuario"];
/* Registro de acceso a mi curso */
$idProfesor = $_REQUEST["id"];
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);


require ("hd.php");

function getListaActividades($idProfesor){

    $sql = "SELECT L.idLista,A.tituloActividad FROM pautaItem as PI
            inner join lista as L on PI.idLista = PI.idLista
            inner join actividad as A on A.idActividad = L.idActividad
            WHERE idUsuario = ".$idProfesor." and L.idActividad IS NOT NULL 
            group by L.idLista,A.tituloActividad";

    $res = mysql_query($sql);

    while($row = mysql_fetch_array($res)){
            $listaActividades[] = array(
            "idLista"=> $row["idLista"],
            "tituloActividad"=> $row["tituloActividad"]);  
    }

    return $listaActividades;
}

?>

<script language="javascript">
function nueva_bienvenida(){
	
	 var division = document.getElementById("textoBienvenida");
	 AJAXPOST("cursoBienvenidaEditar.php","",division);
	
}

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
	
	require("_navegacion.php");

?>
    <div id="lateralIzq">
	    <? require("menuleft.php");	?>
	</div>
    
    
    
    <div id="lateralDer">
	    <? require("menuright.php");?>
    </div><!--lateralDer-->
    
    <div id="columnaCentro" >

    <p class="titulo_curso">Actividades Profesor</p>
    <br>
    <? $datos = getRutNombre($idProfesor);

       foreach($datos as $row){
            echo "<h3>Rut: ".$row["rutProfesor"]."</h3>";
            echo "<h3>Nombre: ".$row["nombreProfesor"] . " ". $row["apellidoPaternoProfesor"]."</h3>";
       }

    ?>
     
    
    <? 
        $listaActividades = getListaActividades($idProfesor);
       
    ?>

    <table class="tablesorter">
        <thead>
            <th><center>Titulo Actividad</center></th>
            <th></th>
        </thead>
        <tbody>
            <? foreach($listaActividades as $row){
                $idLista = $row["idLista"];
            ?>
                <tr>
                <td><center><?echo $row["tituloActividad"]?></center></td>
                <td><center><a href="<? echo "actividadesIntentos.php?idProfesor=".$idProfesor."&idLista=".$idLista."";?>">Ver Intentos</a></center></td>
                </tr>
            <? } ?>
        </tbody>
    </table>

    <center><? boton("Volver","history.back();"); ?></center>
     
       
    </div>
   
    
              
	<? 
    
    	require("pie.php");

    ?>      

                
</div><!--principal-->
</body>
</html>
