function validarIngreso(){

	var valIngresado;
	var saldoBolsillo, saldoDebito, saldoOtro; 
	var destino;
	valIngresado = document.getElementById('valorIngreso').value;	
	destinoIngreso = document.getElementById('cartera_ingreso').value;
	document.getElementById('saldo_form').value;
	saldoInicial = document.getElementById('saldo_form').value;
	//alert(saldoInicial);

	//VALIDACIÓN
	if (valIngresado.length>8 && valIngresado<=0) {
		alert("Numero muy grande (ingreso)");
		return false;
	}
	else if (isNaN(valIngresado)) {
		alert("No es un numero (ingreso)");	
		return false;
	}
	/*//LOGICA
	if (destinoIngreso=="Bolsillo") {
		saldoBolsillo = valIngresado;
		//alert(destinoIngreso+" Ahora tiene: "+saldoBolsillo);
	}
	else if (destinoIngreso == "Debito") {
		saldoDebito = valIngresado;
		//alert(destinoIngreso+" Ahora tiene: "+saldoDebito);
	}
	else if (destinoIngreso == "Otros") {
		saldoOtro = valIngresado;
		//alert(destinoIngreso+" Ahora tiene: "+saldoOtro);
	}*/
}

function validarRetiro(){

	var valorRetirado;
	var remiteRetiro, destinoRetiro;
	var saldoBolsillo, saldoDebito, saldoOtro;
	remiteRetiro = document.getElementById('cartera_retiro').value;
	valorRetirado = document.getElementById('valorRetiro').value;
	destinoRetiro = document.getElementById('cartera_envio').value;
	//VALIDACIÓN
	if (valorRetirado.length>8) {
		alert("Numero muy grande (retiro)");
		return false;
	}
	else if (isNaN(valorRetirado)) {
		alert("No es un numero (retiro)");
		return false;
	}
	//alert("de "+remiteRetiro+" para "+destinoRetiro+" el valor de: "+valorRetirado);
	//LOGICA
	//DE BOLSILLO
	/*
	if (remiteRetiro=="Bolsillo") {
		if (destinoRetiro=="Comida") {			
		}
		else if (destinoRetiro=="Transporte") {
			
		}
		else if (destinoRetiro=="Facturas") {
			
		}
		else if (destinoRetiro=="Otros") {
			
		}
	}
	//DE DEBITO
	if (remiteRetiro=="Debito") {
		if (destinoRetiro=="Comida") {

		}
		else if (destinoRetiro=="Transporte") {
			
		}
		else if (destinoRetiro=="Facturas") {
			
		}
		else if (destinoRetiro=="Otros") {
			
		}
	}
	//DE OTROS
	if (remiteRetiro=="Otros") {
		if (destinoRetiro=="Comida") {

		}
		else if (destinoRetiro=="Transporte") {
			
		}
		else if (destinoRetiro=="Facturas") {
			
		}
		else if (destinoRetiro=="Otros") {
			
		}
	}*/
}
