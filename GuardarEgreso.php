<?php
	$conectar = new mysqli('localhost','root','','gestor');	
	$valor = $_POST['valorRetiro'];
	$tipo = "Egreso";
	$cartera = $_POST['cartera_retiro'];
	$tipo_gasto = $_POST['cartera_envio'];
	$saldo_inicial_consulta = "SELECT saldo_final FROM egresos_tabla WHERE cartera_db = '$cartera' ORDER BY id DESC LIMIT 1";
	$saldo_inicial_valor = $conectar->query($saldo_inicial_consulta);
	$saldo_inicial_array = $saldo_inicial_valor->fetch_assoc();
	$saldo_inicial = $saldo_inicial_array['saldo_final'];


	if ($valor > $saldo_inicial) {
		echo "Saldo insuficiente";
		$saldo_final = $saldo_inicial;
	?>
	<script type="text/javascript">alert("Saldo insuficiente");</script>
	<?php
	}

	else{
	$saldo_final = $saldo_inicial - $valor;
	//sql
	$sql = "INSERT INTO egresos_tabla(transaccion_db, saldo_inicial_db, valor_egreso_db, cartera_db, tipo_gasto, saldo_final) VALUES ('$tipo','$saldo_inicial','$valor','$cartera','$tipo_gasto','$saldo_final')";
	//Run
	$Mandar = $conectar->query($sql);
	//verificar
	if(!$Mandar){
		echo "Error en el envio";
	}
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
	<a href="prueba.php"><input type="button" value="Volver" class="boton"></a>
</body>
</html> 