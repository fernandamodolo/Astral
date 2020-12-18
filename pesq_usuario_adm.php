<!-- Autora: Fernanda Castor Modolo
     07/10/2020
     
   Mostra usuários pesquisa  - adm -->
   <!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
     <link rel="stylesheet" type="text/css" href="style_desativacao_reativacao.css">
    <link rel="stylesheet" type="text/css" href="style_desativacao_reativacao_email.css">
    <link rel="stylesheet" type="text/css" href="style_desativacaoereativacao.css">
    <link rel="stylesheet" type="text/css" href="estilo_comprar.css">
    <link rel="icon" type="imagem/png" href="imagens/logoa.png">
    <title>Usuários - Pesquisa</title>
</head>
<body>

<center>
        <div id="mae">
            <font face="Arial" size="4" color="black">
                <?php
                    include "barra_fixa.php";
                include "barra_lateral.html";
               
                 $local = $_SERVER['PHP_SELF'];
                ?>
                <div id="conteudo_principal">
            <h1>Pesquisa Usuários</h1>
            <br>
            <center>
                
                
                <form method="post">
                    <p><b>Pesquise :</b></p>
                   <input type="text" name="pesq" value="<?php echo $_POST['pesq'] ?>" size="50" >
                    &nbsp;&nbsp;<br><br>
                
                    <p><b>Ordenar por:</b></p>
                    
                    <input type="radio" name="ordem" value="id_cliente" checked>&nbsp;Id do Cliente
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="ordem" value="nome">&nbsp;Nome
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                   
                    <button type="submit" class="btn_carrinho border2 border222"><i class="fas fa-arrow-down"></i></button>
                   
                
                <br>
 <br><br>
                    
                </form>
                 <br><br>
                
                <!-------------------------------------------------------------------------------------------------------->

                <?php   
                   
                     include "conexao.php";
                    $pesq = $_POST['pesq'];
                  $ordem=$_POST['ordem'];
                ?>
                    
<!-------------------------------------------------------------------------------------------------------->


    <div class="grade">
         <?php    
                     include "conexao.php";
                    
                     if($pesq=="")
                    {
                         
                     
                        
                      $sql = "SELECT * FROM cliente WHERE adm = 'n'AND exclusao ='n'   ORDER BY $ordem  ;";
                     
                      $resultado = pg_query($conecta, $sql);
                        $qtde = pg_num_rows($resultado);
                
                        if ($qtde > 0)
                        {
                            
                            
                            for ($cont=0; $cont < $qtde; $cont++)
                            {
                                echo "<div class=coluna>";
                                $linha = pg_fetch_array($resultado);
                                ?>

                                <div id="contas_usuarios">
                                <div id="email_usuarios">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "".$linha [email]; ?> 
                                </div>
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;ID do cliente: <?php echo "".$linha [id_cliente]; ?> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Nome: <?php echo "".$linha[nome]; ?> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Data de Nascimento: <?php echo "".date ("d/m/Y", strtotime($linha[data_nasc])); ?> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Sexo: <?php echo "".$linha[sexo]; ?> <br>
                                <?php
                                    if ($linha['telefone'] == null)
                                    {
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;Telefone: Não registrado.";
                                    }
                                    else
                                    {
                                         echo "&nbsp;&nbsp;&nbsp;&nbsp;Telefone: ".$linha[telefone]; "<br>";
                                          
                                    }
                                

                                    if ($linha['adm'] == 'n')
                                    {
                                        echo "<br>";
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;Administrador: Não.";
                                    }
                                    else
                                    {
                                        echo "<br>";
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;Administrador: Sim."; 
                                    }
                                

                                echo "<form action='det_pesq.php?id_cliente=$linha[0]' method='post'>";
                                ?>
                                </div>

                               <input type='submit' class='btn_desativacao_reativacao border2 border222' value='Detalhes'>
                                <?php echo "</form>";
                                echo "<br><br>";
                               echo "</div>";
                                    
                               
                                

                                 
                            
                            }
                        }
                            
                         
                    else
                            echo "<br><br>";
                            //echo "Não foi encontrado nenhum cliente!<br><br>";
                    } 
           
        
        else
        {
            
       
                         
                         $sql2 = "SELECT * FROM cliente WHERE exclusao ='n' AND upper (nome) LIKE  upper ('%$pesq%')  ORDER BY $ordem;";
                            $resultado2 = pg_query($conecta, $sql2);
                            $qtde2 = pg_num_rows($resultado2);
                         if ($qtde2 > 0)
                        {
                            for ($cont=0; $cont < $qtde2; $cont++)
                            {
                                 echo "<div class=coluna>";
                                $linha2 = pg_fetch_array($resultado2);
                                ?>

                                <div id="contas_usuarios">
                                <div id="email_usuarios">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "".$linha2 [email]; ?> 
                                </div>
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;ID do cliente: <?php echo "".$linha2 [id_cliente]; ?> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Nome: <?php echo "".$linha2[nome]; ?> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Data de Nascimento: <?php echo "".date ("d/m/Y", strtotime($linha2[data_nasc])); ?> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Sexo: <?php echo "".$linha2[sexo]; ?> <br>
                                <?php
                                    if ($linha2['telefone'] == null)
                                    {
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;Telefone: Não registrado.";
                                    }
                                    else
                                    {
                                         echo "&nbsp;&nbsp;&nbsp;&nbsp;Telefone: ".$linha2[telefone]; "<br>";
                                          
                                    }
                                
                                if ($linha['adm'] == 'n')
                                    {
                                        echo "<br>";
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;Administrador: Não.";
                                    }
                                    else
                                    {
                                        echo "<br>";
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;Administrador: Sim."; 
                                    }
                                
                                       
                                echo "<form action='det_pesq.php?id_cliente=$linha2[0]' method='post'>";
                                ?> 
                                </div>

                               <input type='submit' class='btn_desativacao_reativacao border2 border222' value='Detalhes'>
                                <?php echo "</form>";
                                echo "<br><br>";
                               echo "</div>";
                            }
                         }
             }
       
        
        ?>
                            
                                 
                                     
                                <br><br>
                                 
                                           
                   </div> 
                </center>

            </div>
            
            <br>
            
            <?php
                include "roda_pe.html";
            ?>
            
        </font>
    </div>
   </center>
</body>
</html>
   