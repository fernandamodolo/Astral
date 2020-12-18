<!-- Autora: Fernanda Castor Modolo
     29/10/2020
     
   Quantidade e pocentagem de venda de todos os produtos -->
   
  <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
     <link rel="stylesheet" type="text/css" href="estilo_estatistica1.css">
   
    <link rel="icon" type="imagem/png" href="imagens/logoa.png">
    <title>Estatísticas</title>
</head>
<body>

<center>
        <div id="mae">
            <font face="Arial" size="4" color="black">
                <?php
                    include "barra_fixa.php";
                include "barra_lateral.html";
               ?>
                <div id="conteudo_principal">
                <h1>Quantidade e Porcentagem das Vendas </h1>
              <?php
			 
				include "conexao.php";
				
				// SELECIONANDO A QUANTIDADE TOTAL DE ITENS VENDIDOS E A QUANTIDADE POR PRODUTO.
				$sqls = "select * from compra";
				$resultados = pg_query($conecta, $sqls);
				$qtdes = pg_num_rows($resultados);
				
				$qtde_prod == array();
				
				if ($qtdes > 0)
				{
					for ($cont = 0; $cont < $qtdes; $cont++)
					{
						$linhas = pg_fetch_array($resultados);
						$id_compra = $linhas['id_compra'];
						
						$sqlq = "select * from itens_compra where id_compra = $id_compra";
						$resultadoq = pg_query($conecta, $sqlq);
						$qtdeq = pg_num_rows($resultadoq);
						
						if ($qtdeq > 0)
						{
							for ($cont2 = 0; $cont2 < $qtdeq; $cont2++)
							{
								$linhaq = pg_fetch_array($resultadoq);
								$quantidade = $linhaq['quantidade'];
								$id_produto = $linhaq['id_prod'];
								$qtde_prod[$id_produto] += $quantidade;
								$quantidade_total += $quantidade;

							}
						}
			
					}
			
				
					?> <div id="qtde_borda"><div id="qtde_vendida"><?php echo "<br>Quantidade de produtos vendidos: " .$quantidade_total;
					
				}
					$nome_prod = array();
					$sqlp = "select * from produtos";
					$resultadop = pg_query($conecta, $sqlp);
					$qtdep = pg_num_rows($resultadop);
					if ($qtdep > 0)
					{
						for ($i = 0; $i < $qtdep; $i++)
						{
							$linhap = pg_fetch_array($resultadop);
							$id_prod = $linhap['id_prod'];
							$nome = $linhap['descricao'];
							$nome_prod[$id_prod] = $nome;
						}
					}
					
					$sqlc = "select * from produtos order by id_prod";
					$resultadoc = pg_query($conecta, $sqlc);
					$qtdec = pg_num_rows($resultadoc);
					if ($qtdec > 0)
					{
						echo "<br><br>";
						for ($i = 0; $i < $qtdec; $i++)
						{
							$linhac = pg_fetch_array($resultadoc);
							$id_pro = $linhac['id_prod'];
							if ($qtde_prod[$id_pro] != NULL)
							{
								$porc = ($qtde_prod[$id_pro]/$quantidade_total)*100;
                                echo $id_pro. "  ";
								echo $nome_prod[$id_pro];
								echo "   -   ".$qtde_prod[$id_pro]. " ( ";
								printf  ("%.2f", $porc);
								echo " %)";
								echo "<br>";
							}
						}
					} 
             ?>
               </div>
                </div>
                 </div>
               
                 <?php
                include "roda_pe.html";
            ?>
                    
                
               
        </font>
    </div>
   </center>
</body>
</html>