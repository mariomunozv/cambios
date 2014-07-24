<? 


session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";



Conectarse_seg(); 


function getPautasCompletas(){

	$sql = "SELECT * FROM respuesta r JOIN pauta p on r.idPauta = p.idPauta WHERE r.idEnunciado = 39";
	$res = mysql_query($sql);
		
	$i =0;
	$datosPauta[$i]=array();
	while ($row = mysql_fetch_array($res)) {
		
		$datosUsuario = getDatosUsuario($row["idUsuario"]);
		$rbd = $datosUsuario["loginUsuario"];
		$datosColegio = getDatosColegio($rbd);
		$nombreColegio = $datosColegio["nombreColegio"];
		$comunaColegio = getNombreAtributoDeTabla($datosColegio["idComuna"],"Comuna");
		$nivel = getRespuestaEnunciado(41,$row["idPauta"]);
		$letra = getRespuestaEnunciado(42,$row["idPauta"]);

		$datosPauta[$i]=array(
		"idUsuario"=> $row["idUsuario"],
		"idPauta"=> $row["idPauta"],
		"fechaRespuestaPauta" => $row["fechaRespuestaPauta"],
		"rbd" => $rbd,
		"nombreColegio" => $nombreColegio,
		"comunaColegio" => $comunaColegio,
		"nivel" => $nivel,
		"letra" => $letra
		);
	$i++;
	}
	
	return($datosPauta);	

}


function getDatosUsuario($idUsuario){
		$sql = "SELECT * FROM `usuario` WHERE idusuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		$usuario=array(
			"idUsuario"=> $row["idUsuario"],
			"emailUsuario" => $row["emailUsuario"],
			"loginUsuario" => $row["loginUsuario"],
			"passwordUsuario" => $row["passwordUsuario"],
			"estadoUsuario" => $row["estadoUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],
			"tipoUsuario" => $row["tipoUsuario"],
			"imagenUsuario" => $row["imagenUsuario"]
			);
		return ($usuario);
}	


function getDatosColegio($rbd){

	$sql = "SELECT * FROM colegio WHERE rbdcolegio = ".$rbd;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$colegio=array(
			"rbdColegio"=> $row["rbdColegio"],
			"rutSostenedor" => $row["rutSostenedor"],
			"idComuna" => $row["idComuna"],
			"nombreColegio" => $row["nombreColegio"],
			"direccionColegio" => $row["direccionColegio"]
			);
	return ($colegio);
	
}


function getRespuestaEnunciado($idEnunciado,$idPauta){

	$sql = "SELECT * FROM respuesta WHERE idEnunciado = $idEnunciado AND idPauta = $idPauta";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return ($row["valorSeleccionada"]);
	
}



$datosPauta = getPautasCompletas();

//print_r($datosPauta);




?>

<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">#</th>
    <th scope="col">Comuna</th>
    <th scope="col">RBD</th>
    <th scope="col">Escuela</th>
    <th scope="col">Nivel</th>
    <th scope="col">Letra</th>
    <th scope="col">Fecha</th>
    <th scope="col">(Pauta)</th>
  </tr>

<? 
$i = 1;
foreach ($datosPauta as $pauta){
?>

  <tr>
    <td><? echo $i;?></td>
    <td><? echo $pauta["comunaColegio"];?></td>
    <td><? echo $pauta["rbd"];?></td>
    <td><? echo $pauta["nombreColegio"];?></td>
    <td><? echo $pauta["nivel"];?></td>
    <td><? echo $pauta["letra"];?></td>
    <td><? echo $pauta["fechaRespuestaPauta"];?></td>
    <td><? echo $pauta["idPauta"];?></td>
  </tr>

<? 
$i++;
}
?>  

</table>
