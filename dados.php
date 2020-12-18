<?php
include "../../back/conexao.php";

$sql4 = "SELECT usuario.sexo, compra.id_compra
        FROM compra JOIN usuario ON compra.id_user=usuario.id_user";
    $resultado4 = pg_query($conecta, $sql4);
    $qtde4 = pg_num_rows($resultado4);
    $sf4 = 0;
    $sm4 = 0;
    $total = 0;

    if($qtde4 > 0)
    {
        for($cont4=0; $cont4 < $qtde4; $cont4++)
        {
            $linha4=pg_fetch_array($resultado4);
            $sexo4 = $linha4['sexo'];

            if($sexo4 == 'F'){
                $sf4++;
            }else{
                $sm4++;
            }

            $total ++;
        }
    }

    //--------------------------------------------------------------------------------------------------------
?>