<!-- Autora: Marcela Soares Evangelista - 27
     set/2020
     
     PÁGINA HOME  -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
    <link rel="icon" type="imagem/png" href="imagens/logoa.png">
    <title>Finalizar Compra</title>
</head>

<body>
    <center>
        <div id="mae">
            <font face="Arial" size="4" color="black">

                <?php
                    include "barra_fixa.php";
                ?>

                <a name="topo"></a>

                <div id="conteudo_principal">

<!-------------------------------------------------------------------------------------------------------->

                <?php
            
            include "conexao.php";
            session_start();

            if(isset($_SESSION['login'])) // pega email do cliente logado
            {
                $email = $_SESSION['login'];
                //echo "email = ".$email."<br>";
            }
            
            $sqlc="select from cliente where email=$email;";
            $resc = pg_query($conecta, $sqlc);
            $regc = pg_num_rows($resc);
            if(regc>0)
            {
               $linhac = pg_fetch_array($resc);
                $id_cliente=$linhac[0];
                $_SESSION['id_cliente']=$id_cliente;
            }
                    
           if(isset($_SESSION['id_cliente'])) // pega id do cliente logado
            {
                $id_cliente = $_SESSION['id_cliente'];
                //echo "id = ".$id_cliente;
            }
            
            if(!isset($_SESSION['carrinho'])) // pega os dados do carrinho
            {
                $_SESSION['carrinho'] = array();
            }
            
			if(count($_SESSION['carrinho']) == 0) // verifica se há produtos no carrinho
			{
                echo '<h1>COMPRA NÃO FINALIZADA</h1>';
				echo '<tr><td colspan="5">Não há produto no carrinho.<br><br></td></tr>';
                echo '<a href="carrinho.php" class="link_azul">Voltar</a><br>';
                include "roda_pe.html";
                exit;
			}                
            else
            {
                ?>

                
                
<!-------------------------------------------------------------------------------------------------------->

                <h1>COMPRA FINALIZADA</h1>

                <table>
                    <thead>
                        <tr>
                            <th width="280" align="left">Produto</th>
                            <th width="130" align="left">Quantidade</th>
                            <th width="110" align="left">Preço</th>
                            <th width="110" align="left">SubTotal</th>
                        </tr>
                    </thead>
                
<!-------------------------------------------------------------------------------------------------------->
                
                <?php    
                    require("conexao.php");
                    $total = 0;
                    $i=0;
                    // MOSTRAR DADOS DA COMPRA PARA CLIENTE
                    foreach($_SESSION['carrinho'] as $id_prod => $qtd)
                    { // Início do FOREACH
                        $sql = "SELECT * FROM produtos WHERE id_prod = $id_prod AND	excluido = 'n' ORDER BY descricao";
                        $res = pg_query($conecta, $sql);
                        $regs = pg_num_rows($res);
                        
                        if($regs>0)
                        {
                            $linha = pg_fetch_array($res);
                            $descricao = $linha['descricao'];
                            $preco = $linha['preco'];
                            $sub = $preco * $qtd;
                            $total += $sub;
                            $preco = number_format($preco, 2, ',', '.');
                            $sub = number_format($sub, 2, ',', '.'); //formata para padrão brasileiro.
                        }

                        echo '<tr>
                            <td>'.$descricao.'</td>
                            <td>'.$qtd.'</td>
                            <td>R$ '.$preco.'</td>
                            <td>R$ '.$sub.'</td>
                              </tr>';


                    }// Término do FOREACH

                        $total = number_format($total, 2, ',', '.');
                        $_SESSION['total'] = $total;
                        echo '<tr><td colspan="3"><b>TOTAL</b></td><td><b>R$ '.$total.'</b></td></tr>';
                    
                ?>
                
                </table>
                
                <?php
                
                $_SESSION['pagamento'] = $_POST[pagamento];
                
                /* PEGAR ENDEREÇO COMPLETO COM CEP */
                
                $cep = $_POST[cep];
                $logradouro = $_POST[logradouro];
                $bairro = $_POST[bairro];
                $numero = $_POST[numero];
                $complemento = $_POST[complemento];
                
                if($complemento==NULL)
                    $endereco = $logradouro.", ".$numero.". ".$bairro.". ".$cep.".";                
                else
                    $endereco = $logradouro.", ".$numero.". ".$bairro.", ".$complemento.". ".$cep.".";
                
                //NAO ESQUER DO $ENDERECO DA TABELA          
                              
                // GRAVAR NA TABELA COMPRA
                $sql = "INSERT INTO venda VALUES (DEFAULT,NOW(),'f');";
                $sql = "INSERT INTO compra VALUES (DEFAULT,".$id_cliente.",NOW(),'n',NULL,'".$endereco."');";
                $res = pg_query($conecta, $sql);

                foreach($_SESSION['carrinho'] as $id_prod => $qtd)
                { // Início do FOREACH
                    $sql = "SELECT * FROM produtos WHERE id_prod = $id_prod AND excluido = 'n' ORDER BY descricao";
                    $res = pg_query($conecta, $sql);
                    $linha = pg_fetch_array($res);
                    $preco = $linha['preco'];

                    // GRAVAR NA TABELA ITENS_COMPRA
                    $sql = "INSERT INTO itens_compra VALUES (CURRVAL('id_compra'),".$id_prod.",".$qtd.",".$preco.",'n',NULL);";
                    $res = pg_query($conecta, $sql);

                    // BAIXA NO ESTOQUE
                    $sql = "UPDATE produtos SET qtde_estoque = qtde_estoque -" .$qtd. "WHERE id_prod =" .$id_prod. "AND excluido = 'n'";
                    $resultado = pg_query($conecta, $sql);
                    $linha = pg_num_rows($resultado);
                    if($linha>0)
                    {
                        echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
                    }
                } // Término do FOREACH
    unset($_SESSION['carrinho']);
                // Encerra SESSION

              session_start();

            $sqlc="select * from compra where id_cliente='$id_cliente' order by id_compra DESC;";
            $resultadoc=pg_query($conecta,$sqlc);
            $qtdec=pg_num_rows($resultadoc);
            if($qtdec > 0)
            {
                $linhac = pg_fetch_array($resultadoc);
                $id_compra=$linhac['id_compra'];
                echo "<br><br>";
                /*echo "<form action='fpdf/cabecalho_rodape.php?id_compra=".$id_compra."' method='post' target='_blank'>"
                ?>
                    <input type='submit' class='btn_cliente border2 border222' value=' Gerar Relatório'>
                <?php
                echo "</form>";*/
                $data_compra=$linhac['data_compra'];
                $_SESSION['id_compra']=$id_compra;
                $_SESSION['data_compra']=$data_compra;
                $_SESSION['endereco']=$linhac['endereco'];
                // echo "<script type='text/javascript'>alert('pegando id do compra!')</script>";
                // echo $_SESSION['id_cliente'];
                //echo"<br>" .$_SESSION['id_compra'];
            }
                
            }//FECHA ELSE

            //pegar produtos------------------------------------------------------------------------
            $sql2 = "SELECT produtos.descricao, itens_compra.quantidade, produtos.preco
            FROM itens_compra JOIN compra ON itens_compra.id_compra=compra.id_compra
            INNER JOIN produtos ON itens_compra.id_prod=produtos.id_prod
            INNER JOIN cliente ON cliente.id_cliente=compra.id_cliente
            WHERE cliente.id_cliente = '$id_cliente' AND compra.id_compra = '$id_compra' ORDER BY data_compra;";

            $resultado2 = pg_query($conecta, $sql2);
            $qtde2 = pg_num_rows($resultado2);

            if ($qtde2 < 0)
            {
                return;
            }

            $i = 0;
            $total = 0;

            while ($linha2 = pg_fetch_array($resultado2))
            {
                $descricao = $linha2['descricao'];
                $quantidade = $linha2['quantidade'];
                $preco = $linha2['preco'];

                $subtotal = $preco * $quantidade;
                $total += $subtotal;

                if($i == 0)
                {
                    $_SESSION['produtos'] = array(array("$descricao", "$quantidade", "$subtotal,00"));
                }
                else
                {
                    array_push($_SESSION['produtos'], array("$descricao", "$quantidade", "$subtotal,00"));
                }

                $i++;
            }
                    
            echo "<form action='fpdf/cabecalho_rodape.php?id_compra=".$id_compra."' method='post' target='_blank'>"
                ?>
                    <input type='submit' class='btn_cliente border2 border222' value=' Gerar Relatório'>
                <?php
                echo "</form>";
        ?>
<!-------------------------------------------------------------------------------------------------------->
                    
                </div> <!-- conteudo_principal -->
                <br>
        <?php
            include "roda_pe.html";
        ?>
            </font>
        </div> <!-- mae -->
    </center>
</body>

</html>
