<?php
session_start();

//Carrega o cabecalho padrão
include($_SESSION["CaminhoInterno"].'reutiliza/cabecalho.php');
?>

<?php
//Carrega classe Conexão
include($_SESSION["CaminhoInterno"].'reutiliza/class/Conexao.class.php');
$objeto = new Conexao;

if( isset($_POST["txtCPF"]) ){

  //Busca os pedidos do cpf
  $dados = $objeto->getTodosPedidosXCPF($_POST["txtCPF"]);
  
  if($dados != false){
    
    echo "<table class='w3-table-all w3-card'>
    <tr class='w3-indigo'><th colspan='10'>".$dados[0]["nome"]." | CPF: ".$dados[0]["cpf"]."</th></tr>";
  
    $bolControlaMudancaPedido = 0;
    
    for ($i=0;$i<count($dados);$i++){
      
      if($bolControlaMudancaPedido != $dados[$i]["id_pedido"]){
        
        echo "<tr><th colspan='10'></th></tr>
        <tr><th colspan='10'>Pedido #".$dados[$i]["id_pedido"] ." | Pago R$ <b>". $dados[$i]["preco_total"] ."</b> em " .date("d/m/Y H:i",strtotime($dados[$i]["dth_pgth"])). "</th></tr>
        <tr class='w3-light-blue'><td>Id</td><td>Produto</td><td>quantdade</td><td>preço UN</td></tr>";
                                                                                                        
        $bolControlaMudancaPedido = $dados[$i]["id_pedido"];
        
      }
      
      echo "<tr><td>".$dados[$i]["id_produto"]."</td><td>".$dados[$i]["nome_produto"] ."</td><td>". $dados[$i]["quantidade"] ."</td><td>". $dados[$i]["preco_unitario"] ."</td></tr>";
      
    }
    
    echo "</table>";
    
  }else{
    echo "<h2>Nenhum pedido para o CPF ".$_POST["txtCPF"]."</h2>";
  }
}
?>



<?php
include($_SESSION["CaminhoInterno"].'reutiliza/rodape.php');
?>