<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
		<title>Calendario en PHP con eventos</title>
		<meta http-equiv="PRAGMA" content="NO-CACHE" />
		<meta http-equiv="EXPIRES" content="-1" />
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="vtip.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function() {$('#mensaje').fadeOut('fast');}, 3000);
		});
		</script>
		<style>
		* {margin: 0;padding: 0;font-family:Helvetica, Arial, Tahoma, sans-serif;}
		html,body{height:100%;width:100%;outline:0;overflow:hidden}
		body {text-align:center;margin:0;width:100%;height:100%;overflow:hidden;}
		p#vtip { display: none; position: absolute; padding: 5px; left: 5px; font-size: 0.75em; background-color: #666666; border: 1px solid #666666; -moz-border-radius: 5px; -webkit-border-radius: 5px; z-index: 9999;color:white }
		p#vtip #vtipArrow { position: absolute; top: -10px; left: 5px }
		.ok{border:1px dotted green;color:green;padding:10px}
		#agenda{margin:10px;}
		#agenda h1{text-align:left;margin:0;font-size:1.5em;color:#312c2b}
		#agenda h2{text-align:left;margin:0;font-size:1em;color:#969696}
		#agenda table.calendario {margin:10px 0 0 0;width:100%;border:1px dotted #ccc;font-size:0.95em}
		.calendario th {border:1px dotted #ccc;font-weight:bold;background:#666;color:white;padding:10px 5px;}
		.calendario td{padding:10px 5px;text-align:center;border:1px dotted #ccc;}
		.calendario td.desactivada {background:#dcdcdc;}
		.calendario td.activa {background:#ffffff;}
		.calendario td.evento {background:#312c2b;color:white}
		.calendario td.hoy{font-weight:bold}
		.calendario form{margin:5px 0 !important}
		.calendario input.text{border:1px dotted #ccc;background:white;width:200px !important}
		.calendario input.enviar{border:1px dotted #ccc;background:white;width:70px !important;background:#ccc;margin:0 0 0 10px;}
		.calendario td img{vertical-align:middle;float:right;border:0;width:16px;height:16px}
		.vtip{cursor:pointer;}
		.verde{font-size:125% !important;font-weight:bold;color:green;}
		.rojo{font-size:125% !important;font-weight:bold;color:red;}
		</style>
	</head>
<body>
	<div id="agenda">
		<h1>Mi Agenda</h1>
		<?
			include("config.inc.php");
			function fecha ($valor)
			{
				$time = explode(" ",$valor);
				$fecha = explode("-",$time[0]);
				$fechex = "$fecha[2]/$fecha[1]/$fecha[0] $time[1]";
				return $fechex;
			}
			if (@$_POST[guardarevento]=="Si")
			{
				$q1="insert into tcalendario (fecha,evento) values ('$_POST[fecha]','$_POST[titulo]')";
				mysql_select_db($dbname);
				if ($r1=mysql_query($q1)) $mostrar= "<p class='ok' id='mensaje'>Evento guardado correctamente.</p>";
				else $mostrar= "<p class='error'>Se ha producido un error guardando el evento.</p>";
			}
			if (@$_GET[borrarevento])
			{
				$q1="delete from tcalendario where fecha='$_GET[borrarevento]' limit 1";
				mysql_select_db($dbname);
				if ($r1=mysql_query($q1)) $mostrar= "<p class='ok' id='mensaje'>Evento eliminado correctamente.</p>";
				else $mostrar= "<p class='error'>Se ha producido un error eliminando el evento.</p>";
			}
			$mesactual=intval(date("m"));
			$primeromes=date("N",mktime(0,0,0,$mesactual,1,date("Y")));
			$hoy=date("Y-m-d");
			$dias=array("","31","28","31","30","31","30","31","31","30","31","30","31");
			$q1="select * from tcalendario where month(fecha)='".date("m")."' and year(fecha)='".date("Y")."'";
			mysql_select_db($dbname);
			$r1=mysql_query($q1);
			if ($f1=mysql_fetch_array($r1))
			{
				$ides=array();
				$eventos=array();
				$titulos=array();
				$h=0;
				do
				{
					$ides[$h]="$f1[id]";
					$eventos[$h]="$f1[fecha]";
					$titulos[$h]="$f1[evento]";
					$h+=1;
				}
				while($f1=mysql_fetch_array($r1));
			}
			if (date("L")==true) $dias=array("","31","29","31","30","31","30","31","31","30","31","30","31");
			$meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$diasantes=$primeromes-1;
			$diasdespues=42;
			$tope=$dias[$mesactual]+$diasantes;
			if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
			else $totalfilas=intval(($tope/7));
			echo "<h2>Calendario de Eventos para: ".$meses[$mesactual]." de ".date("Y")."</h2>";
			echo @$mostrar;
			echo "<table class='calendario'><tr>";
			echo "<tr><th>L</th><th>M</th><th>M</th><th>J</th><th>V</th><th>S</th><th>D</th></tr>";
			$j=1;
			$filita=0;
			echo "<script>function mostrar(cual) {if (document.getElementById(cual).style.display=='block') {document.getElementById(cual).style.display='none';} else {document.getElementById(cual).style.display='block'} }</script>";
			function buscarevento($fecha,$eventos,$titulos)
			{
				$clave=array_search($fecha,$eventos,true);
				return $titulos[$clave];
			}
			for ($i=1;$i<=$diasdespues;$i++)
			{
				if ($filita<$totalfilas)
				{
				if ($i>=$primeromes && $i<=$tope) 
				{
					echo "<td";
					if ($j<10) $dd="0".$j;else $dd=$j;
					$compuesta=date("Y")."-".date("m")."-$dd";
					if (count($eventos)>0 && in_array($compuesta,$eventos,true)) {echo " class=' evento";$noagregar=true;}
					else {echo " class='activa";$noagregar=false;}
					if ($hoy==$compuesta) echo " hoy";
					if ($noagregar==false) echo "'>$j<a href='javascript:mostrar(\"evento$j\")' title='Crear un Evento el ".fecha($compuesta)."' class='vtip'><img src='add.png' /></a><form id='evento$j' method='post' action='$_SERVER[PHP_SELF]' style='display:none'><input type='text' name='titulo' class='text' /><input type='Submit' name='Enviar' value='Guardar' class='enviar' /><input type='hidden' name='guardarevento' value='Si' /><input type='hidden' name='fecha' value='$compuesta' /></form>";
					else echo "'><span class='vtip' title='".buscarevento($compuesta,$eventos,$titulos)."'>$j</span><a href='$_SERVER[PHP_SELF]?borrarevento=$compuesta' onClick=\"return confirm('&iquest;Confirmas la eliminaci&oacute;n del Evento?')\" title='Eliminar este Evento del ".fecha($compuesta)."' class='vtip'><img src='delete.png' /></a>";
					echo "</td>";
					$j+=1;
				}
				else echo "<td class='desactivada'>&nbsp;</td>";
				if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$filita+=1;}
				}
			}
			echo "</table>";
		?>
	</div>
</body>
</html>