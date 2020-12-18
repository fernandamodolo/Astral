<!-- Autora: Fernanda Castor Modolo
     09/10/2020
     <?php
    include "conexao.php";
    $id_cliente=$_POST['id_cliente'];


$sql="SELECT * FROM cliente WHERE id_cliente = '$id_cliente';";
        $resultado=pg_query($conecta,$sql);
        $qtde=pg_num_rows($resultado);
        if ( $qtde == 0 )
        {        
            echo "<script type='text/javascript' language='javascript'> alert('Você ainda não possui um cadastro!'); </script>";
               //include "usurio.php"; //caso nÃ£o econtre o usuÃ¡rio, redireciona para cadastrar
            
        }

     if($qtde > 0)
        {
            $nome = $_POST['nome']; 
			$data_nasc = $_POST['dt_nas']; 
			$celular = $_POST['tel'];
          $sql3 = "update cliente set nome = '$nome', data_nasc= '$data_nasc', telefone= '$celular',     where id_cliente = '$id_cliente';";
        $resultado3 = pg_query($conecta, $sql3);
        $linhas3 = pg_affected_rows($resultado3);
        if($linhas3>0)
        {
            
           
                 echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
                 echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=mostra_adm.php'>";
    
        }
     }
?>