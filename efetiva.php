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
<h1>Finalização do pedido de compra.</h1>
<h5>Validando se dados vieram de finaliza.php ...</h5>

<?php
$paginaAnterior = explode("/",$_SERVER['HTTP_REFERER']);
//Receber dados do cliente

//Se vieram do formulário finaliza compras
if( isset($_POST) && end($paginaAnterior) == "finaliza.php" ){
  
  echo "<h5>Conferido!</h5>";
  
  echo "<h5>Verificando se cliente existe ...</h5>";
  
  //Busca cliente existente
  $dados = $objeto->getCliente($_POST["txtCPF"]);
  
  //Caso não exista, cadastre
  if($dados == false){
    
    echo "<h5>Não existe ...</h5>";
    
    echo "<h5>Preparando novo cadastro de cliente com dados informados.</h5>";
    
    //Recebendo dados do cliente via form
    $VDadosCliente = array(
                      "nome" => $_POST["txtNomeCompleto"],
                      "email" => $_POST["txtEmail"],
                      "CPF" => $_POST["txtCPF"],
                      "endereco" => $_POST["txtEndereco"],
                      "ccredito" => $_POST["numCartaoCredito"]
                    );  
    
    $id_cliente = $objeto->postCliente($VDadosCliente);
    
    if($id_cliente != false){
      
      echo "<h5>Cliente cadastrado.</h5>";
      
    }
    
  }else{
    
    echo "<h5>Cliente já cadastrado.</h5>";

  }
  
  //Com o id do cliente, cadastra pedido
  if( isset($id_cliente) || isset($dados[0]["id_cliente"]) ){
    
    $id = isset($id_cliente) ? $id_cliente : $dados[0]["id_cliente"] ;
    
    echo "<h5>Cadastrando pedido ...</h5>";
    
    $idPedido = $objeto->postPedido($id,$_SESSION["TotalPedido"]);
    
    if ($idPedido != false){
      
      echo "<h5>Pedido cadastrado!</h5>";
      
      echo "<h5>Cadastrando Lista de produtos e finalizando compra.</h5>";
      
      try {
        
        //Monta a lista que será exibida na finalização do pedido
        $strMontaListaExibicao = "<table class='w3-table-all'>
                                <tr><th>Produto</th><th>Quantidade</th><th>Preço</th></tr>";
        
        $decTotalProduto = 0;
      
        foreach($_SESSION["CarrinhoCompras"] AS $id => $valor ){
          
          //Busca dados dos produtos e cateorias
          $dadosProduto = $objeto->getProduto($id);

          $idLista["$id"] = $objeto->postListaPedido($id,$dadosProduto[0]["preco"],$valor["quantidade"],$idPedido);
          
          if ($idLista["$id"] != false){
            
            $strMontaListaExibicao = $strMontaListaExibicao . "<tr><td>".$dadosProduto[0]["nome"]."</td><td> R$ ".$dadosProduto[0]["preco"]."</td><td>".$valor["quantidade"]."</td></tr>";
            
            //Acumula total da compra
            $decTotalProduto = $decTotalProduto + ($valor["quantidade"] * $dadosProduto[0]["preco"]);
            
          }else{
            echo "<tr><td colspan='3'>Ops...</td></tr>";
          }

        }
        
        $strMontaListaExibicao = $strMontaListaExibicao."<tr><td colspan='3' style='text-align: center;'><b>Total R$ ".$decTotalProduto."</b></td></tr>";
        
        $strMontaListaExibicao = $strMontaListaExibicao."</table>";
        
        if(count($_SESSION["CarrinhoCompras"]) == count($idLista)){
          
          echo "<h2>Compra finalizada!</h2>";
          
          echo "<div>Prezado <b>".$_POST["txtNomeCompleto"]."</b>, seu pedido número <b>".$idPedido."</b> será entregue em 3 dias juntamente com a nota fiscal.</div>";
          
          echo "<div class='w3-container w3-padding w3-card'>
          
              ".$strMontaListaExibicao."
                
              </div>";
          
              session_destroy();
          
        }
        
      } catch(PDOException $e) {
        return false;
        echo 'ERROR: ' . $e->getMessage();
      }
      
    }else{
      
      echo "<h3>Pedido não foi cadastrado.</h3>";
      
    }

  }

}
?>

<?php
include($_SESSION["CaminhoInterno"].'reutiliza/rodape.php');
?>