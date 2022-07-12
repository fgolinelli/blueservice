<?php
session_start();

//Testa existencia de cliente
if(!isset($_SESSION["NomeCliente"])){
  header('Location: index.php');
}

//Carrega o cabecalho padrão
include($_SESSION["CaminhoInterno"].'reutiliza/cabecalho.php');
?>

<?php
//Carrega classe Conexão
include($_SESSION["CaminhoInterno"].'reutiliza/class/Conexao.class.php');
$objeto = new Conexao;
?>

<?php
//Solicita dados do cliente para efetivar a compra
?>
<h1>Seus dados para efetivar a compra</h1>

<form class='w3-form' name='FormFinaliza' id='FormFinaliza' action='efetiva.php' method='post' enctype='multipart/form-data' onSubmit='return validaForm();'>
  <label>Nome</label>
  <input class="w3-input" type="text" name="txtNomeCompleto" id="txtNomeCompleto" placeholder="Digite o nome completo" title="Nome completo do comprador" maxlength="50">
  <label>E-mail</label>
  <input class="w3-input" type="email" name="txtEmail" id="txtEmail" placeholder="email@example.com" title="E-mail válido do comprador" maxlength="50">
  <label>CPF</label>
  <input class="w3-input" type="text" name="txtCPF" id="txtCPF" placeholder="Apenas números" title="CPF do comprador" minlength="11" maxlength="11">
  <label>Endereço</label>
  <input class="w3-input" type="text" name="txtEndereco" id="txtEndereco" placeholder="Av. 7 de setembro, casa 123, Rio de Janeiro, RJ" title="Endereço completo com bairro, cidade e CEP do comprador" maxlength="255">
  <label>Cartão de crédito</label>
  <input class="w3-input" type="text" name="numCartaoCredito" id="numCartaoCredito" placeholder="Apenas números" title="Número do cartão de crédito do comprador" minlength="16" maxlength="16">
  <input class='w3-button w3-gray w3-hover-black' type='submit' value='Efetivar'>
</form>


<?php
include($_SESSION["CaminhoInterno"].'reutiliza/rodape.php');
?>


<script type="text/javascript" >
  
  function validaForm(){

    //Valida preenchimento do campo E-mail
    if(document.getElementById("txtNomeCompleto").value.length < 10){
      
      alert("Campo Nome vazio ou menor de 10 caracteres.");
      
      document.getElementById("txtNomeCompleto").focus();
      
      return false;
      
    }
    
    //Valida preenchimento do campo E-mail
    if(document.getElementById("txtEmail").value == ""){
      
      alert("Campo E-mail vazio.");
      
      document.getElementById("txtEmail").focus();
      
      return false;
      
    }else{
      
      if(validaEmail(document.getElementById("txtEmail").value) == false){
        
        alert("E-mail com problema.");
        
        return false;
        
      }

    }
    
    //Valida preenchimento do campo CPF
    if(document.getElementById("txtCPF").value.length > 0){

      //Valida calculo,etc. do campo CPF
      if(VerificaCPF(document.getElementById("txtCPF").value) == false){
        
        alert("CPF com problema.");
        
        return false;
        
      }
      
    }else{
      
      alert("Campo CPF vazio.");
      
      document.getElementById("txtCPF").focus();
      
      return false;
      
    }
    
    
  }
  
  function VerificaCPF(strCpf) {

    var soma;
    var resto;
    soma = 0;
    if (strCpf == "00000000000") {
        return false;
    }

    for (i = 1; i <= 9; i++) {
        soma = soma + parseInt(strCpf.substring(i - 1, i)) * (11 - i);
    }

    resto = soma % 11;

    if (resto == 10 || resto == 11 || resto < 2) {
        resto = 0;
    } else {
        resto = 11 - resto;
    }

    if (resto != parseInt(strCpf.substring(9, 10))) {
        return false;
    }

    soma = 0;

    for (i = 1; i <= 10; i++) {
        soma = soma + parseInt(strCpf.substring(i - 1, i)) * (12 - i);
    }
    resto = soma % 11;

    if (resto == 10 || resto == 11 || resto < 2) {
        resto = 0;
    } else {
        resto = 11 - resto;
    }

    if (resto != parseInt(strCpf.substring(10, 11))) {
        return false;
    }

    return true;
    }
  
  function validaEmail(email) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.match(mailformat))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  
</script>