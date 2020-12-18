<!-- Autora: Marcela Soares Evangelista - 27
     out/2020
     
     PEGAR DADOS DO BANCO PARA PÁGINA PDF  -->


<?php
    include("conexao.php");
    session_start();
    $id_compra = $_GET["id_compra"];
    echo $id_compra."<br>";

    // PEGAR DADOS DA TABELA COMPRA ----------------------------------------------------------------------

    $sql = "SELECT * FROM compra WHERE id_compra = $id_compra;";

    $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);

    if ($qtde>0)
    {
        for ($cont=0; $cont<$qtde; $cont++)
        {
            $linha = pg_fetch_array($resultado);
            
            $_SESSION['data'] = $linha[data_compra];
            $_SESSION['endereco'] = $linha[endereco];
            //$data_compra =  date("d/m/Y", strtotime($linha[data_compra]));
            //$endereco    = $linha[endereco];
        }

        // PEGAR DADOS DA TABELA ITENS_COMPRA ------------------------------------------------------------

        $sql = "SELECT * FROM compra WHERE id_compra = $id_compra;";
                
        $resultado = pg_query($conecta, $sql);
        $qtde = pg_num_rows($resultado);

        if ($qtde>0)
        {
            for ($cont=0; $cont<$qtde; $cont++)
            {
                $linha = pg_fetch_array($resultado);

                $id_prod    = $linha[id_prod];
                $quantidade = $linha[quantidade];
                $preco = $linha[preco];

                $subtotal = $preco * $quantidade;                
                $total += $subtotal; 
             }
            echo "<a href='fpdf/cabecalho_rodape.php'>link</a>";
        }
        else
        {
            echo "Erro na ITENS_COMPRA.";
        }
        pg_close($conecta);            
    }
    else
    {
        echo "Erro na COMPRA.";
    }
?>
