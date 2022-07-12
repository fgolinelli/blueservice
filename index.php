<?php
include('config.php');

//Solicita o nome do usuário caso não tenha pedido
if(isset($_POST["txtNomeCliente"]) && strlen($_POST["txtNomeCliente"]) > 1 ){
  
  $_SESSION["NomeCliente"] = $_POST["txtNomeCliente"];
  header('Location: home.php');
  
}else{
  
?>
  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <title><?=$_SESSION["Sistema"]?> <?=$_SESSION["Empresa"]?></title>
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=$_SESSION["CaminhoExterno"]?>reutiliza/images/img.png" >
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2021.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-vivid.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body class="w3-text-grey w3-light-grey">
    
    <div class="w3-container w3-margin-top w3-padding w3-card-4 w3-center w3-blue" style="width:50%;margin:auto;">
      
      <h1>
        Você está pronto para entrar na Loja Blue?
      </h1>

      <form class="w3-container w3-padding w3-center" action="#" method="post" enctype="application/x-www-form-urlencoded" name="formEntrar">
        <label>Qual seu nome? </label>
        <input class="w3-input" type="text" name="txtNomeCliente" id="txtNomeCliente">
        <input class="w3-button w3-margin-top w3-blue-gray w3-hover-black w3-round" type="submit" name="sbmEnviar" value="Entrar">
      </form>
      
    </div>
    
    <div class="w3-container w3-margin-top w3-padding w3-card-4 w3-center w3-blue" style="width:50%;margin:auto;">
      
      <h1>
        Quer ver seu(s) pedido(s)?
      </h1>

      <form class="w3-container w3-padding w3-center" action="verpedido.php" method="post" enctype="application/x-www-form-urlencoded" name="formVerPedido" onSubmit='return validaForm();'>
        <label>Seu CPF</label>
        <input class="w3-input" type="text" name="txtCPF" id="txtCPF" minlenght="11" maxlength="11" style="width:300px;margin-left: auto; margin-right: auto;">
        <input class="w3-button w3-margin-top w3-blue-gray w3-hover-black w3-round" type="submit" name="sbmEnviar" value="Ver">
      </form>
      
    </div>

  <div class="w3-row w3-opacity w3-teal" style="position: fixed; bottom: 0; width:100%; height:40px;">
      <p class="w3-sans-serif w3-small">&nbsp;&nbsp;<?=$_SESSION["Sistema"] ?> :: v. <?=$_SESSION["SistemaVersao"]?> </p>
  </div>

  </body>
  </html>
    
<?php
}
?>

<script type="text/javascript" >
  
  function validaForm(){
    
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





