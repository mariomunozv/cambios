<br />
<div class="titulo_div">Categorias de Foro</div>

<div class="info_div">
	<ul>
	<? 
	 	@$idCurso = getCursoUs($_SESSION["sesionIdUsuario"]);
	   $res = getCategoriaCurso(@$idCurso); 
	 if (@mysql_num_rows($res) > 0 ){
		while($row = mysql_fetch_array($res)){
				?>
	 
			 <li> <a href="foroCategoria.php?idCategoria=<? echo $row["idTemaCategoria"];?>&amp;flag=<? echo 1; ?>">
					<? echo $row["nombreTemaCategoria"];?></a>
			  </li>
	  
	  
	  
	  <? } 
	  }else{	 ?>
	 
		  No hay ninguna categoría disponible por el momento.<br /></td>
	 
	  <?	   }?>



  </ul>
 </div>      
