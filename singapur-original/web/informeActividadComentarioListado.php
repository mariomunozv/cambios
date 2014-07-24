<?
session_start();
include "inc/conecta.php";
include "inc/_funciones.php";
include "inc/_detalleUsuarioProyectoPerfil.php";
include "inc/_comentario.php";
include "inc/_usuario.php";
include "inc/_profesor.php";
include "inc/_directivo.php";
include "inc/_empleadoKlein.php";

include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
Conectarse_seg();


$idReferenciaComentario = $_REQUEST["idReferenciaComentario"];	
$tabla = $_REQUEST["tablaComentario"];




$comentarios = getComentariosTabla($tabla, $idReferenciaComentario);
//print_r($comentarios);

/* Ciclo Comentarios */
if ($comentarios[0]){
	?>
    <h3>Comentarios:</h3>
    <br />
	<table width="100%" id="tablaComentarios" name="tablaComentarios">
    <?
	$bool = true;
	foreach ($comentarios as $comentario){
		$nombre = getNombreUsuario($comentario["idUsuario"]);
		
		if (getIdPerfilUsuario($comentario["idUsuario"]) > 5 && $bool == true ){
			?>
            <input name="ape" id="ape" class="campos" type="hidden" value="<? echo $comentario["idUsuario"];?>" />
            <?
			$bool = false;
			
		}
		
		?>
        
        
		<tr align="justify" title="<? echo fechaConFormato($comentario["fechaComentario"]); ?>">
			<td style="padding:2px; border-width:1px; border-style:dotted; background-color:#DFEFFC">
			<img src="img/coment.gif" width="16" height="16" />
			<strong>
			<?
			echo $nombre.": ";
			?>
			</strong>
			<?
			echo " ".nl2br($comentario["textoComentario"]);
			
			?>
			</td>
                                       
		</tr>
        <tr>
        <td></td>    
        </tr>

		<?		
	}
	
	?>
    </table>
    <?
	

	//print_r($comentarios);
}

//print_r($comentarios);





?>

<p align="center">
<?
//boton("Volver","history.back();");
boton("Comentar","nuevo_comentario();this.style.visibility='hidden';");
?>
</p>




