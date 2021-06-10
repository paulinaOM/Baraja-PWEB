<?php

/**
 * 
 */
class baseDatos
{
	#Los atributos en php sí se declaran, anteponiendo la palabra var.	
	var $cone; #conexión
	var $bloque; #trae los registros
	var $numTuplas; 
	var $clave;

	function inicializa($serv="localhost",$user="userTEST",$puser="1234",$bd="amoroso"){ 
		$this->cone=mysqli_connect($serv,$user,$puser,$bd);
		if ($this->cone==null) {
			exit;
		}
		
	}

	function consulta($query){
		$this->inicializa();
		$this->bloque=mysqli_query($this->cone,$query);
		
		if (strpos(strtoupper($query), "SELECT")!==false) { 
			$this->numTuplas=mysqli_num_rows($this->bloque);

		}
		$this->closeBD();
	}

	function saca_tupla($query){
		$this->consulta($query);
		return mysqli_fetch_object($this->bloque);

	}

	function closeBD(){
		mysqli_close($this->cone);	
	}
}

$objBD=new baseDatos();
?>

