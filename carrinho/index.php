<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
BD: carrinho
Tabela: produto
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Carrinho de Compras</title>
</head>
 
<body>
<?php
	require "conexao.php";

	$sql = "SELECT * FROM produto WHERE excluido IS FALSE ORDER BY descricao";
	$res = pg_query($conecta, $sql);
	$qtde=pg_num_rows($res);
	if($qtde>0)
		while($linha = pg_fetch_array($res)){
			echo "<h2>".$linha['descricao']."</h2> <br />";
			$preco= number_format($linha['preco'], 2, ',', '.');
			echo "Pre&ccedil;o : R$ ".$preco."<br />";
			echo "<img src='image/".$linha['imagem']."' /> <br />";
			echo "<a href='carrinho.php?acao=add&codproduto=".$linha['codproduto']."'>Comprar</a>";
			echo "<br /><hr />";
	}
	else
		echo "<br />N&atilde;o h&aacute; produtos dispon&iacute;veis!<br />";
	  
	 
?>
 
</body>
 
</html>