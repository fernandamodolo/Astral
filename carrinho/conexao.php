<?php
	//Conecta com o PostgreSQL
    //
    // É preciso alterar o nome do banco, usuário e senha
    //
	$conecta = pg_connect("host=localhost port=5432 dbname=???????? 
							user=???????? password=????????"); 
	if (!$conecta)
	{
		echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
		exit;
	}
?>
