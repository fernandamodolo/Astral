<?php

include"conexao.php";
$sql4 = "SELECT cliente.sexo, compra.id_compra
        FROM compra JOIN cliente  ON compra.id_cliente=cliente.id_cliente";
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

            if($sexo4 == 'F')
            {
                $sf4++;
            }
            if(sexo4=='M')
               {
                $sm4++;
              }

            $total ++;
        }
                
        $sql="SELECT from produtos where id_prod=1";
         $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);
         if($qtde > 0)
         {
             echo ("bvfhvfhbv");
         }
        
                
       
    }

    //--------------------------------------------------------------------------------------------------------
?>