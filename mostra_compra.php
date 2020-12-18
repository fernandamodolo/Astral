//Script feito por Fernanda Modolo em 28/08


<?php
    
    session_start();
    if(!isset($_SESSION["logou"]))
    {
        echo("você nao está logado, faça o seu login agora!");
        echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
        exit;
    } 
?>
DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title> Suas Compras</title>
</head>
<body>

<?php
    session_start();
    if($_POST['email'] != NULL)
    {
        include "conexao.php";
        $_SESSION['login'] = $email;
        $sql="SELECT * FROM cliente WHERE email = '$email';";
         $resultado=pg_query($conecta,$sql);
         $qtde=pg_num_rows($resultado);
         if ( $qtde == 0 )
         {        
             echo "<script type='text/javascript' language='javascript'> alert('faça o login!'); </script>";
//                include "cadastro.php"; //caso nÃ£o econtre o usuÃ¡rio, redireciona para cadastrar
             
         }
         if($qtde > 0)
         {
            $linha = pg_fetch_array($resultado);
            $id_usuario=$linha[0];
         }

         $sql2="SELECT * FROM compra WHERE id_cliente = '$id_usuario';";
         $resultado2=pg_query($conecta,$sql2);
         $qtde2=pg_num_rows($resultado2);
         if ( $qtde2 == 0 )
         {        
             echo "<script type='text/javascript' language='javascript'> alert('Voce ainda não fez nenhuma compra'); </script>";
//                include "cadastro.php"; //caso nÃ£o econtre o usuÃ¡rio, redireciona para cadastrar
         }
         if($qtde2 > 0)
         {
            $linha2 = pg_fetch_array($resultado);
            $id_compra=$linha2[0];
         }

         $sql3="SELECT * FROM itens_compra WHERE id_compra = '$id_compra';";
         $resultado3=pg_query($conecta,$sql3);
         $qtde3=pg_num_rows($resultado3);

         if ($qtde3 > 0)
         {
            $sql4="SELECT id_prod, descricao, preco, imagem FROM table produtos INNER JOIN itens_compra ON produtos.id_prod = itens_compra.id_prod;";
            $resultado4=pg_query($conecta,$sql4);
            $qtde4=pg_num_rows($resultado4);
            $linha2 = pg_fetch_array($resultado4);

            echo "produto : .$linha2[1].<br><br>";
             echo "Email : .$linha2[4].<br><br>";
             echo "Senha : .$linha2[6].<br><br>";
            
         }

    }    
?>

</body>
</html>


