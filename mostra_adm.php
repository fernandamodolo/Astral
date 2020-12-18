<!-- Autora: Fernanda Castor Modolo
     07/10/2020
     
   Mostra usuários  - adm -->
   
  <!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
    <link rel="stylesheet" type="text/css" href="estilo_mostra_adm.css">
    <link rel="icon" type="imagem/png" href="imagens/logoa.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <title>Usuários</title>
</head>
<body>
<center>
        <div id="mae">
            <font face="Arial" size="4" color="black">
                <?php
                    include "barra_fixa.php";
                ?>
                <a name="topo"></a>
                <h1>VISUALIZAR USUÁRIOS</h1>
                <form method="post">
                    <p><b>Pesquisar:</b></p>
                   <input type="text" name="pesq" size="50" required>;Nome do Usuário
                    &nbsp;&nbsp;&nbsp;&nbsp;
 <br><br>
                    <button type="submit" class="btn_carrinho border2 border222"><i class="fas fa-arrow-down"></i></button>
                </form>
                
                
                <!-------------------------------------------------------------------------------------------------------->

                <?php                
                    $pesq = $_POST[pesq];
                ?>
                    
<!-------------------------------------------------------------------------------------------------------->
                
                 <table border="1px" cellpadding="5px" cellspacing="0">
                        <thead>
                            <tr class="dif">
                                <th width="110" align="left">Id Cliente</th>
                                <th width="110" align="left">Nome</th>
                                <th width="120" align="left">Data de Nascimento</th>
                                <th width="400" align="left">Email</th>
                                <th width="110" align="left">Mais Detalhes</th>
                            </tr>
                        </thead>
<!-------------------------------------------------------------------------------------------------------->

                <?php    
                        include "conexao.php";
                      $sql = "SELECT * FROM cliente WHERE nome LIKE '%$_POST[pesq]%' AND excluido = 'n' ORDER BY id_cliente;";
                     
                      $resultado = pg_query($conecta, $sql);
                        $qtde = pg_num_rows($resultado);
                    
                        if ($qtde > 0)
                        {
                            for ($cont=0; $cont < $qtde; $cont++)
                            {
                                $linha = pg_fetch_array($resultado);
                                echo '<tr class="dif">    
                                      <td>'.$linha['id_cliente'].'</td>
                                      <td>'.$linha['nome'].'
                                          <a href="#" class="link_azul"><i class="fas fa-eye fa-1x aria-hidden="true" pull-right fa-border"></i></a>
                                      </td>
                                      <td>'.date("d/m/Y", strtotime($linha[data_nasc])).'</td>
                                      <td>'.$linha['email'].'</td>
                                      <td><a href="#" class="link_azul">Mais detalhes</a></td>
                                      </tr>'; 
                            } 
                        }
                        else
                            echo "<br><br>";
                            //echo "Não foi encontrado nenhum cliente!<br><br>";
                        pg_close($conecta);
                    ?>
                    
                    <!-------------------------------------------------------------------------------------------------------->

                    </table>
                
                <br><br>
                
                <?php
                    include "roda_pe.html";
                ?>
                <br><br>
            </font>
        </div>
    </center>
</body>

</html>

                    