<? 
	require("inc/incluidos.php");
	require ("hdOld.php");
	$idCurso = $_SESSION["sesionIdCurso"];
	$_SESSION["sesionIdCurso"] = $idCurso; 

?>

<script language="javascript">
$(function() {
	$( "#datepicker" ).datepicker();
	$( "#datepicker2" ).datepicker();
});
	
function iniciar(){
	$(function() {
		
	$('#datepicker').datepicker({dateFormat: "yy-mm-dd"});
	$("#datepicker").datepicker($.datepicker.regional['es']);
	$("#datepicker").datepicker({ minDate: new Date(2013, 1 - 1, 1)});
	
	$('#datepicker2').datepicker({dateFormat: "yy-mm-dd"});
	$("#datepicker2").datepicker($.datepicker.regional['es']);
	$("#datepicker2").datepicker({ minDate: new Date(2013, 1 - 1, 1) });
	});
}


$(function() {
	<? /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		headers: {  
			5: { sorter: false },
			6: { sorter: false }  // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({ 
			container: $("#pager"),
			positionFixed: false,
			size:1 //Numero de registros tb
	});  
}); 

/*
function nuevoBitacoraReunion($idJornada){  
		var division = document.getElementById("nuevaBitacora");
		AJAXPOST("nuevaBitacoraUtp1.php","",division,false, iniciar);  
	}
function nuevoBitacoraAula($idJornada){  
		var division = document.getElementById("nuevaBitacora");
		AJAXPOST("nuevaBitacoraUtp2.php","",division,false, iniciar);  
	}
*/	
function nuevoBitacoraProfe(idPeril){  
		var division = document.getElementById("nuevaBitacora");
		var a = "perfil="+idPeril; 
		AJAXPOST("nuevaBitacoraProfe.php",a,division,false, iniciar);  
}

function listaBitacoraProfe(idPeril){  
		var division = document.getElementById("nuevaBitacora");
		var a = "perfil="+idPeril; 
		AJAXPOST("bitacoraUsuarioListado.php",a,division,false, iniciar);  
}

function muestraBitacoras(){  
		var division = document.getElementById("listadoBitacoras");
		AJAXPOST("bitacorasUtpListado.php","",division);  
}
	
function revisaBitacoras(){  
	window.location.href = "informeBitacorasCurso.php?idCurso="+<? echo $idCurso?>;
}
	

</script>


 
<body>

<div id="principal">
<? 
require("topMenu.php"); 
$navegacion = "Home*curso.php?idCurso=$idCurso,Bitacora*#";
require("_navegacion.php");
?>
	
	<div id="lateralIzq">
    	<? require("menuleft.php");?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
	    <? require("menuright.php");?>
    </div><!--lateralDer-->
 
    
	<div id="columnaCentro">
		<p class="titulo_curso">Bit�cora del Docente</p>
	    <hr />
    	<br />
	
		<div id="textoBienvenida">
        	<p class="textoBienvenida">
            La Bit�cora permitir� tener un registro respecto a la cobertura curricular de la 
            implementaci�n en aula del M�todo Singapur, de acuerdo a los cap�tulos y apartados 
            del texto Pensar Sin L�mites. En la Bit�cora podr� registrar peri�dicamente las 
            actividades realizadas en cada clase con los cursos que atiende en su establecimiento. 
            Esta informaci�n permitir� medir oportunamente el ritmo de trabajo alcanzado por sus 
            estudiantes y detectar qu� acciones de apoyo ser�n necesarias realizar.
			</p><br />
        </div><!--textoBienvenida-->
  
<? 
$idPerfil = $_SESSION["sesionPerfilUsuario"];  


switch($idPerfil){
	case 1: //Profesor
		boton("Ingresar Bit�cora","nuevoBitacoraProfe($idPerfil)");
		echo "&nbsp;";
		boton("Ver Bit�coras Ingresadas","listaBitacoraProfe($idPerfil)");
	break;
	
	case 3: //Jefe de UTP
	case 4:
		boton("Ingresar Bit�cora","nuevoBitacoraProfe($idPerfil)");
		echo "&nbsp;";
		boton("Ver Bit�coras Ingresadas","listaBitacoraProfe($idPerfil)");
	break;

	case 5:
	case 7:
	case 9:
	case 20:
		boton("Bit�cora Profesores","revisaBitacoras()");
	break;
}
?>

	<div id="nuevaBitacora"></div>
</div>     




  
<?
// Lleg� desde el curso profes
if (isset ($_REQUEST["idSeccionBitacora"])){
?>
	<input name="idSeccionBitacora" id="idSeccionBitacora" class="campos" type="hidden" value="<? echo @$_REQUEST["idSeccionBitacora"]; ?>" />
    <script>
		nuevoBitacoraProfe(<? echo $idPerfil?>);
	</script>
<? }

// Lleg� desde el curso profes
/*if (isset ($_REQUEST["tipoBitacora"])){
	if($_REQUEST["tipoBitacora"] == "reunion"){
	?>
		<script>
			nuevoBitacoraReunion();
		</script>    
	<?
	}else{
	?>
        <script>
            nuevoBitacoraAula();
        </script>
	<?	
	}
}*/
?>

   
<? 
	require("pie.php");
?> 
</div>
</body>
</html>
