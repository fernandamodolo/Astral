<!-- Autora: Fernanda Castor Modolo
     25/08/2020
     
    Mostra compras usuário -->
<?php
   session_start();
    if(!isset($_SESSION["logou"]))
    {
       echo "<script type='text/javascript' language='javascript'> alert('Faça o login'); </script>";
        echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=usuario.php'>";
        exit;
    }
?>
    

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
    <link rel="stylesheet" type="text/css" href="style_minhas_compras.css">
    <title>Minhas Compras</title>
</head>
<body>
  <center>
    <div id="mae">
        <font face="Arial" size="4" color="black">
           
            <a name="topo"></a>
             <?php
             include "barra_fixa.php";
            ?>
           
          <div id="grade">
            <h1>MINHAS COMPRAS</h1>
            <br>
            
			<br><br>
            <?php
           
            session_start();
     if(isset($_SESSION['login']))
     {
          include "conexao.php";
         $email = $_SESSION['login'];
                    //echo "logou funcinando e pegou id_cliente e email <br>";
                    //echo "email = ".$email."<br>";
            
          if(isset($_SESSION['id_cliente'])) // pega id do cliente logado
            {
                $id_cli = $_SESSION['id_cliente'];
                //echo "id = ".$id_cliente;
            }
         
       /* $email='bruna.l.sousa@unesp.br';
         $sql0="SELECT * FROM cliente WHERE email = '$email';";
         $resultado0=pg_query($conecta,$sql0);
         $qtde0=pg_num_rows($resultado0);
         if ( $qtde0 == 0 )
         {        
             echo "<script type='text/javascript' language='javascript'> alert('Faça o login nao encontrou bd'); </script>";
              include "pagina.php"; //caso nÃ£o econtre o usuÃ¡rio, redireciona para cadastrar
             
         }
         if($qtde0 > 0)
         {
             $linha0 = pg_fetch_array($resultado0);
             $id_cli = $linha0['id_cliente'];
             
         }*/
        
       
         
              $sql ="select * from compra where id_cliente= '$id_cli'  ;";
             $resultado=pg_query($conecta, $sql);
             $qtde=pg_num_rows($resultado);
             if($qtde>0)
             {
                 
                 for ($cont = 0; $cont < $qtde; $cont++)//for da compra
                {
                  $linha = pg_fetch_array($resultado);
                 $id_compra = $linha[0];
                 
                     
                 $sql2 = "select * from itens_compra where id_compra = '$id_compra' AND excluido ='n' ;";
                 $resultado2= pg_query($conecta, $sql2);
                 $qtde2=pg_num_rows($resultado2);
                 
                 if($qtde2>0)
                     
                 {
                     for ($cont2 = 0; $cont2 < $qtde2; $cont2++)//quando tem mais de 1 produto na mesma compra
                    {
                     $linha2 = pg_fetch_array($resultado2);
                     $id_prod = $linha2['id_prod'];
                    
                     $quantidade = $linha2['quantidade'];
                     $preco = $linha2['preco'];
                     $compra = $preco * $quantidade; 
                     
                     $compra2 = number_format($compra, 2, ',', '.');
                     $sqlp = "select descricao from produtos where id_prod = '$id_prod' AND excluido ='n';";
                     $resultadop= pg_query($conecta, $sqlp);
                     $linhap = pg_fetch_array($resultadop);
                         
                      ?>
                 
                      <br><br>
                 <div id="minhas_compras">
                 <br>
                  
                   &nbsp;&nbsp;&nbsp;&nbsp;ID da compra: <?php echo "".$id_compra; ?> <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;Produto: <?php echo "".$linhap['descricao']; ?> <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;Quantidade: <?php echo "".$linha2['quantidade']; ?> <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;Preço: <?php echo "R$ ".$compra2; ?> <br>
                  
                 </div>
                   <?php
                     
                     $linha = "";
                     $linhap="";
                     $linha2="";
                     $compra2="";
                
                
                     }
                     $id_compra = "";
              }
           } 
                   
          
        }
             else
             {
                 echo "Você ainda não efetivou nenhuma compra em nosso site!";
             }
            echo "<br>";
    
           
            
           
            
 }
             
           

       
       ?><p>
         <br><br>
          <a href="pag_usuario.php"><button style="background: black; border-radius: 6px; padding: 15px; cursor: pointer; color: #fff; border: none; font-size: 16px;">Voltar</button></a>
           

       </p>
          
            <br>
             <?php
             include "roda_pe.html";
            ?>
        </font>
       </div>     
    </div> <!-- mae -->
   </center>
</body>
</html>