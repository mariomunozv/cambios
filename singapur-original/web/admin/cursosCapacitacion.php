<? 

 ini_set('display_errors','On');

//session_start();
require("inc/config.php");
require("../inc/_colegio.php");
require("../inc/_detalleColegioProyecto.php");
require("../inc/_profesor.php");
//require("../inc/_directivo.php");
require("../inc/_empleadoKlein.php");
require("../inc/_cursoCapacitacion.php");
require("../inc/_usuario.php");
require("../inc/_perfil.php");



require("_head.php"); 
$menu = "ini"; 
require("_menu.php");  
$navegacion = "Inicio*inicio.php";
require("_navegacion.php");
 

?>


<script language="javascript">

function new_cursoCapacitacion(){
	var division = document.getElementById("curso_nuevo");
	AJAXPOST("cursoCapacitacionNuevo.php","",division);
} 

function usuariosListado(){
	
	var division = document.getElementById("listaUsuarios");
	AJAXPOST("usuarioListado.php","",division);
	
} 
function actualizaCurso(){
	
	cursoListado(document.getElementById("idCurso").value);
	
} 
function cursoListado(curso){
	
	var division = document.getElementById("listaCurso");
	AJAXPOST("cursoCapacitacionListado.php","idCurso="+curso,division);
	
} 



function new_(){
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST("escuelaNuevo.php","",division);
} 

class_activo('boton_curso','activo');

</script>

<p>
<span class="titulo_form">Adminitracion Sistema</span>




<? 
$colegios = getColegiosProyecto(1);

$tiposUsuarios = getTiposUsuario();

$cursosCapacitacion = getCursosCapacitacion();
$perfiles = getPerfiles();




?>


<form name="form" action="" method="POST" enctype="multipart/form-data">
	<div id="lugar_de_carga"></div>  
	</form>
    <a class="button" href="javascript:new_cursoCapacitacion();">
        <span>
            <div class="add">
            	<? echo "Nuevo Curso"; ?>
            </div>
        </span>
    </a>
            
<br />
<br />
  <div id="guarda"></div>
<div id="curso_nuevo"></div>

<div class="caja">
<p>Usuarios</p>
<table class="tablesorter">
            	<tr>
                	
                    <th>Colegio</th>
                    <th>Tipo Usuario</th>
                    <th>Perfil</th>
                </tr>
                <tr>
                	
                    <td><label>
                      <select name="rbdColegio" id="rbdColegio" onchange="actualizarLista();">
                      <? foreach ($colegios as $colegio){?>
                      		<option value="<? echo $colegio["rbdColegio"];?>"><? echo $colegio["nombreColegio"];?></option>
                      <? }?>
                      </select>
                    </label></td>
                    <td><select name="select2" id="select2">
                     <? foreach ($tiposUsuarios as $tipo){?>
                      		<option value="<? echo $tipo["tipoUsuario"];?>"><? echo $tipo["tipoUsuario"];?></option>
                      <? }?>
                    </select></td>
                     <td><select name="perfil" id="perfil" class="campos">
                     <? foreach ($perfiles as $perfil){?>
                      		<option value="<? echo $perfil["idPerfil"];?>"><? echo $perfil["nombrePerfil"];?></option>
                      <? }?>
                    </select></td>
                    
                </tr>
            </table>
<div id="listaUsuarios"></div>


</div>

<div class="caja"><p>Cursos</p><table class="tablesorter">
            	<tr> 
                	<th>Curso Capacitacion</th>
                    
                </tr>
                <tr>
                	
                    <td><label>
                      <select name="idCurso" id="idCurso" onchange="actualizaCurso()">
                      		<option value="">Seleccione Curso</option>
                       <? foreach ($cursosCapacitacion as $curso){?>
                      		<option value="<? echo $curso["idCursoCapacitacion"];?>"><? echo $curso["nombreCortoCursoCapacitacion"];?></option>
                      <? }?>
                      </select>
                    </label></td>
                    
                </tr>
            </table>
            <div id="listaCurso"></div>
</div>


<script language="javascript">
	usuariosListado();
</script>      
<? require("_pie.php"); ?>
