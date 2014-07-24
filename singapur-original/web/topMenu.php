<?

//print_r($_SESSION);
$idCurso = $_SESSION["sesionIdCurso"];
?>
	<div id="cabecera">
    	<img src="img/header.jpg" width="950" height="170"> 
     	<div id="styletwo">
            <ul>
            <? if (@$_SESSION["sesionNombreUsuario"] != ""){?>
                <? if (@$_SESSION["sesionPerfilUsuario"] == 3 || @$_SESSION["sesionPerfilUsuario"] == 4 && $idCurso == '28' ){
					?><li><a href="mural.php?idCurso=<? echo @$_SESSION["sesionIdCurso"]; ?>">Home</a></li><?
					}else{?>
					  <li><a href="curso.php?idCurso=<? echo @$_SESSION["sesionIdCurso"]; ?>">Home</a></li>
                <? } ?>
                <? if (@$_SESSION["sesionPerfilUsuario"] == 3 || @$_SESSION["sesionPerfilUsuario"] == 4 && $idCurso == '28' ){
					?><li><a href="curso.php?idCurso=<? echo @$_SESSION["sesionIdCurso"]; ?>">Curso</a></li><?
				}else{?>
	                <li><a href="mural.php?idCurso=<? echo @$_SESSION["sesionIdCurso"]; ?>">Mural</a></li>
                <? } ?>
                <li><a href="recursos.php?idCurso=<? echo @$_SESSION["sesionIdCurso"]; ?>">Recursos</a></li>
                <li><a href="foro.php?idCurso=<? echo @$_SESSION["sesionIdCurso"]; ?>">Foros</a></li>
                <!-- <li><a href="evaluacionUTP_2013.php">Evaluación</a></li> -->
                <li><a href="evaluacionHome.php">Evaluación</a></li>
		        <? 
				if (@$_SESSION["sesionPerfilUsuario"] >= 7 && $idCurso < 35){
				?>
                <li><a href="informeBitacorasCurso.php?idCurso=<? echo @$_SESSION["sesionIdCurso"]; ?>">Bitácora</a></li>
                <?
				}
				if (@$_SESSION["sesionPerfilUsuario"] >= 7){
				?>
                <li><a href="actividadescoordinacion.php">Resultados Actividades</a></li>
                <?
				}
				?>
                <? if($idCurso > '34' && $idCurso < '40' || $idCurso == '28'  ){ //Filtro para los niveles ?> 
                <li><a href="bitacora.php">Bitácora</a></li>
				<?
				}
	          	if($idCurso == '28'){?> 
                <li><a href="observacionClases.php">Observación de clases</a></li>
                <li><a href="informes.php">Informes</a></li>
				<? 
				}
				if (@$_SESSION["sesionPerfilUsuario"] >= 5){
				?>
               <!--<li><a href="informeActividad.php">Informe Actividades</a></li>-->
               <!--<li><a href="bitacoraReporte.php">Reportes Bitácora</a></li>-->
                <?
				}
				?>
                <? 
				/*
				if (@$_SESSION["sesionPerfilUsuario"] == 1){
					if($idCurso > '34' && $idCurso < '40' ){ 
						?><li><a href="evaluacionProfesor.php">Evaluación</a></li><?
					}
				}
				*/
				if (@$_SESSION["sesionPerfilUsuario"] > 7){
				?>
                <!-- <li><a href="informeParticipacion.php">Detalle Participacion</a></li> -->
                <!-- <li><a href="admin/accesosResumen.php">R.Participacion</a></li> -->
                
                <?
				}
				if (@$_SESSION["sesionPerfilUsuario"] == 4)
				{
				?>
                <!--<li><a href="evaluacionProfesor.php">Evaluación Profesor</a></li>-->
                <!--<li><a href="evaluacionUTP_2012.php">Evaluación UTP</a></li>-->
                
                <?
				}
				}?>  

				


            </ul>
        </div>
    </div>