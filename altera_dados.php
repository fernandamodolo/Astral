<?php
        session_start();
        $_SESSION['login'] = $email;

        
       
        include "conexao.php";
        $sql="SELECT * FROM cliente WHERE email = '$email';";
        $resultado=pg_query($conecta,$sql);
        $qtde=pg_num_rows($resultado);
        if ( $qtde == 0 )
        {        
            echo "<script type='text/javascript' language='javascript'> alert('Você ainda não possui um cadastro!'); </script>";
               include "cadastro.php"; //caso nÃ£o econtre o usuÃ¡rio, redireciona para cadastrar
            
        }
        if($qtde > 0)
        {
           $linha = pg_fetch_array($resultado);
           $id_cliente=$linha[0];
        }
					$nome_usuario = $_POST['nome']; 
					$data_nasc = $_POST['data_nasc']; 
					$celular = $_POST['celular'];
					$endereco = $_POST['endereco'];
					$cpf = $_POST['cpf']; 
					$cidade = $_POST['cidade'];
                    $email2 = mb_strtolower($_POST['email'],'UTF-8');
                    $senha = $_POST['senha'];
                    $nova_senha= $_POST['nova_senha'];
                    $confirma_senha= $_POST['confirma_senha'];
                    //$senha = md5($senha);
         $sql2 = "select * from cliente where email ='$email2' "; //se o cliente alterar o email dele, checa para ver se ja não existe. Passa por aqui toda vez. 
                   $resultado2= pg_query($conecta, $sql2);
                    $qtde2=pg_num_rows($resultado2); 
    if($qtde2>0)
    {
                 echo "<script type='text/javascript'>alert('Email indisponível para uso, por favor, utilize outro email')</script>";
                 echo "<meta HTTP-EQUIV='refresh' CONTENT='0;'>"; //colocar o caminho 
    }
if($senha=="")//se ele nao alterar a senha cai aqui.

    {
         $sql3 = "update cliente set nome = '$nome', data_nasc= '$data_nasc', telefone= '$celular',   endereco= '$endereco', cpf='$cpf', cidade='$cidade', email='$email' where id_cliente = $id_cliente";
        $resultado3 = pg_query($conecta, $sql3);
        $linhas3 = pg_affected_rows($resultado3);
        if($linhas3>0)
        {
            
           
                 echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
                 echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=seusdados.php'>";
    
        }
       
    }
else
{
    if($nova_senha!=$confirma_senha)
    {
        echo "<script type='text/javascript'>alert('As senhas são diferentes, por favor redigite!')</script>";
       // echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=seusdados2.php'>"; vai para alteração de dados de novo
    }
    else
    {
        $senha = md5($nova_senha);
        $sql4 = "update cliente set senha='$senha', nome = '$nome', data_nasc= '$data_nasc', telefone= '$celular',   endereco= '$endereco', cpf='$cpf', cidade='$cidade', where id_cliente = $id_cliente";
            $resultado4 = pg_query($conecta, $sql4);
            $linhas4 = pg_affected_rows($resultado4);
            if($linhas4>0)
            {
                echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=seusdados2.php'>"; //mostra dados alterados 
            
            } 
                
            else
                {
                    echo "<script type='text/javascript'>alert('deu ruim2')</script>";
                }
    }
}
       
?>