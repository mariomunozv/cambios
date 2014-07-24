<? 
require("inc/incluidos.php");
require ("hd.php");

$idUsuarioPerfil = $_REQUEST["idUsuario"];
$datos =getDatosProfesor($idUsuarioPerfil);
?>

<body>
<div id="principal">
<? require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <? 
		require("caja_misCursos.php");
		require("caja_glosarioPalabra.php");
		require("caja_mensajes.php");
	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
    <? 
		require("caja_bienvenida.php");
		require("caja_eventosProximos.php");
		
	?>

    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     	<p class="titulo_curso"><? echo getNombreUsuario($idUsuarioPerfil); ?></p>
        <hr />
        <br />
        
        <table class="tablesorter" border="0">
            <tr> 
                <td colspan="2">
                	<img src="<? echo "subir/fotos_perfil/".@$datos["imagenUsuario"]?>"   />
                </td>
            </tr>
            
            <tr>
                <th>Acerca de mi:</th>
                <td align="justify"><? echo @$datos["acercaDeUsuario"]?></td>
            </tr>
            
            <tr>
                <th>Mis intereses:</th>
                <td align="justify"><? echo @$datos["interesesUsuario"]?></td>
            </tr>
                    
            <tr>
                <th>&Uacute;ltimo acceso:</th>
                <td><? echo fechaConFormato(@$datos["ultimoAccesoUsuario"]); ?></td>
            </tr>
                 
            <tr>
                <th>Email :</th>
                <td><? echo @$datos["emailProfesor"]?></td>
            </tr>
            
            <tr>
                <th>A&ntilde;os de experiencia docente:</th>
                <td><? echo @$datos["anosExperienciaProfesor"]?></td>
            </tr>
            
            <tr>
                <th>Asignatura a Cargo :</th>
                <td><? echo @$datos["asignaturaACargoProfesor"]?></td>
            </tr>
           
        
        </table>
     
			
    </div> <!--columnaCentro-->

	<? 
    	
		require("pie.php");
		
    ?> 
   
</body>
</html>
