<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style_cad.css">
    <link rel="stylesheet" type="text/css" href="complemento_cad.css">
    <link rel="icon" type="imagem/png" href="imagens/logoa.png">

    <title>Cadastro Administrador </title>
</head>
<body>
    <center>
        <div id="mae">
            <font face="Arial" size="4" color="black">
            <!--  Recebe as informações  -->
                <?php
                    include "barra_fixa.html";
                   
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
                        $adm= $_POST['adm'];
                        $exclusao = 'n';
                        $data_exclusao = NULL;
                        $sql = "INSERT INTO cliente VALUES( nextval('id_cliente'), '$nome', '$data', '$tel', '$email', '$senha', '$exclusao', NULL, '$adm');";
                        $resultado=pg_query($conecta,$sql);
                        $linhas=pg_affected_rows($resultado);
                        
//                        exit();
                        if($linhas > 0)
                        {
                            echo "<script type='text/javascript'>alert('Cadastro feito com sucesso!')</script>";
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad_adm.php'>"; //volta pro cad_adm 
            
                        pg_close($conecta);
                    }
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
                    <input class="insere" type="text" name="tel" id="tel" placeholder="EX.: (xx) xxxxx-xxxx" value = "<?php echo $_POST['tel']; ?>" onkeypress="mascara5(this, '## #####-####')"  pattern="[0-9]{2} [0-9]{5,5}-[0-9]{5,4}" onblur="return Onlynumbers(event)" maxlength="15">
                    
                    <br>
                    <br>
                    <label align="left" for="adm"> O Usuário é: </label>
                   
                       <input class="insere" type="radio" name="adm" value="s"checked>&nbsp;Administrador
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <input class="insere" type="radio" name="adm" value="n">&nbsp;Cliente
                    
                    <center>
                        <input align="center" type="submit" class="btn border2 border222" id="enviar">
                    </center>
                </form>
                
                 <form action="" method="post">
                <input type="submit" class="btn_menu border2 border222" value="Voltar"> 
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
    
   function validarCPF( cpf ){
						var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
						
						if(!filtro.test(cpf))
						{
							window.alert("CPF inválido perante a receita federal.Atualize por um válido!");
							return false;
							
								
						}
					   
						cpf = remove(cpf, ".");
						cpf = remove(cpf, "-");
						
						if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
							cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
							cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
							cpf == "88888888888" || cpf == "99999999999")
						{
							window.alert("CPF inválido perante a receita federal.Atualize por um válido!");
							return false;
					   }

						soma = 0;
						for(i = 0; i < 9; i++)
						{
							soma += parseInt(cpf.charAt(i)) * (10 - i);
						}
						
						resto = 11 - (soma % 11);
						if(resto == 10 || resto == 11)
						{
							resto = 0;
						}
						if(resto != parseInt(cpf.charAt(9))){
							window.alert("CPF inválido perante a receita federal.Atualize por um válido!");
							return false;
						}
						
						soma = 0;
						for(i = 0; i < 10; i ++)
						{
							soma += parseInt(cpf.charAt(i)) * (11 - i);
						}
						resto = 11 - (soma % 11);
						if(resto == 10 || resto == 11)
						{
							resto = 0;
						}
						
						if(resto != parseInt(cpf.charAt(10))){
							window.alert("CPF inválido perante a receita federal.Atualize por um válido!");
							return false;
						}
						
						return true;
					 }
					 
					function remove(str, sub) {
						i = str.indexOf(sub);
						r = "";
						if (i == -1) return str;
						{
							r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
						}
						
						return r;
					}

					/**
					   * MASCARA ( mascara(o,f) e execmascara() ) CRIADAS POR ELCIO LUIZ
					   * elcio.com.br
					   */
					 //máscara do cpf  
					function mascara(o,f){
						v_obj=o
						v_fun=f
						setTimeout("execmascara()",1)
					}

					function execmascara(){
						v_obj.value=v_fun(v_obj.value)
					}
	
					function cpf_mask(v){
						v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
						v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
						v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
						v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
						return v
					}
					

					function Onlychars(e)
						{
							var tecla=new Number();
							if(window.event) {
								tecla = e.keyCode;
							}
							else if(e.which) {
								tecla = e.which;
							}
							else {
								return true;
							}
							if((tecla >= "48") && (tecla <= "57")){
								return false;
							}
						}
					//máscara do celualr	
					function mascaratel(o,f){
						v_obj=o
						v_fun=f
						setTimeout("execmascara()",1)
					}
					function execmascara(){
						v_obj.value=v_fun(v_obj.value)
					}
					function mtel(v){
						v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
						v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
						v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
						return v;
					}
					function id( el ){
						return document.getElementById( el );
					}
					window.onload = function(){
						id('tel').onkeyup = function(){
							mascara( this, mtel );
						}
					}
					//máscara do telefone
				
					 function mascara5(t, mask){
					 var i = t.value.length;
					 var saida = mask.substring(1,0);
					 var texto = mask.substring(i)
					 if (texto.substring(0,1) != saida){
						 t.value += texto.substring(0,1);
						 }
						 
						 //pelo amor, por função que aceita apenas numero
					 }
					 function Onlynumbers(e)
					{
						var tecla=new Number();
						if(window.event) {
							tecla = e.keyCode;
						}
						else if(e.which) {
							tecla = e.which;
						}
						else {
							return true;
						}
						if((tecla >= "97") && (tecla <= "122")){
							return false;
						}
					}   
        
   
        
</script>