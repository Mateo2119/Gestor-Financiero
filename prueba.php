<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Gestor Financiero</title>
        <link rel="stylesheet" type="text/css" href="Estilos.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="logic.js"></script>
        <script src="validacionForm.js"></script>
    </head>
    <body>
        <div class="superMenu">
            <ul class="menu">
                <li><a href="#cont1">Ingresar</a></li>
                <li><a href="#cont2">Retirar</a></li>
                <li><a href="#cont3">Tabla</a></li> 
                <li><a href="#cont4">Grafica</a></li>     
            </ul>
            <div class="contents">
                <article id="cont1">
                    <form onsubmit="return validarIngreso();" action="GuardarIngreso.php" method="POST" autocomplete="off"> <!-- Fomr Ingresar  -->
                        <p>¿Cuanto desea ingresar?<br>                       
                            <input type="number" id="valorIngreso" name="valorIngreso" required="" maxlength="8" min="0"><br>
                        <p>¿A donde lo desea enviar?</p>
                            <select name="cartera_ingreso" id="cartera_ingreso">
                                <option value="Bolsillo">Bolsillo</option>
                                <option value="Debito">Debito</option> 
                                <option value="Otros">Otros</option>                               
                            </select><br><br>
                            <input type="text" name="saldoForm" id="saldoForm"><br> <!-- oculto -->
                            <input type="submit" value="Enviar"><br><br>
                        <div class="saldo_contenedor">
                        </div>
                    </form>
                </article>
                <article id="cont2">
                    <form action="GuardarEgreso.php" method="POST" onsubmit="return validarRetiro();" autocomplete="off"> <!--  Form Retirar -->
                        <p>¿De que cartera lo desea retirar?</p>
                            <select name="cartera_retiro" id="cartera_retiro">
                                <option value="Bolsillo">Bolsillo</option>
                                <option value="Debito">Debito</option> 
                                <option value="Otros">Otros</option>                               
                            </select> <br> 
                        <p>¿Cuanto desea retirar?<br>                       
                            <input type="number" id="valorRetiro" name="valorRetiro" required maxlength="8"><br>
                        <p>¿En que lo desea gastar?</p>
                            <select name="cartera_envio" id="cartera_envio">
                                <option value="Comida">Comida</option>
                                <option value="Transporte">Transporte</option> 
                                <option value="Facturas">Facturas</option>
                                <option value="Otros">Otros</option>                                
                            </select> <br><br> 
                            <input type="submit" value="Enviar"><br><br>
                        <div class="saldo_contenedor">
                            <br>
                            <label>Saldo del bolsillo:
                            <?php
                            $conectar3 = new mysqli('localhost','root','','gestor');
                            $saldo_final_consulta = "SELECT saldo_final FROM egresos_tabla WHERE cartera_db = 'Bolsillo' ORDER BY id DESC LIMIT 1";
                            $saldo_final_valor = $conectar3->query($saldo_final_consulta);
                            $saldo_final_array = $saldo_final_valor->fetch_assoc();
                            echo $saldo_final_array['saldo_final'];                                       
                            ?>                              
                            </label><br> <!-- MOSTRAR EL SALDOOOOOOOO-->
                            <label>Saldo de la tarjeta debito:
                            <?php
                            $conectar3 = new mysqli('localhost','root','','gestor');
                            $saldo_final_consulta = "SELECT saldo_final FROM egresos_tabla WHERE cartera_db = 'Debito' ORDER BY id DESC LIMIT 1";
                            $saldo_final_valor = $conectar3->query($saldo_final_consulta);
                            $saldo_final_array = $saldo_final_valor->fetch_assoc();
                            echo $saldo_final_array['saldo_final'];                                       
                            ?>    
                            </label><br>
                            <label>Saldo de otros:
                            <?php
                            $conectar3 = new mysqli('localhost','root','','gestor');
                            $saldo_final_consulta = "SELECT saldo_final FROM egresos_tabla WHERE cartera_db = 'Otros' ORDER BY id DESC LIMIT 1";
                            $saldo_final_valor = $conectar3->query($saldo_final_consulta);
                            $saldo_final_array = $saldo_final_valor->fetch_assoc();
                            echo $saldo_final_array['saldo_final'];                                       
                            ?> 
                            </label>
                        </div>    
                    </form>
                </article>
                <article id="cont3">
                    <div class="tabla_egresos"> <!--Tabla -->
                        <table>
                            <thead>
                                <tr>
                                    <th>Transaccion:</th>
                                    <th>Saldo inicial</th>
                                    <th>Valor</th>
                                    <th>Cartera</th>
                                    <th>Tipo de gasto</th>
                                    <th>Saldo final</th>                        
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $conectar = new mysqli('localhost','root','','gestor');
                                $query_egreso = "SELECT * FROM egresos_tabla";
                                $consulta = $conectar->query($query_egreso);
                                while($row=$consulta->fetch_assoc())
                                {
                            ?>
                                <tr>
                                    <td><?php echo $row['transaccion_db'];?></td>
                                    <td><?php echo $row['saldo_inicial_db'];?></td>
                                    <td><?php echo $row['valor_egreso_db'];?></td>
                                    <td><?php echo $row['cartera_db'];?></td>
                                    <td><?php echo $row['tipo_gasto'];?></td>
                                    <td><?php echo $row['saldo_final'];?></td>
                                 </tr>
                            <?php       
                                }
                            ?>      
                            </tbody>
                        </table>
                    </div>                  
                 </article>
                 <article id="cont4"> <!-- GRAFICA -->                    
                        <script src="highcharts.js"></script>
                        <script src="highcharts-3d.js"></script>
                        <script src="exporting.js"></script>
                        <script src="export-data.js"></script>

                    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                    <script type="text/javascript">                        

                                <?php
                                $comida_bolsillo;
                                $conectar2 = new mysqli('localhost','root','','gestor');

                                //Variables de comida
                                    //Comida Bolsillo                                    
                                    $comida_bolsillo_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Comida' and cartera_db = 'Bolsillo' and transaccion_db = 'Egreso'";
                                    $comida_bolsillo_valor = $conectar2->query($comida_bolsillo_query);
                                    $comida_bolsillo=$comida_bolsillo_valor->fetch_assoc();
                                    
                                    //Comida Debito
                                    $comida_debito=0;
                                    $comida_debito_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Comida' and cartera_db = 'Debito' and transaccion_db = 'Egreso'";
                                    $comida_debito_valor = $conectar2->query($comida_debito_query);
                                    $comida_debito=$comida_debito_valor->fetch_assoc();
                                    //Comida Otros
                                    $comida_otros=0;
                                    $comida_otros_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Comida' and cartera_db = 'Otros' and transaccion_db = 'Egreso'";
                                    $comida_otros_valor = $conectar2->query($comida_otros_query);
                                    $comida_otros=$comida_otros_valor->fetch_assoc(); 

                                //Variables de Facturas
                                    //Facturas Bolsillo
                                    $facturas_bolsillo=0;
                                    $facturas_bolsillo_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Facturas' and cartera_db = 'Bolsillo' and transaccion_db = 'Egreso'";
                                    $facturas_bolsillo_valor = $conectar2->query($facturas_bolsillo_query);
                                    $facturas_bolsillo=$facturas_bolsillo_valor->fetch_assoc();
                                    //Facturas Debito
                                    $facturas_debito=0;
                                    $facturas_debito_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Facturas' and cartera_db = 'Debito' and transaccion_db = 'Egreso'";
                                    $facturas_debito_valor = $conectar2->query($facturas_debito_query);
                                    $facturas_debito=$facturas_debito_valor->fetch_assoc();
                                    //Facturas Otros
                                    $facturas_otros=0;
                                    $facturas_otros_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Facturas' and cartera_db = 'Otros' and transaccion_db = 'Egreso'";
                                    $facturas_otros_valor = $conectar2->query($facturas_otros_query);
                                    $facturas_otros=$facturas_otros_valor->fetch_assoc();

                                //Variables de Transporte
                                    //transporte Bolsillo
                                    $transporte_bolsillo=0;
                                    $transporte_bolsillo_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Transporte' and cartera_db = 'Bolsillo' and transaccion_db = 'Egreso'";
                                    $transporte_bolsillo_valor = $conectar2->query($transporte_bolsillo_query);
                                    $transporte_bolsillo=$transporte_bolsillo_valor->fetch_assoc();
                                    //Transporte Debito
                                    $transporte_debito=0;
                                    $transporte_debito_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Transporte' and cartera_db = 'Debito' and transaccion_db = 'Egreso'";
                                    $transporte_debito_valor = $conectar2->query($transporte_debito_query);
                                    $transporte_debito=$transporte_debito_valor->fetch_assoc();
                                    //Transporte Otros
                                    $transporte_otros = 0;
                                    $transporte_otros_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Transporte' and cartera_db = 'Otros' and transaccion_db = 'Egreso'";
                                    $transporte_otros_valor = $conectar2->query($transporte_otros_query);
                                    $transporte_otros=$transporte_otros_valor->fetch_assoc();

                                //Variables de otros
                                    //otros Bolsillo
                                    $otros_bolsillo = 0;
                                    $otros_bolsillo_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Otros' and cartera_db = 'Bolsillo' and transaccion_db = 'Egreso'";
                                    $otros_bolsillo_valor = $conectar2->query($otros_bolsillo_query);
                                    $otros_bolsillo=$otros_bolsillo_valor->fetch_assoc();
                                    //otros Debito
                                    $otros_debito = 0;
                                    $otros_debito_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Otros' and cartera_db = 'Debito' and transaccion_db = 'Egreso'";
                                    $otros_debito_valor = $conectar2->query($otros_debito_query);
                                    $otros_debito=$otros_debito_valor->fetch_assoc();
                                    //otros Otros
                                    $otros_otros= 0;
                                    $otros_otros_query = "SELECT SUM(valor_egreso_db) FROM egresos_tabla WHERE tipo_gasto = 'Otros' and cartera_db = 'Otros' and transaccion_db = 'Egreso'";
                                    $otros_otros_valor = $conectar2->query($otros_otros_query);
                                    $otros_otros=$otros_otros_valor->fetch_assoc();                                                                 
                                ?>                        

                        //Tabla Comida
                         var comidaB = <?php
                         if (!$comida_bolsillo['SUM(valor_egreso_db)'] > 0){
                            $comida_bolsillo['SUM(valor_egreso_db)'] = 0;
                         }echo $comida_bolsillo['SUM(valor_egreso_db)'];
                         ?>,                            
                         comidaD = <?php
                         if (!$comida_debito['SUM(valor_egreso_db)'] > 0){
                            $comida_debito['SUM(valor_egreso_db)'] = 0;
                         }echo $comida_debito['SUM(valor_egreso_db)'];
                         ?>,
                         comidaO = <?php
                         if (!$comida_otros['SUM(valor_egreso_db)'] > 0){
                            $comida_otros['SUM(valor_egreso_db)'] = 0;
                         }echo $comida_otros['SUM(valor_egreso_db)'];
                         ?>;
                        //Tabla Facturas
                        var facturasB = <?php
                         if (!$facturas_bolsillo['SUM(valor_egreso_db)'] > 0){
                            $facturas_bolsillo['SUM(valor_egreso_db)'] = 0;
                         }echo $facturas_bolsillo['SUM(valor_egreso_db)'];
                         ?>,                            
                         facturasD = <?php
                         if (!$facturas_debito['SUM(valor_egreso_db)'] > 0){
                            $facturas_debito['SUM(valor_egreso_db)'] = 0;
                         }echo $facturas_debito['SUM(valor_egreso_db)'];
                         ?>,
                         facturasO = <?php
                         if (!$facturas_otros['SUM(valor_egreso_db)'] > 0){
                            $facturas_otros['SUM(valor_egreso_db)'] = 0;
                         }echo $facturas_otros['SUM(valor_egreso_db)'];
                         ?>;
                        //Tabla Transporte
                        var transporteB = <?php
                         if (!$transporte_bolsillo['SUM(valor_egreso_db)'] > 0){
                            $transporte_bolsillo['SUM(valor_egreso_db)'] = 0;
                         }echo $transporte_bolsillo['SUM(valor_egreso_db)'];
                         ?>,                            
                         transporteD = <?php
                         if (!$transporte_debito['SUM(valor_egreso_db)'] > 0){
                            $transporte_debito['SUM(valor_egreso_db)'] = 0;
                         }echo $transporte_debito['SUM(valor_egreso_db)'];
                         ?>,
                         transporteO = <?php
                         if (!$transporte_otros['SUM(valor_egreso_db)'] > 0){
                            $transporte_otros['SUM(valor_egreso_db)'] = 0;
                         }echo $transporte_otros['SUM(valor_egreso_db)'];
                         ?>;
                        //Tabla Otros
                        var otrosB = <?php
                         if (!$otros_bolsillo['SUM(valor_egreso_db)'] > 0){
                            $otros_bolsillo['SUM(valor_egreso_db)'] = 0;
                         }echo $otros_bolsillo['SUM(valor_egreso_db)'];
                         ?>,                            
                         otrosD = <?php
                         if (!$otros_debito['SUM(valor_egreso_db)'] > 0){
                            $otros_debito['SUM(valor_egreso_db)'] = 0;
                         }echo $otros_debito['SUM(valor_egreso_db)'];
                         ?>,
                         otrosO = <?php
                         if (!$otros_otros['SUM(valor_egreso_db)'] > 0){
                            $otros_otros['SUM(valor_egreso_db)'] = 0;
                         }echo $otros_otros['SUM(valor_egreso_db)'];
                         ?>;

                        

                        Highcharts.chart('container', {
                            
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Gastos'
                            },
                            xAxis: {
                                categories: ['Bolsillo', 'Debito', 'Otros']
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: ''
                                }
                            },
                            legend: {
                                reversed: true
                            },
                            plotOptions: {
                                series: {
                                    stacking: 'normal'
                                }
                            },
                            series: [{
                                name: 'Comida',
                                data: [comidaB, comidaD, comidaO]
                            }, {
                                name: 'Facturas',
                                data: [facturasB, facturasD, facturasO]
                            }, {
                                name: 'Transporte',
                                data: [transporteB, transporteD, transporteO]
                            },
                            {
                                name: 'Otros',
                                data: [otrosB, otrosD, otrosO]
                            }]
                        });
                    </script>
                </article>
            </div>
        </div>        
    </body>
</html>
