<?php
include"conexao.php";
//Padrão String Produtos--------------------------------------------------------------------------------
    $sql = "SELECT descricao FROM produtos";
    $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);
    $sprod=array();
    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=pg_fetch_array($resultado);
            $produto = $linha['descricao'];
            $sprod[$cont] = $produto;
        }
    }

    $ind_prod = count($sprod); 
    //------------------------------------------------------------------------------------------------------

 //Gráfico 4----------------------------------------------------------------------------------------------
    $sql4 = "SELECT compra.id_cliente, compra.id_compra, itens_compra.id_produto, itens_compra.quantidade, produtos.descricao, cliente.sexo
    FROM compra JOIN itens_compra ON itens_compra.id_compra=compra.id_compra
    INNER JOIN produtos ON itens_compra.id_produto=produtos.id_produto
    INNER JOIN cliente ON compra.id_cliente=cliente.id_cliente";
    $resultado4 = pg_query($conecta, $sql4);
    $qtde4 = pg_num_rows($resultado4);
    $sf4 = array();
    $sm4 = array();

    if($qtde4 > 0)
    {
        for($cont4=0; $cont4 < $qtde4; $cont4++)
        {
            $linha4=pg_fetch_array($resultado4);
            $id_produto4 = $linha4['id_produto'];
            $sexo4 = $linha4['sexo'];
            $quantidade4 = $linha4['quantidade'];

            if($sexo4 = 'F'){
                if(empty($sf4[$id_produto4])){
                    $sf4[$id_produto4] = $quantidade4;
                }
                else{
                    $sf4[$id_produto4] += $quantidade4;
                }
            }else{
                if(empty($sm4[$id_produto4])){
                    $sm4[$id_produto4] = $quantidade4;
                }
                else{
                    $sm4[$id_produto4] += $quantidade4;
                }
            }
        }
    }

    for($x4=0; $x4 < $ind_prod; $x4++){
        if(empty($sf4[$x4])){
            $sf4[$x4] = 0;
        }
        if(empty($sm4[$x4])){
            $sm4[$x4] = 0;
        }
    }
    ksort($sm4);
    ksort($sf4);
    //--------------------------------------------------------------------------------------------------------
?>