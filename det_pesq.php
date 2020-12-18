<!-- Autora: Fernanda Castor Modolo
     24/10/2020
     
    Mais Detalhes pesquisa-->
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
        <link rel="stylesheet" type="text/css" href="style_alt.css">
         <link rel="icon" type="imagem/png" href="imagens/logoa.png">
    <title>Mais Detalhes</title>
</head>
<body>
   <center>
    <div id="mae">
        <font face="Arial" size="4" color="black">
           
           
            <a name="topo"></a>
            <?php
             include "barra_fixa.php";
            include "barra_lateral.html";
            ?>
           
            <h1> Detalhes</h1>
           <?php     
             
          include "conexao.php";
          
                //dados enviados do script altera_mostra_todos.php
                $id_cliente = $_GET["id_cliente"];
             $sql=  "SELECT * FROM cliente WHERE id_cliente = '$id_cliente' ;";
         $resultado=pg_query($conecta,$sql);
         $qtde=pg_num_rows($resultado);
         if ( $qtde == 0 )
         {        
             echo "<script type='text/javascript' language='javascript'> alert('Usuario NÃo encontrado!'); </script>";
               echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=altera_mostra_todos.php'>";
             
        exit;
             
         }
         else 
         {
            
             $linha = pg_fetch_array($resultado);

        
  
             if($linha[9]=="F")
             {
                 $sexo="Feminino";
             }
            else if($linha[9]=="M")
            {
               $sexo="Masculino";
            }
            else
            {
                $sexo="Outro";
            }
            
        
//     echo "<form action='altera_dados.php?' class='cad_pessoa' method='POST'>";
     ?>
        <form action='#' name="alt" class='cad_pessoa' method='POST' >
          
          <label align="left">ID cliente<input type='text' class='insere' name='id_cliente' value='<?php echo $linha[0];?>'  autocomplete='off' readonly="readonly" ></label>
          
           <label align="left">Nome:<input type='text' class='insere' name='nome' value='<?php echo $linha[1];?>'  autocomplete='off' readonly="readonly"></label>
           
           <label align="left">Sexo<input type='text' class='insere' name='name' value='<?php echo $sexo;?>'  autocomplete='off' readonly="readonly"></label>
           
            <label align="left">Data de Nascimento<input type='date' class='insere' name='dt_nas' value='<?php echo $linha[2];?>' autocomplete='off' readonly="readonly"></label>
            
            <label align="left">Telefone<input type='text' class='insere' name='tel'id="tel" value='<?php echo $linha[3];?>'  autocomplete='off'  readonly="readonly" ></label>
          
                      
            <label align="left">Email <input type='email' class='insere' name='email' value='<?php echo $linha[4];?>' readonly="readonly"> </label>
           
             <label align="left">Senha <input  type="password" class='insere' name="senha"  value = '<?php echo $linha[5];?>' autocomplete='off' readonly="readonly"></label>
          
          
          </form>
         <?php
         echo "<form action='altera_adm.php?id_cliente=$linha[0]' method='post'>";?>
            
                <input type="submit" class="btn_menu border2 border222" value="Alterar"> 
             <?php echo "</form>";
             
            
     
          echo "<form action='chamada_desativacao.php?id_cliente=$linha[0]' method='post'>";?>
            
                <input type="submit" class="btn_menu border2 border222" value="Desativar"> 
             <?php echo "</form>";?>
            
             <form action="pesq_usuario_adm.php?$id_cliente=" method="post">
                <input type="submit" class="btn_menu border2 border222" value="Voltar"> 
            </form>
     
            <?php
             include "roda_pe.html";
             //session_destroy();
              }
            ?>