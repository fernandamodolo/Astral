<?php
session_start();
session_unset();
session_destroy();
echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
echo "<script type='text/javascript'>alert('Logoff feito com sucesso!!!')</script>";
//echo "deu certo";
?>