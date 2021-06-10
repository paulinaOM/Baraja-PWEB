
<?php 

	include "tools.php";
	session_start();

	$row= $objBD->saca_tupla("SELECT * FROM usuario WHERE email='".$_POST['email']."' and clave=password('".$_POST['clave']."')");
	$apuesta=$_POST['apuesta'];

	if ($objBD->numTuplas==1 && $apuesta>0) {
		$_SESSION['nombre']=$row->nombre." ".$row->apellidos;
		$_SESSION['email']=$row->email;
		$_SESSION['id']=$row->id;
		$_SESSION['foto']=$row->foto;
		$_SESSION['apuesta']=$apuesta;
		
		header("location: ./baraja.php");
	}
	else{
		header("location: index.php?E=1?");
	}

?>