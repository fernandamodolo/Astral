<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
BD: TesteBD1
Tabela: produto

Adicionado por Prof. Vitor Simeão (out/2019)
*/

      session_start();
       
      if(!isset($_SESSION['carrinho'])){
         $_SESSION['carrinho'] = array();
      }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Compra Finalizada</title>
</head>
 
<body>
	<table>
		<caption>Carrinho de Compras</caption>
		<thead>
			<tr>
				<th width="100">Código</th>
				<th width="244">Descrição</th>
				<th width="79">Quantidade</th>
				<th width="89">Pre&ccedil;o</th>
				<th width="100">SubTotal</th>
			</tr>
		</thead>
		<form action="?acao=voltar" method="post">
		<tfoot>
			<tr>
			<td colspan="5"><a href="index.php">Voltar</a></td>
		</tfoot>
		  
		<tbody>
		   <?php
			if(count($_SESSION['carrinho']) == 0)
			{
				echo '<tr><td colspan="5">N&atilde;o h&aacute; produto no carrinho</td></tr>';
			}
			else
			{
				require("conexao.php");
				$total = 0;
				
				// Gravar Venda
				$sql = "INSERT INTO venda VALUES (DEFAULT,NOW(),'f');";
				$res = pg_query($conecta, $sql);
				//$regs = pg_affected_rows($res);
				//if ($res <= 0){
					foreach($_SESSION['carrinho'] as $codproduto => $qtd)
					{ // Início do FOREACH
					$sql = "SELECT * FROM produto WHERE codproduto=$codproduto AND	excluido IS FALSE ORDER BY descricao";
					$res = pg_query($conecta, $sql);
						$linha = pg_fetch_array($res);
						$preco = $linha['preco'];
						$sql = "INSERT INTO itemvenda VALUES (CURRVAL('venda_codvenda_seq'),".$codproduto.",".$qtd.",".$preco.",'f');";
						$res = pg_query($conecta, $sql);
					
				}// Término do FOREACH
			
				echo '<tr><td colspan="3">Compra Finalizada</td></tr>';
				// Encerra SESSION
				unset ($_SESSION['carrinho']);
				
			 }//FECHA ELSE
		   ?>
		
		 </tbody>
			</form>
	</table>
 
</body>
</html>