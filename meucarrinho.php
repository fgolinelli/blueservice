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
//Receber item
$intIdProduto = isset($_POST["hidIdProduto"]) ? $_POST["hidIdProduto"] : null ;
$intQuantidade = isset($_POST["numQuantidade"]) ? $_POST["numQuantidade"] : null ;

if( !is_null($intIdProduto) ){
  
  //Busca dados dos produtos e cateorias
  $dadosProduto = $objeto->getProduto($intIdProduto);

  //Testa se a quantidade selecionada é menor que o estoque
  if( $intQuantidade <= $dadosProduto[0]["quantidade"] ){
    
    //Testa se carrinho de compras já exite e tenta atualizar
    if( isset($_SESSION["CarrinhoCompras"]) ){
      
      //Testa se produto já existe no carrinho
      if( isset($_SESSION["CarrinhoCompras"][$intIdProduto]) ){
         
        //Testa se quantidade no carrinho é menor que estoque
        if( $_SESSION["CarrinhoCompras"][$intIdProduto]["quantidade"] <= $dadosProduto[0]["quantidade"] ){
          
          echo "Atualiza quantidade do produto.<br>";
          
          $_SESSION["CarrinhoCompras"][$intIdProduto]["quantidade"] += $intQuantidade;
          
        }else{
          
           echo "Ops ... quantidade do produto acima do estoque.<br>";
          
        }

      }else{

        $_SESSION["CarrinhoCompras"] += [$intIdProduto => array("quantidade"=>$intQuantidade)];

        echo "Novo produto cadastrado no seu carrinho.<br>";

      }
      
    }else{

      $_SESSION["CarrinhoCompras"] = array($intIdProduto => array("quantidade"=>$intQuantidade) );

      echo "Criado um novo carrinho.<br>";

    }
      
  }else{

    echo "Quantidade acima do estoque.<br>";
    
  }

}
  


//Exibe a lista de compras
if( isset($_SESSION["CarrinhoCompras"]) ){
  
  echo "<pre>";
  //var_dump($_SESSION["CarrinhoCompras"]);
  echo "</pre>";
  
  echo "<h1>Carrinho de compras</h1>";
  
  //Totaliza lista de compras
  $intTotalPreco = 0;                 //Usado na lista de compras
  $decTotalLista = 0;                 //Total lista compras
  $_SESSION["QuantidadeTotal"] = 0;   //Usado para informar itens no carrinho
  
  echo "<table class='w3-table-all'>
        <tr>
          <th>Produto</th>
          <th>Preço Unitário</th>
          <th>Quantidade</th>
          <th>Preço Total</th>
        </tr>
        ";
  
  foreach($_SESSION["CarrinhoCompras"] AS $id => $valor ){
    
    //Busca dados dos produtos e cateorias
    $dadosProduto = $objeto->getProduto($id);
    $decTotalProduto = $valor["quantidade"] * $dadosProduto[0]["preco"];
    $decTotalLista += $decTotalProduto;
    
    echo "<tr><td>".$dadosProduto[0]["nome"]."</td><td>".$dadosProduto[0]["preco"]."</td><td> " . $valor["quantidade"]  . "</td><td><b>R$ ". $decTotalProduto ."</b></td></tr>";
    
    $_SESSION["QuantidadeTotal"] += $valor["quantidade"];
    
  }
  //Guarda total para uso em pedido
  $_SESSION["TotalPedido"] = $decTotalLista;
  
  echo "<tr><td class='w3-center' colspan='4'><h3>Total do carrinho <b>R$ $decTotalLista</b></h3></td></tr>
        <tr><td class='w3-center' colspan='4'>
        <form class='w3-form' name='FormFinaliza' action='finaliza.php' method='post' enctype='multipart/form-data'>
          <input class='w3-button w3-gray w3-hover-black' type='submit' value='Finalizar'>
        </form>
        </td></tr>
        </table>";
  

}else{
  
  echo "<h1>Seu carrinho está vazino.</h1>";
  
}
?>

<?php
include($_SESSION["CaminhoInterno"].'reutiliza/rodape.php');
?>