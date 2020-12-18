<!-- Autora: Fernanda Castor Modolo
     25/08/2020
     
    Mostra dados usuário -->

/*<!--
  
   session_start();
    if(!isset($_SESSION["logou"]))
    {
        echo("você nao está logado, faça o seu login agora!");
        echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
        exit;
    }
?>*/-->
    

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
        <link rel="stylesheet" type="text/css" href="style_alt.css">
    <title>Seus dados</title>
</head>
<body>
   <center>
    <div id="mae">
        <font face="Arial" size="4" color="black">
           
            <div id="barrafixa">
                <font size="6">
                 <div id="posicao_logo"><a href="index.html"><img src="imagens/logo.png" alt="Logotipo Astral" width="78"></a></div>
                 <div id="posicao_links">
                 <a href="index.html" class="link_principal">Home</a>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="dev.html" class="link_principal">Desenvolvimento</a>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="comprar.php" class="link_principal">Comprar</a>
                 </div>
                 <div id="posicao_icones">
                 <a href="pesquisa.php"><img src="imagens/icone_pesquisa.png" height="45"></a> &nbsp;&nbsp;
                 <a href="pagina.php"><img src="imagens/icone_usuario.png" height="45"></a> &nbsp;&nbsp;
                 <a href="carrinho.php"><img src="imagens/icone_carrinho.png" height="45"></a>
                 </div>
                </font>
            </div> <!--barrafixa-->
            
            <a name="topo"></a>
            <br><br>
           
            <h1>-- Meus dados--</h1>
            <br>
            <?php
     //session_start();
     //if($_POST['email'] != NULL)
     //{
         include "conexao.php";
        //$_SESSION['login'] = $email;
         $email='fermodolo08@gmail.com';
         $sql="SELECT * FROM cliente WHERE email = '$email';";
         $resultado=pg_query($conecta,$sql);
         $qtde=pg_num_rows($resultado);
         if ( $qtde == 0 )
         {        
             echo "<script type='text/javascript' language='javascript'> alert('UsuÃ¡rio ou senha incorretos!'); </script>";
//                include "cadastro.php"; //caso nÃ£o econtre o usuÃ¡rio, redireciona para cadastrar
             
         }
         if($qtde > 0)
         {
            
             $linha = pg_fetch_array($resultado);

         }
    // }
         
     echo "<form action='altera_dados.php? class='cad_pessoa' method='POST'>";
     ?>
           <input type='text' class='insere' name='name' value='<?php echo $linha[1];?>'  autocomplete='off'>
            <input type='date' class='insere' name='dt_nas' value='<?php echo $linha[2];?>' autocomplete='off'>
           <input type='text' class='insere' name='tel' value='<?php echo $linha[3];?>'  autocomplete='off'>
            <input type='text' class='insere' name='cpf' value='<?php echo $linha[4];?>'  autocomplete='off'>
             <input type='text' class='insere' name='end' value='<?php echo $linha[5];?>'  autocomplete='off'>
             <input type='text' class='insere' name='end' value='<?php echo $linha[6];?>'  autocomplete='off'>
                      
            <input type='email' class='insere' name='email' value='<?php echo $linha[7];?>' autocomplete='off'>
            <input type='password' class='insere' name='password' value='<?php echo $linha[8];?>' autocomplete='off'>
            <input type='password' class='insere' name='passconfirma' value='<?php echo $linha[8];?>' autocomplete='off'>
            <input type='submit' class='button' value='Alterar'>  
        </form>    
           
        
             <a href="pag_usuario.php">Voltar</a><br><br>
            <br><br>
            <div id="rodape">
            <br><hr>       
            <a href="index.html" class="link_rodape">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="dev.html" class="link_rodape">Desenvolvimento</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="comprar.php" class="link_rodape">Comprar</a>
            <hr>
            <br>
            <p>08 - Bruna | 12 - Eduardo | 14 - Fernanda | 18 - Jean | 21 - José Henrique | 27 - Marcela</p>
            <br>
            <p><a href="#topo" class="link_voltar_topo">Voltar ao topo</a></p>
            <br><br>
            </div> <!-- rodape -->
        </font>
    </div> <!-- mae -->
   </center>
</body>
</html>