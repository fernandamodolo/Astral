<!-- Autora: Fernanda Castor Modolo
     09/10/2020
     
    Mostra dados usuario p/ alteração ADM-->
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="complemento.css">
        <link rel="stylesheet" type="text/css" href="style_alt.css">
         <link rel="icon" type="imagem/png" href="imagens/logoa.png">
    <title>Alteração Administrador</title>
</head>
<body>
   <center>
    <div id="mae">
        <font face="Arial" size="4" color="black">
           
           
            <a name="topo"></a>
            <?php
             include "barra_fixa.php";
            ?>
           
            <h1> ALTERAÇÃO DE DADOS</h1>
           <?php     
             
           include "conexao.php";
                $id_cliente = $_GET["id_cliente"];
             $sql="SELECT * FROM cliente WHERE id_cliente = '$id_cliente';";
         $resultado=pg_query($conecta,$sql);
         $qtde=pg_num_rows($resultado);
         if ( $qtde == 0 )
         {        
             echo "<script type='text/javascript' language='javascript'> alert('Usuario NÃ£o encontrado!'); </script>";
               echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=mostra_adm.php'>";
        exit;
             
         }
         if($qtde > 0)
         {
            
             $linha = pg_fetch_array($resultado);

         }
  
             if($linha[9]=="F")
             {
                 $sexo="Feminino";
             }
            else if($linha[9]=="M")
            {
               $sexo="Masculino";
            }
            else
            {
                $sexo="Outro";
            }
            
         
//     echo "<form action='altera_dados.php?' class='cad_pessoa' method='POST'>";
     ?>
        <form action='grava_altera_adm.php?' name="alt" class='cad_pessoa' method='POST' >
           <label align="left">Nome:<input type='text' class='insere' name='nome' value='<?php echo $linha[1];?>'  autocomplete='off'></label>
           
           <label align="left">Sexo:<input type='text' class='insere' name='name' value='<?php echo $sexo;?>'  autocomplete='off' readonly="readonly"></label>
           
            <label align="left">Data de Nascimento<input type='date' class='insere' name='dt_nas' value='<?php echo $linha[2];?>' autocomplete='off'></label>
            <label align="left">Telefone<input type='text' class='insere' name='tel'id="tel" value='<?php echo $linha[3];?>'  autocomplete='off' onkeypress="mascara5(this, '## #####-####')"  pattern="[0-9]{2} [0-9]{5,5}-[0-9]{5,4}" onblur="return Onlynumbers(event)" maxlength="15"  ></label>
          
                      
            <label align="left">Email<input type='email' class='insere' name='email' value='<?php echo $linha[4];?>' readonly="readonly"> </label>
           
            <label align="left"> Nova Senha <input  oninput="forca_senha()" id="senha_alt" type="password" class='insere forca' class='forca' name="senha" id="senha" value = '' autocomplete='off' minlength = "8" maxlength="14" size="14"></label>
            <label  id="forcfrac" class="forca forcsen">Fraca</label>
                    <label  id="forcfrac" class="forca forcsen">Fraca</label>
                    <label id="forcmed" class="forca forcsen">Média</label>
                    <label id="forcfort" class="forca forcsen">Forte</label> 
                   
            <label align="left">Confirma Senha<input type="password"   class='insere' name="senha2" id="senha2" value='' autocomplete='off'></label>
             <input type="submit" class="btn border2 border222" id="enviar" value="Alterar">
          </form>
          
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
        var p = document.getElementById('senha_alt').value ;
        var letrasMaiusculas = /[A-Z]/;
        var letrasMinusculas = /[a-z]/; 
        var numeros = /[0-9]/;
//         var caracteresEspeciais = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
        const id_forca = document.getElementById('senha_alt');
        
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
            id_forca.classList.add('fraca');
        }
        if(forca == 2)
        {
            id_forca.classList.add('media');
        }
        if(forca == 3)
        {
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
           
             <form action="mostra_adm.php" method="post">
                <input type="submit" class="btn_menu border2 border222" value="Voltar"> 
            </form>
            <?php
             include "roda_pe.html";
            ?>
           
        </font>
    </div> <!-- mae -->
   </center>
</body>
</html>