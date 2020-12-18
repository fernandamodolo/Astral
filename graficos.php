<!--Dayna Caroline - N°11 - Criação: 02/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->

<!DOCTYPE html>

<?php
    include "../back/conexao.php";
    include "../front/grafico1/dados.php";
    include "../front/grafico2/dados.php";
    include "../front/grafico3/dados.php";
    include "../front/grafico4/dados.php";
    
    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $adm = $_SESSION['adm'];
        $nome = $_SESSION['nome']; 
        $sexo = $_SESSION['sexo'];
    }
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cup&Mug</title>
        <link rel="stylesheet" href="../styles/graficos.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!--Gráfico 1------------------------------------------------------------------------------------------------------>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Produtos', 'Vendas'],
                    <?php
                        for($x3=0; $x3 < $ind_prod; $x3++){
                            print_r("['".$sprod[$x3]."', ".$squant3[$x3]."],");
                        }
                    ?>
                ]);

                var options = {
                    title: 'Quantidade e porcentagem de vendas de todos os produtos.',
                    is3D: true,
                    pieSliceText: 'none'
                };

                var chart = new google.visualization.PieChart(document.getElementById('grafico1'));
                chart.draw(data, options);
            }
        </script>

        <!--Gráfico 2------------------------------------------------------------------------------------------------------>
 
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Datas', 'Faturamento', 'Produtos vendidos'],
                    <?php
                        for($x3=0; $x3 < count($sdatas); $x3++){
                            print_r("['".$sdatas[$x3]."', ".$fvalores5[$x3].", ".$fcompra[$x3]."],");
                        }
                    ?>
                ]);

                var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('grafico2'));

                chart.draw(data, options);
            }
        </script>

        <!--Gráfico 3------------------------------------------------------------------------------------------------------>
        <script>
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Produtos', 'Vendas'],
                    <?php
                        for($x3=0; $x3 < $ind_prod; $x3++){
                            print_r("['".$sprod[$x3]."', '".$sporcentagem3[$x3]."'],");
                        }
                    ?>
                ]);

                var options = {
                    chart: {
                        title: 'Porcentagem de vendas de todos os produtos.',
                    },
                    bars: 'horizontal', // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('grafico3'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>

        <!--Gráfico 4------------------------------------------------------------------------------------------------------>
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
    </head>

    <body>
        <div class="tudo">

            <div class="topo">
                <div class="header">
                    <div class="container">
                        <div class="navbar">
                            <div class="logo">
                                <img src="../imgs/tudo/melhor.jpg" alt="" width="100px" heigth="100px">
                            </div>
                            <nav>
                                <ul id="MenuItems">
                                    <li><a href=""><span>Vendas</span></a></li>
                                    <li><a href="../front/users_admin.php">Usuários</a></li>
                                    <li><a href="../front/prod_admin.php">Produtos</a></li>
                                    <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                </ul>
                            </nav>
                        </div>
                        
                        <div class="row">
                            <div class="col-2">
                                <h1>
                                 
                                <?php
                                    echo "Bem vind";
                                    
                                    if($logado != NULL)
                                    {
                                        if($sexo == 'M')
                                            echo "o, ".$nome."!";
                                        if($sexo == 'F')
                                        echo "a, ".$nome."!";
                                    }
                                    else
                                    {
                                        echo "o!";
                                    }
                                ?>
                                
                                <br>Consulte as vendas.</h1>
                                <p>Aqui você pode ver gráficos e tabelas que mostram a aceitação do nosso produto.</p>
                            </div>
                        
                            <div class="col-2">
                                <img src="../imgs/tudo/graficos.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">
                <div class="row row-2">
                    <form class="pesq_text" action="./pesq_venda.php" name="form1" method="post">
                        <input type="number" name="id" class="id" placeholder="ID" autocomplete="off">
                        <input type="text" name="cliente" class="nome" placeholder="Cliente" autocomplete="off">
                        <input type="text" name="data" class="data" onKeyPress="MascaraData(form1.data);" maxlength="10" placeholder="Data de Nascimento" autocomplete="off">

                        <button type="submit" class="icon">
                            Filtrar
                        </button>

                    </form>
                </div>

                <div class="small-container">
                        <div class="tabela">
                            <div class="titulos">
                                <div class="produto">ID</div>
                                <div class="quant">Cliente</div>
                                <div class="quant">Data da compra</div>
                            </div>

                            <?php
                                $sql = "SELECT compra.id_compra, compra.data_compra, usuario.nome, usuario.sobrenome, usuario.id_user, compra.excluido 
                                FROM compra JOIN usuario ON compra.id_user=usuario.id_user
                                WHERE compra.excluido=false ORDER BY compra.id_compra";
                                
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                
                                if($qtde > 0)
                                {

                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);
                                        $data = date('d/m/Y',  strtotime($linha['data_compra']));

                                        echo "
                                        <a href='../front/mais_venda.php?id_compra=".$linha['id_compra']."'>
                                        <div class='produtos'>
                                            <div class='produto completa'>
                                                <div class='descricao'>
                                                    <br>
                                                    <p>".$linha['id_compra']."</p>
                                                </div>
                                            </div>

                                            <div class='quant'>
                                                <span>".$linha['nome']." ".$linha['sobrenome']."</span>
                                            </div>

                                            <div class='preco2'>
                                                <span>".$data."</span>
                                            </div>
                                        </div>
                                        </a>";
                                    }
                                }
                                else
                                {
                                    echo "<center><br><br><br><br><br><br><br><br><br><br><br><br><h1><div class='tabela'><b> Seu carrinho está vazio </b></div></h1> <br><br><br><br><br><br><br></center>";
                                }

                            ?>
                        </div> 
                    
                </div>

                <h3>Gráficos e estatísticas</h3>
                
                <div class="graficos">
                    <center>
                        <div id="grafico1" style="width: 900px; height: 500px;"></div>
                        <br><br>
                        <div id="grafico2" style="width: 900px; height: 500px;"></div>
                        <br><br>
                        <div id="grafico3" style="width: 900px; height: 500px;"></div>
                        <br><br>
                        <div id="grafico4" style="width: 900px; height: 500px;"></div>
                        <br><br>
                    </center>
                </div>

                <center><a href="../back/gerar_relatorio.php"><button class="gerar">Gerar relatório</button></a></center>
            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                    <div class="footer">
                        <div class="navbar">
                            <section>
                                <ul id="MenuItems">
                                    <li><a href=""><span>Vendas</span></a></li>
                                    <li><a href="../front/users_admin.php">Usuários</a></li>
                                    <li><a href="../front/prod_admin.php">Produtos</a></li>
                                    <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                </ul>
                            </section>
                        </div>
                            
                        <div class="footer-col-1">
                            <ul>
                                <li>03 - Ana Júlia,</li>
                                <li>06 - Augusto Creppe,</li>
                                <li>11 - Dayna Caroline,</li>
                                <li>19 - João Gabriel,</li>
                                <li>20 - João Pedro,</li>
                                <li>28 - Maria Isabel</li>
                            </ul>
                        </div>

                        <div class="inicio">
                            <a href="graficos.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>

        <script type="text/javascript" src="../back/login_e_cadastro.js"></script>
    </body>
</html>