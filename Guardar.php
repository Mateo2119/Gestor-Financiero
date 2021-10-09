<?php
	
	$conectar = new mysqli('localhost','root','','gestor');
	$ValorIngreso = $_POST['valorIngreso'];
	$Destinatario = $_POST['destino'];
	$Saldo = 0;
	//Sentencias mySql
	$sql = "INSERT INTO bolsillo VALUES ('$ValorIngreso','$ValorRetiro','$Destinatario','$Saldo')";
	//Run
	$Mandar = $conectar->query($sql);
	//verificar
	if(!$Mandar){
		echo "Error en el envio";
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enviado</title>
</head>
<body>
	<style type="text/css">
		body{
			background-image: url('imagenes/fondo.jpg');
			background-size: cover;
		}
		.boton{
			background-color: #FF8000;	
			margin-left: 620px;
			margin-top: 450px;
		    border: 0px;
		    height: 35px;
		    width: 120px;
		    border-radius: 15px;
		    color: white;
		}
		.boton:hover{
			background-color: #FE9A2E; 			
		}

	</style>
	<a href="index.html"><input type="button" value="Volver" class="boton"></a>
</body>
</html>