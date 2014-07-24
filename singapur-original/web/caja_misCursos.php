<? $cursosUsuario = getCursosUsuario($_SESSION["sesionIdUsuario"]);?>
<div class="titulo_div">Mis Cursos:</div>

<div class="info_div">
    <ul>
		<? 
        foreach ($cursosUsuario as $datosCurso){ 
        ?>
            <li>
            <a href="curso.php?idCurso=<? echo $datosCurso["idCursoCapacitacion"];?>"><? echo $datosCurso["nombreCortoCursoCapacitacion"];?></a>
            </li>
        <? 
        }
        ?>
    </ul>
</div>        
      

