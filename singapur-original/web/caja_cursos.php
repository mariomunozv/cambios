<? 
$idCurso = $_SESSION["sesionIdCurso"];
?>
<script language="javascript">
function cambiaCurso(idCurso){
	if(idCurso != 28){
		window.location.href="curso.php?idCurso="+idCurso;
	}else{
		window.location.href="mural.php?idCurso="+idCurso;
	}
}
</script>


<? $cursosUsuario = getCursosUsuario($_SESSION["sesionIdUsuario"]);?>
<div class="titulo_div">Selecci&oacute;n de Secci&oacute;n</div>

<div class="info_div">
<p>Escoja la secci&oacute;n de su curso a la cual desea acceder</p><br/>
<select name="cambiaCurso" id="cambiaCurso" onchange="cambiaCurso(this.value)" style="width:100%">
<? foreach ($cursosUsuario as $datosCurso){ 
	if($datosCurso["idCursoCapacitacion"] == $idCurso)
	{ ?>
		<option value="<? echo $datosCurso["idCursoCapacitacion"]?>" selected="selected"><? echo $datosCurso["nombreCortoCursoCapacitacion"];?></option>
<? }else { ?>
	<option value="<? echo $datosCurso["idCursoCapacitacion"]?>"><? echo $datosCurso["nombreCortoCursoCapacitacion"];?></option>
<? }} ?>
</select>
</div>