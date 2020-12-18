<!-- Autora: Fernanda Castor Modolo
     31/08/2020
     
     PÁGINA USUÁRIO -->
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
                 <a href="dev.html">Desenvolvedores</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="comprar.php">Comprar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="login.php"><img src="imagens/icone_usuario.png" height="45"></a> &nbsp;&nbsp;
                 <a href="carrinho.php"><img src="imagens/icone_carrinho.png" height="45"></a>
                </div>
                </font>
            </div>
            <a name="topo"></a>
            <br><br>
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
            $nome= $linha[1];

         }
     }
           ?> 
           
            <h1>-- Olá <?php echo $nome?>  --</h1>
            <br>
            <font size="5">
               <br><a href="mostra_dados.php">Meus dados</a><br><br>
               <a href="altera_dados.php">Alterar Dados</a><br><br>
               <a href="minhas_compras.php">Minhas Compras</a><br><br>
           </font>
            <br><br>
            <hr>
            <a href="index.html">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="dev.html">Desenvolvedores</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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