<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style_cad.css">
    <link rel="stylesheet" type="text/css" href="complemento_cad.css">
    <title>Cadastrar</title>
</head>
<body>
    <center>
        <div id="mae">
            <font face="Arial" size="4" color="black">
            <!--  Recebe as informações  -->
                <?php
                    include "barra_fixa.html";
                    if(isset($_SESSION['adm']))
                    {
                        $adm = $_SESSION['adm'];
                    }else
                    {
                        $adm = 'n';
            //            echo "Não recebeu o valor da session!".$adm;
                    }
                    if($_POST['email2'] != NULL)
                    {
                        $local = $_SERVER['PHP_SELF'];
                        include "conexao.php";
                        $nome = $_POST['nome'];
                        $data = $_POST['nasc'];
                        $tel = $_POST['tel'];
                        $cidade = $_POST['cidade'];
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];
                        $senha = md5($senha);
                        $exclusao = 'n';
                        $data_exclusao = NULL;
                        $sql = "INSERT INTO cliente VALUES( nextval('id_cliente'), '$nome', '$data', '$tel', '$email', '$senha', '$exclusao', NULL, '$adm');";
                        $resultado=pg_query($conecta,$sql);
                        $linhas=pg_affected_rows($resultado);
                        
//                        exit();
                        if($linhas > 0)
                        {
                            pg_close($conecta);
                            include "conexao.php";
                            session_unset();
                            $sql2="SELECT * FROM cliente WHERE email = '$email';";
                            $resultado2=pg_query($conecta,$sql2);
                            $qtde2=pg_num_rows($resultado2);
                            $linhas2 = pg_fetch_all($resultado2);
                            foreach($linhas2 as $linha2)
                            {
                                $_SESSION['login'] = $linha2['email'];
                                $_SESSION['id_cliente'] = $linha2['id_cliente'];
                            }
                            $_SESSION['logou'] = 's';
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=usuario.php'>";
                        }
                        else
                        {
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastro.php'>";
                        }
                        
                        pg_close($conecta);
                    }

                ?>
                
                <h1>CADASTRO</h1>

                <form class="cadastro" id="cadastro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return verifica_form('email')">
                    <label align="left" for="nome">Digite seu nome: *</label>
                    <input class="insere" type="text" name="nome" id="nome" value = "<?php echo $_POST['nome'] ?>" required>
                    <br>
                    <br>
                    <label align="left" for = "email">Digite seu email: *</label>
                    <input placeholder="exemplo@email.com" class="insere" type="email" name="email" id="email" value = "<?php echo $_POST['email']; ?>" required>
                    <br>
                    <br>
                    <label align="left" for="email2">Confirme seu email:</label>
                    <input class="insere" type="email" name="email2" id="email2" value = "<?php echo $_POST['email2']; ?>" required>
                    <br>
                    <br>
                    <label align="left" for="senha">Digite sua senha:<br><div class="obrigatorio"> A senha deve ter de 8 a 14 caracteres! </div></label>
                    <input class="insere forca" class="forca" oninput="forca_senha()" type="password" name="senha" id="senha" value = "<?php echo $_POST['senha']; ?>" minlength = "8" maxlength="14" size="14" required>
                    <label  id="forcfrac" class="forca forcsen">Fraca</label>
                    <label id="forcmed" class="forca forcsen">Média</label>
                    <label id="forcfort" class="forca forcsen">Forte</label> 
                    <br>
                    <!--<img src="imagens/forca_senha.jpeg" width="90px" height="18px">-->
                    <label align="left" for="senha2">Confirme a senha:</label>
                    <input class="insere forca" type="password" name="senha2" id="senha2" value = "<?php echo $_POST['senha2']; ?>" minlength = "8" maxlength="14" size="14" required>
                    <br>
                    <br>
                    <label align="left" for="nasc">Sua data de nascimento:</label>
                    <input class="insere" type="date" name="nasc" id="nasc" value = "<?php echo $_POST['nasc']; ?>" required>
                    <br>
                    <br>
                    <label align="left" for="tel">Digite seu telefone: </label>
                    <input class="insere" type="text" name="tel" id="tel" placeholder="EX.: (xx) xxxxx-xxxx" value = "<?php echo $_POST['tel']; ?>" minlength = "11" maxlength="15">
                    
                    <br>
                    <br>
                    <center>
                        <input align="center" type="submit" class="btn border2 border222" id="enviar">
                    </center>
                </form>
                <?php
                    include "roda_pe.html";
                ?>
            </font>
        </div>
    </center>
</body>
</html>


<script type="text/javascript" language="javascript">
    function verifica_form(email)
    {
        if(document.getElementById('email').value !== document.getElementById('email2').value)
        {
            alert('Por favor, confirme seu email novamente');
            document.getElementById('email2').focus();
            return false;
        }
        
        if(document.getElementById('senha').value !== document.getElementById('senha2').value)
        {
            alert('Por favor, confirme sua senha novamente');
            document.getElementById('senha2').focus();
            return false;
        }
        
    }
    
    
    function forca_senha()
    {
        var p = document.getElementById('senha').value ;
        var letrasMaiusculas = /[A-Z]/;
        var letrasMinusculas = /[a-z]/; 
        var numeros = /[0-9]/;
//         var caracteresEspeciais = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
        const id_forca = document.getElementById('senha');
        const recebe_lblfrac = document.getElementById('forcfrac'); 
        const recebe_lblmed = document.getElementById('forcmed');
        const recebe_lblfort = document.getElementById('forcfort');
        var auxMaiuscula = 0;
        var auxMinuscula = 0;
        var auxNumero = 0;
//         var auxEspecial = 0;
        var forca = 0;
        for(var i=0; i<p.length; i++){
        if(letrasMaiusculas.test(p[i]))
            auxMaiuscula++;
        else if(letrasMinusculas.test(p[i]))
            auxMinuscula++;
        else if(numeros.test(p[i]))
            auxNumero++;
        else if(caracteresEspeciais.test(p[i]))
            auxEspecial++;
        }
       
        id_forca.classList.remove('fraca');
        id_forca.classList.remove('media');
        id_forca.classList.remove('forte');
        recebe_lblfrac.classList.remove('fraca');
        recebe_lblfrac.classList.remove('media');
        recebe_lblfrac.classList.remove('forte');
        
        recebe_lblmed.classList.remove('fraca');
        recebe_lblmed.classList.remove('media');
        recebe_lblmed.classList.remove('forte');
        
        recebe_lblfort.classList.remove('fraca');
        recebe_lblfort.classList.remove('media');
        recebe_lblfort.classList.remove('forte');
        if (auxNumero > 0)
        {
            forca++;
            
        }
        if (auxMinuscula > 0)
        {
            forca++;
        }
        if (auxMaiuscula > 0)
        {
            forca++;
        }
        
        if(forca == 1)
        {
            recebe_lblfrac.classList.add('fraca');
            id_forca.classList.remove('media');
            id_forca.classList.remove('forte');
            id_forca.classList.add('fraca');
        }
        if(forca == 2)
        {
            recebe_lblmed.classList.add('media');
            id_forca.classList.remove('fraca');
            id_forca.classList.remove('forte');
            id_forca.classList.add('media');
        }
        if(forca == 3)
        {
            recebe_lblfort.classList.add('forte');
            id_forca.classList.remove('fraca');
            id_forca.classList.remove('media');
            id_forca.classList.add('forte');
        }

    }
        
</script>