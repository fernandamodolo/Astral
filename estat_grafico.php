<!DOCTYPE html>

<?php
include "dados.php";
session_start();
?>


         <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Sexo', 'Quantidade de compras'],
                ['Feminino', <?php echo $sf4;?>],
                ['Masculino', <?php echo $sm4;?>]
                ]);

                var options = {
                title: 'Preferência de compra por gênero.',
                is3D: true,
                slices: {
                    0: { color: 'purple' },
                    1: { color: 'orange' }
                }
                };

                var chart = new google.visualization.PieChart(document.getElementById('grafico4'));
                chart.draw(data, options);
            }
        </script>
        
        
        <html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
    <link rel="icon" type="imagem/png" href="imagens/logoa.png">
     <link rel="stylesheet" type="text/css" href="estilo_grafico.css"> 
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Estatísticas</title>
</head>
<body>

<center>
        <div id="mae">
        <font face="Arial" size="4" color="black">
         <?php
            include "barra_fixa.php";
                include "barra_lateral.html";
               ?>
                <div id="conteudo_principal">
                <h1>grafico </h1>
                <div class="graficos">
                    <center>
                    <div id="grafico4" style="width: 900px; height: 500px;"></div>
                        <br><br>
                    </center>
                </div>
        
    </div>
              <?php
                include "roda_pe.html";
            ?>
           
            </font>
    </div>
    </center>
    </body>
</html>
