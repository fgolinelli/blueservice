<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);

error_reporting(E_ALL);

//Definir Time Zone
date_default_timezone_set('America/Sao_Paulo');

//Guardar o início do carregamento da página para estatísticas no rodapé
$dthInicioPagina = new DateTime;

?>

<?php require_once( $_SESSION["CaminhoInterno"].'reutiliza/funcoes.php' )?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <script type="text/javascript" src="reutiliza/js/funcoes.js"></script>
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

  <div class="w3-container w3-card w3-blue">
    
    <div class="w3-col w3-left w3-margin-top" style="text-align:right;width:250px;height:100px;">
      <img class="w3-card" src="https://imagensemoldes.com.br/wp-content/uploads/2020/07/Logo-Carrinho-de-Compras-PNG.png" title="Logo da empresa" style="width:230px;height:90px;">
    </div>
    
<?php  $intQuantidadeCarrinho = isset($_SESSION["QuantidadeTotal"]) ? $_SESSION["QuantidadeTotal"] : 0 ;?>

    <div class="w3-rest w3-right w3-hide-small w3-text-sand" style="text-align:right;">
      <h3><?=$_SESSION["Sistema"]?></h3>
      <p class="w3-tiny"><?=isset($_SESSION['NomeCliente']) ? $_SESSION['NomeCliente'] : "" ;?><br>
        <a href="meucarrinho.php">
          <?php  echo $intQuantidadeCarrinho > 0 ? $intQuantidadeCarrinho  : "" ;?>
          <i class="material-icons" style="font-size:18px;">shopping_cart</i>
        </a>
      </p>
    </div>

    <div class="w3-rest w3-right w3-hide-medium w3-hide-large w3-text-sand" style="text-align:right;">
      <h4><?=$_SESSION["Sistema"]?></h4>
      <p class="w3-tiny">Área de <?=$_SESSION['NomeCliente']?> <?php  echo $intQuantidadeCarrinho > 0 ? $intQuantidadeCarrinho  : "" ;?><br>
    </div>
  </div>
  
  <div class="w3-grey">
    Menu <a href="home.php">Home</a> | <a href="meucarrinho.php">Meu carrinho</a>
  </div>
  
  <!-- DIV fecha no rodape -->
  <div class="w3-container w3-padding">
