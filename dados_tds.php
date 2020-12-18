<?php
    include "../back/conexao.php";

    //Padrão String Produtos--------------------------------------------------------------------------------
    $sql = "SELECT produto FROM produto";
    $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);
    $sprod=array();
    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=pg_fetch_array($resultado);
            $produto = $linha['produto'];
            $sprod[$cont] = $produto;
        }
    }

    $ind_prod = count($sprod); 
    //------------------------------------------------------------------------------------------------------

    //Gráfico 1---------------------------------------------------------------------------------------------
    $sql1 = "SELECT compra.id_user, compra.id_compra, itens.id_produto, itens.quantidade, produto.produto, usuario.data_nascimento
    FROM compra JOIN itens ON itens.id_compra=compra.id_compra
    INNER JOIN produto ON itens.id_produto=produto.id_produto
    INNER JOIN usuario ON compra.id_user=usuario.id_user";

    $resultado1 = pg_query($conecta, $sql1);
    $qtde1 = pg_num_rows($resultado1);
    $tes1 = array();
    $sidades1 = array();
    $idade1 = 0;

    if($qtde1 > 0)
    {
        for($cont1=0; $cont1 < $qtde1; $cont1++)
        {
            $linha1=pg_fetch_array($resultado1);
            $data=$linha1['data_nascimento'];
            $tes1 = explode("-", $data);
            $idade1 = 2020 - $tes1[0];
            
        }

    }
    //-------------------------------------------------------------------------------------------------------

    //Gráfico 2---------------------------------------------------------------------------------------------
    $sql2 = "SELECT compra.data_compra, compra.id_compra, itens.quantidade
    FROM compra JOIN itens ON itens.id_compra=compra.id_compra";
    $resultado2 = pg_query($conecta, $sql2);
    $qtde2 = pg_num_rows($resultado2);
    $ftotal2 = 0;
    $fquantidades2 = array();
    $spor2 = array();
    $dt_ant2 = '';
    $ind2 = -1;
    $por2 = 0;

    if($qtde2 > 0)
    {
        for($cont2=0; $cont2 < $qtde2; $cont2++)
        {
            $linha2=pg_fetch_array($resultado2);
            $quant2=$linha2['quantidade'];
            $data2=$linha2['data_compra'];
            
            if(strcmp($dt_ant2, $data2) == 0){
                $fquantidades2[$ind2] += $quant2;
            }else{
                $ind2++;
                $fquantidades2[$ind2] = $quant2;
            }

            $ftotal2 += $quant2;
            $dt_ant2 = $data2;
        }
    }

    $ind2 = count($fquantidades2);

    for($x2=0; $x2 < $ind2; $x2++){
        $por2 = ($fquantidades2[$x2] * 100)/$ftotal2;
        $spor2[$x2] = $por2 . '%';
    }
    //------------------------------------------------------------------------------------------------------

    //Gráfico 3----------------------------------------------------------------------------------------------
    $sql3 = "SELECT itens.id_produto, itens.quantidade, produto.produto
    FROM itens JOIN produto ON itens.id_produto=produto.id_produto
    ORDER BY itens.id_produto";
    $resultado3 = pg_query($conecta, $sql3);
    $qtde3 = pg_num_rows($resultado3);
    $squant3=array();
    $spocentagem3=array();
    $qtotal3=0;

    if($qtde3 > 0)
    {
        for($cont3=0; $cont3 < $qtde3; $cont3++)
        {
            $linha3=pg_fetch_array($resultado3);
            $id_produto3 = $linha3['id_produto'];
            $quantidade3 = $linha3['quantidade'];
            $squant3[$id_produto3] = $quantidade3;
            $qtotal3 += $quantidade3; 
        }
    }
    
    for($x3=0; $x3 < $ind_prod; $x3++){
        if(empty($squant3[$x3])){
            $squant3[$x3] = 0;
            $spocentagem3[$x3] = '0%';
        }
        else{
            $por3 = ($squant3[$x3] * 100)/$qtotal3;
            $spocentagem3[$x3] = $por3 . '%';
        }
    }
    ksort($squant3); 
    ksort($sporcentagem3);    

    //-------------------------------------------------------------------------------------------------------

    //Gráfico 4----------------------------------------------------------------------------------------------
    $sql4 = "SELECT compra.id_user, compra.id_compra, itens.id_produto, itens.quantidade, produto.produto, usuario.sexo
    FROM compra JOIN itens ON itens.id_compra=compra.id_compra
    INNER JOIN produto ON itens.id_produto=produto.id_produto
    INNER JOIN usuario ON compra.id_user=usuario.id_user";
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
            $sexo4 = $linha4['produto'];
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

    //Gráfico 5-------------------------------------------------------------------------------------------------
    $sql5 = "SELECT compra.id_user, compra.data_compra, itens.id_produto, itens.quantidade, produto.preco
    FROM compra JOIN itens ON itens.id_compra=compra.id_compra
    INNER JOIN produto ON itens.id_produto=produto.id_produto
    ORDER BY compra.data_compra";

    $resultado5 = pg_query($conecta, $sql5);
    $qtde5 = pg_num_rows($resultado5);
    
    $ftotal5 = 0;
    $fvalores5 = array();
    $dt_ant5 = '';
    $ind5 = -1;

    if($qtde5 > 0)
    {
        for($cont5=0; $cont5 < $qtde5; $cont5++)
        {
            $linha5=pg_fetch_array($resultado5);
            $preco5=($linha5['preco']*$linha5['quantidade']);
            $data5=$linha5['data_compra'];
            
            if(strcmp($dt_ant5, $data5) == 0){
                $fvalores5[$ind5] += $preco5;
            }else{
                $ind5++;
                $fvalores5[$ind5] = $preco5;
            }

            $ftotal5 += $preco5;
            $dt_ant5 = $data5;
        }
    }
    //-----------------------------------------------------------------------------------------------------------

    print_r($sprod);
?>

