<? $datosPalabra = getPalabraRandom();?>
<br />
<div class="titulo_div">Glosario</div>

<div class="info_div">
    <a href="glosario.php?idPalabra=<? echo $datosPalabra["idPalabra"];?>">
    	<strong><? echo $datosPalabra["nombrePalabra"];?>:</strong><br />
	</a>
		<? echo $datosPalabra["definicionPalabra"];?>
	
</div>    

