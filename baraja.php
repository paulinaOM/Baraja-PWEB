
<!-- saved from url=(0069)https://tigger.itc.mx/conacad/cargas/GUVF681004UW4/46/capasMouse.html -->
<?php session_start();
include "tools.php";
	$jugados=0;
	$cambios=0;
	$cartasCambiadas=0;
	$totalApostado=0;
	$totalGanado=0;
	$row= $objBD->saca_tupla("SELECT * FROM juegos where idJugador=".$_SESSION['id']);
	if ($objBD->numTuplas==1) {
		$jugados=$row->jugados;
		$cambios=$row->cambios;
		$cartasCambiadas=$row->cartasCambiadas;
		$totalApostado=$row->apostado;
		$totalGanado=$row->ganado;
	}
 ?>

<html>
<head>
	<title>Póker virtual</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link href="https://fonts.googleapis.com/css2?family=Anton&family=Share&display=swap" rel="stylesheet">
	<script type="text/javascript" src="baraja.js"></script>
	<script type="text/javascript">
		function historial(){
		alert(
		"Número de Juegos: <?php echo $jugados.'\n' ?>"+
		"Total cambios realizados: <?php echo $cambios.'\n'?>"+
		"Total cartas cambiadas: <?php echo $cartasCambiadas.'\n'?>"+
		"Total apuestas: <?php echo $totalApostado.'\n'?>"+
		"Ganancia total: <?php echo $totalGanado.'\n'?>");
		}
	</script>
	<style type="text/css">
		.fondo{
	      	background-image: url("imagenes/fondo.jpg");
	      	background-repeat: no-repeat;
	      	background-size: cover;
	    }
	    
	    .botonimagen{
		  	background-image:url(imagenes/jugar-3.png);
		  	background-repeat:no-repeat;
		  	width:120px;
		  	height: 120px;
		  	border-radius: 50%;
		  	border: solid #000000 2px;
		  	background-position:center;
		}
		.etiqueta{
			color: white; 
			font-family: 'Share', cursive;
		}
		.imagen{
			 box-shadow: 6px -9px 15px #000;
			 border-radius: 18px;
		}
	</style>
</head>
<body onload="carga(); generaCartas();" class="fondo">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8" style="margin-top: 10px;">
			<label id="etqCambios" class="etiqueta"><h5>Cambios restantes:2</h5></label>
		</div>
		<div class="col-md-2" style="height: 6rem; margin-top: 10px;">
			<center>
				<img src="imagenes/cambiar-cartas.png" width="124px" style="position: relative; z-index: 1; ">
				<input id="cambiar" type="button" class="btn btn-primary btn-sm" value="Cambiar cartas" onclick="alertaCambiar();" style="z-index: 2; position: relative; margin-top: -2rem; font-variant-caps:all-small-caps;">
			</center>
		</div>
		<div class="col-md-2" style="height: 6rem; margin-top: 10px;">
			<center>
				<img src="imagenes/estadisticas.png" width="150px" style="position: relative; z-index: 1;">
				<input type="button" id="estadisticas" class="btn btn-primary btn-sm" value="Estadísticas" onclick="historial();" style="z-index: 2;position:relative; margin-top: -2rem; font-variant-caps:all-small-caps;">
			</center>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<center><input id="descartar" type="button" class="btn btn-primary" value="Descartar" onclick="descartarCartas();" style="visibility: hidden; font-variant-caps:all-small-caps;">	</center>
		</div>
	</div>
	
	<div class="row" style="height: 20rem">
		<img src="imagenes/mesa.png" style="border-radius: 2000px; box-shadow: 6px 5px 30px #000; margin-left: 150px">
		<div id="div1" style="top:200px; width:112px; height:158px; left:220px; position: absolute;" onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor='move'">
			<center><input type="checkbox" id="check1" style="visibility: hidden;"><img id="carta1" class="imagen"></center>
		</div>
		<div id="div2" style="top:200px; left:420px; width:112px; height:158px; position: absolute;" onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor='move'">
			<center><input type="checkbox" id="check2" style="visibility: hidden;"><img id="carta2" class="imagen"></center>
		</div>
		<div id="div3" style="top:200px; left:620px; width:112px; height:158px; position: absolute;" onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor='move'">
			<center><input type="checkbox" id="check3" style="visibility: hidden;"><img id="carta3" class="imagen"></center>
		</div>
		<div id="div4" style="top:200px; left:820px; width:112px; height:158px; position: absolute;" onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor='move'">
			<center><input type="checkbox" id="check4" style="visibility: hidden;"><img id="carta4" class="imagen"></center>
		</div>
		<div id="div5" style="top:200px; left:1020px; width:112px; height:158px; position: absolute;" onmousedown="comienzoMovimiento(event, this.id);" onmouseover="this.style.cursor='move'">
			<center><input type="checkbox" id="check5" style="visibility: hidden;"><img id="carta5" class="imagen"></center>
		</div>
	</div>
	<div class="row">

		<div class="col-md-10">
			<img src="imagenes/chip.png" width="150px">
			<label class="etiqueta"><h4>
				<?php echo $_SESSION['nombre'] ?><br/>
				<label class="etiqueta"><h5>Apuesta:</h5></label>
				<label id="etqApuesta" class="etiqueta"><?php echo $_SESSION['apuesta'] ?></label>
			</h4></label>
			
		</div>
		<div class="col-md-2" style="height: 8rem">
			<center>
					<input class="botonimagen" id="jugar" type="button" onclick="comenzarJugada();" value="">
				
			</center>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<center>
				<p style="color: #FFF; font-family: Century Gothic; text-shadow: 0.5px 0.5px #805f00;">Sitio desarrollado por: Paulina Otero Martínez y Naomi Ortiz González</p>
			</center>
		</div>
		
	</div>
	
</div>

</body>
</html>
<?php

  if (isset($_REQUEST['cambios'])) {
    $numCambios=$_REQUEST['cambios'];
	$numCartas=$_REQUEST['cartas'];
	$banGano=$_REQUEST['estatus'];
	$row= $objBD->saca_tupla("SELECT id FROM juegos where idJugador=".$_SESSION['id']);
	if ($objBD->numTuplas==1) {
		$cad="update juegos set jugados=jugados+1, cambios=cambios+".$numCambios.", cartasCambiadas=cartasCambiadas+".$numCartas." ".(($banGano=='true')?',ganado=ganado+2*'.$_SESSION['apuesta']:'').", apostado=apostado+".$_SESSION['apuesta']." where idJugador=".$_SESSION['id'];
		
		$objBD->consulta($cad);
	}
	else{
		$cad="insert into juegos(idJugador,jugados,cambios,cartasCambiadas,apostado,ganado) values (".$_SESSION['id'].",1,".$numCambios.",".$numCartas.",".$_SESSION['apuesta'].(($banGano=='true')?",2*".$_SESSION['apuesta'].");":",0);");
		
		$objBD->consulta($cad);
		}

	
	}


  
?>

