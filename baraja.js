
var contaCambios=0;
var cantidadApuesta=0;
var gano=true;
var cartasACambiar=0;
var conta=2;
function carga()
{ 
	posicion=0; elMovimiento=null;
	// IE
	if(navigator.userAgent.indexOf("MSIE")>=0 || navigator.userAgent.indexOf("Trident")>=0) navegador=0;
	// Otros
	else 
		navegador=1;
}

function evitaEventos(event)
{
	// Funcion que evita que se ejecuten eventos adicionales
	if(navegador==0)
	{
		window.event.cancelBubble=true;
		window.event.returnValue=false;
	}
	if(navegador==1) event.preventDefault();
}

function comienzoMovimiento(event, id)
{ 
	elMovimiento=document.getElementById(id);
	if(navegador==0)
	 { 
	 	cursorComienzoX=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		cursorComienzoY=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;

		document.attachEvent("onmousemove", enMovimiento);
		document.attachEvent("onmouseup", finMovimiento);
	}
	if(navegador==1)
	{    
		cursorComienzoX=event.clientX+window.scrollX;
		cursorComienzoY=event.clientY+window.scrollY;
		document.addEventListener("mousemove", enMovimiento, true); 
		document.addEventListener("mouseup", finMovimiento, true);
	}
	
	elComienzoX=parseInt(elMovimiento.style.left);
	elComienzoY=parseInt(elMovimiento.style.top);
	// Actualizo el posicion del elemento
	elMovimiento.style.zIndex=++posicion;
	evitaEventos(event);
}

function enMovimiento(event)
{  
	var xActual, yActual;
	if(navegador==0)
	{    
		xActual=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		yActual=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	}  
	if(navegador==1)
	{
		xActual=event.clientX+window.scrollX;
		yActual=event.clientY+window.scrollY;
	}
	
	elMovimiento.style.left=(elComienzoX+xActual-cursorComienzoX)+"px";
	elMovimiento.style.top=(elComienzoY+yActual-cursorComienzoY)+"px";
	evitaEventos(event);
}

function finMovimiento(event)
{
	if(navegador==0)
	{    
		document.detachEvent("onmousemove", enMovimiento);
		document.detachEvent("onmouseup", finMovimiento);
	}
	if(navegador==1)
	{
		document.removeEventListener("mousemove", enMovimiento, true);
		document.removeEventListener("mouseup", finMovimiento, true); 
	}
}


var cartas=new Array();
var jugada=Array();

function generaCartas(){
	aux=0;
	for (var i = 1; i <=13; i++) {
		cartas[aux]=i+'C';
		aux++;
		cartas[aux]=i+'D';
		aux++;
		cartas[aux]=i+'P';
		aux++;
		cartas[aux]=i+'T';
		aux++;		
	}
	console.log(cartas);

	for (var i=0; i < 5; i++) {
		var identificador="carta"+(i+1);
		aleatorio(identificador,i);
	}
}

function aleatorio(elemento, lugar){
	id=document.getElementById(elemento);
	posi=parseInt(Math.random()*cartas.length);
	id.src="baraja/"+cartas[posi]+".jpg";
	jugada.splice(lugar,0,String(cartas.splice(posi,1)));	
	console.log(cartas);
	console.log(jugada);
}

function alertaCambiar(){
	ban=confirm('\u00bfDesea descartar alguna de sus cartas\u003f');
	if(ban){
		contaCambios++;
		conta--;
		console.log("contaCambios: "+contaCambios);
		for (var i = 1; i <=5; i++) {
			id=document.getElementById("check"+i);
			id.style.visibility='visible';
		}
		descartar.style.visibility='visible';
		cambiar.style.visibility='hidden';
		jugar.disabled=true;
		
		id=document.getElementById('etqCambios');
		id.innerHTML="<h5>Cambios restantes: "+conta+"</h5>";
	}
	if(contaCambios==2){
		cambiar.style.visibility='hidden';
	}
}

function descartarCartas(){

	for (var i = 1; i <=5; i++) {
		id=document.getElementById("check"+i);
		if (id.checked) {
			cartasACambiar++;
			jugada.splice(i-1,1);
			aleatorio("carta"+i,i-1);
		}
	}
	console.log(cartasACambiar);
	for (var i = 1; i <=5; i++) {
			id=document.getElementById("check"+i);
			id.checked=false;
			id.style.visibility='hidden';
	}
	descartar.style.visibility='hidden';
	jugar.disabled=false;
	if (contaCambios<2) {
			cambiar.style.visibility='visible';
	}
}

var jugadaNumero=Array();
var jugadaLetra=Array();
function comenzarJugada(){
	cambiar.style.visibility='hidden';
	
	for (m = 0; m < 5; m++) {
		if(jugada[m].length>2){
			jugadaNumero[m]=jugada[m].substring(0,2);
			jugadaLetra[m]=jugada[m].substring(2);
		}
		else{
			jugadaNumero[m]=jugada[m].substring(0,1);
			jugadaLetra[m]=jugada[m].substring(1);
		}
	}

	for (j = 0; j <=5; j++) {
		for ( i = 0; i <4; i++) {
			if(parseInt(jugadaNumero[i])>parseInt(jugadaNumero[i+1])){
				auxNumero=jugadaNumero[i];
				auxLetra=jugadaLetra[i];
				jugadaNumero[i]=jugadaNumero[i+1];
				jugadaLetra[i]=jugadaLetra[i+1];
				jugadaNumero[i+1]=auxNumero;
				jugadaLetra[i+1]=auxLetra;
			}
		}
	}
	id=document.getElementById("etqApuesta")
	cantidadApuesta=id.innerHTML;
	
	if(florCorrida()){
		console.log("es corrida");
		alert('\u00a1Ganaste\u0021 Formaste una corrida');
	}
	else{
		if (poker()){
			console.log("es poker");
			alert('\u00a1Ganaste\u0021 Formaste poker');
		}
		else{
			if (full()) {
				console.log("es full");
				alert('\u00a1Ganaste\u0021 Formaste full');
			}
			else{
				if (tercia()) {
					console.log("es tercia");
					alert('\u00a1Ganaste\u0021 Formaste tercia');
				}
				else{
					console.log("ninguna jugada");
					alert('Has perdido tu apuesta de $'+cantidadApuesta+'. No formaste ninguna jugada.');
					gano=false;
				}
			}
		}
	}


	window.location="baraja.php?cambios="+contaCambios+"&cartas="+cartasACambiar+"&estatus="+gano;
	

}

function florCorrida(){
	var corrida=true;
	var posicion=0;

	if (jugadaNumero[0]!=1) {
		while(corrida && posicion<4){
			if ((jugadaNumero[posicion+1]-jugadaNumero[posicion])!=1||(jugadaLetra[posicion]!=jugadaLetra[posicion+1])) {
				corrida=false;
			}
			posicion++;
		}
	}
	else{
		corrida=false;
	}
	return corrida
}

function poker(){
	var pokerIzq=true;
	var pokerDer=true;
	var poker=false;
	var posicion=0;

	while(pokerIzq&&posicion<3){
		if (jugadaNumero[posicion]!=jugadaNumero[posicion+1]) {pokerIzq=false}
		posicion++;
	}
	posicion=4;
	while(pokerDer&&posicion>1){
		if (jugadaNumero[posicion]!=jugadaNumero[posicion-1]) {pokerDer=false}
		posicion--;
	}
	if (pokerIzq||pokerDer) {poker=true}

	return poker;
}
function full(){
	conta=0;
	var ban=true;
	while(ban&&conta<2){
		if(jugadaNumero[conta]!=jugadaNumero[conta+1]){
			ban=false;
		}
		conta++;
	}
	if (ban) {
		conta++;
		if(jugadaNumero[conta]!=jugadaNumero[conta+1]){
			ban=false;
		}
	}
	else{
		ban=true;
		conta=4;
		while(ban&&conta>2){
			if(jugadaNumero[conta]!=jugadaNumero[conta-1]){
				ban=false;
			}
			conta--;
		}
		if(ban){
			conta--;
			if(jugadaNumero[conta]!=jugadaNumero[conta-1]){
			ban=false;
			}
		}
	}
	return ban;
}

function tercia(){
	conta=0;
	var ban=true;
	while(ban&&conta<2){
		if(jugadaNumero[conta]!=jugadaNumero[conta+1]){
			ban=false;
		}
		conta++;
	}
	if (!ban) {
		ban=true;
		conta=4;
		while(ban&&conta>2){
			if(jugadaNumero[conta]!=jugadaNumero[conta-1]){
				ban=false;
			}
			conta--;
		}
		if (!ban) {
			ban=true;
			conta=1;
			while(ban&&conta<3){
				if(jugadaNumero[conta]!=jugadaNumero[conta+1]){
					ban=false;
				}
				conta++;
			}
		}
	}
	return ban;
}

