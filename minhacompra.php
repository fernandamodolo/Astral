<!-- Autora: Fernanda Castor Modolo
     25/08/2020
     
    Mostra dados usuário -->
<?php
   session_start();
    if(!isset($_SESSION["logou"]))
    {
        echo("você nao está logado, faça o seu login agora!");
        echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
        exit;
    }
?>
    

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
    <link rel="stylesheet" type="text/css" href="style_minhas_compras.css">
    <title>Seus dados</title>
</head>
<body>
  <center>
    <div id="mae">
        <font face="Arial" size="4" color="black">
            <div id="barrafixa">
                <font size="6">
                <div id="#cent_vert">
                 <a href="index.html">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="dev.html">Alunos</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="comprar.php">Comprar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="login.php"><img src="imagens/icone_usuario.png" height="45"></a> &nbsp;&nbsp; <!--talvez muda isso-->
                 <a href="carrinho.php"><img src="imagens/icone_carrinho.png" height="45"></a>
                </div>
                </font>
            </div>
            <a name="topo"></a>
            <br><br>
           
            <h1>-- Minhas Compras--</h1>
            <br>
            <?php
     session_start();
     if($_POST['email'] != NULL)
     {
         include "conexao.php";
        $_SESSION['login'] = $email;
         //$email='jeansbeltrame@gmail.com';
         $sql0="SELECT * FROM cliente WHERE email = '$email';";
         $resultado0=pg_query($conecta,$sql0);
         $qtde0=pg_num_rows($resultado0);
         if ( $qtde0 == 0 )
         {        
             echo "<script type='text/javascript' language='javascript'> alert('Faça o seu Cadastro!'); </script>";
//                include "cadastro.php"; //caso nÃ£o econtre o usuÃ¡rio, redireciona para cadastrar
             
         }
         if($qtde0 > 0)
         {
             $linha = pg_fetch_array($resultado);
             $id_cliente = $linha[0];
         }
         $sql_contagem="select * from compra where id_cliente= '$id_cliente'";
				
         $resultadoc= pg_query($conecta, $sql_contagem);
         $total=pg_num_rows($resultadoc);
         
         // Verifica se $pagina existe, senão deixa na primeira página como padrão
         $pagina = (isset($_GET["pagina"])) ? ($_GET["pagina"]) : 1;
         
         // Defina aqui a quantidade máxima de registros por página.
         $limite = 3;
         
         // Gera outra variável, desta vez com o número de páginas que será preciso. 
         // O comando ceil() arredonda "para cima" o valor
             $inicio = ($pagina * $limite) - $limite;
             $sql ="select * from compra where id_cliente= '$id_cliente' limit $limite offset $inicio";
             $resultado= pg_query($conecta, $sql);
             $qtde=pg_num_rows($resultado);
             if($qtde>0)
             {
                 for ($cont = 0; $cont < $qtde; $cont++)
             {
                 $linha = pg_fetch_array($resultado);
                 $id_compra = $linha ['id_compra'];
                 $sql2 = "select * from itens_compra where id_compra = $id_compra;";
                 $resultado2= pg_query($conecta, $sql2);
                 $qtde2=pg_num_rows($resultado2);
                 if($qtde2>0)
                 {
                     $linha2 = pg_fetch_array($resultado2);
                     $id_prod = $linha2['id_prod'];
                     $preco = $linha2['preco'];
                     $quantidade = $linha2['quantidade'];
                     $compra = $preco * $quantidade; 
                     $compra2 = number_format($compra, 2, ',', '.');
                     $sqlp = "select nome from produtos where id_prod = $id_prod";
                     $resultadop= pg_query($conecta, $sqlp);
                     $linhap = pg_fetch_array($resultadop);
                     
                 ?>
                 <br><br><br>
                 <div id="minhas_compras">
                 <br>
                  <!--&nbsp;&nbsp;&nbsp;&nbsp;Quantidade: <?php ?><br-->
                  &nbsp;&nbsp;&nbsp;&nbsp;Produto: <?php echo "".$linhap['nome']; ?> <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;Quantidade: <?php echo "".$linha2['quantidade']; ?> <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;Preço: <?php echo "R$ ".$compra2; ?> <br>
                 </div>
         <?php  
             }
             } 
             }
             else
             {
                 echo "Você ainda não efetivou nenhuma compra em nosso site!";
             }
             echo "<br>";
             
           $tot_paginas = ceil($total / $limite);
           $max_links = 3;
         // Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
         
         echo "<a href='minhacompra.php?pagina=1&busca=$pesquisa'>primeira pagina</a> ";
         // Cria um for() para exibir os 3 links antes da página atual
         for($i = $pagina-$max_links; $i <= $pagina-1; $i++) 
         {
         // Se o número da página for menor ou igual a zero, não faz nada,
         // pois não existe página 0, -1, -2 etc.
             if($i > 0) 
             {
             echo "<a href='minhacompra.php?pagina=$i'>".$i."</a> ";
             }
         }
         // Exibe a página atual, sem link, apenas o número
         echo $pagina." ";
         // Cria outro for(), desta vez para exibir 3 links após a página atual
         for($i = $pagina+1; $i <= $pagina+$max_links; $i++) 
         {
         // Quando a página atual for maior do que a última página, não apresenta link.
             if($i <= $tot_paginas)
             {
             echo "<a href='minhacompra.php?pagina=$i'>".$i."</a> ";
             }
         }
         // Exibe o link "última página"
         echo " <a href='minhacompra.php?pagina=$tot_paginas&busca=$pesquisa'>ultima pagina</a>";
       
        }
       
       ?>
          <a href="pag_usuario.php">Voltar</a><br><br>
            <br><br>
            <hr>
            <a href="index.html">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="dev.html">Alunos</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="comprar.php">Comprar</a>
            <hr>
            <br>
            <p>08 - Bruna | 12 - Eduardo | 14 - Fernanda | 18 - Jean | 21 - José Henrique | 27 - Marcela</p>
            <br>
            <a href="#topo">Voltar ao topo</a>
            <br><br>
        
        </font>
    </div>
   </center>
</body>
</html>