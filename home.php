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

//Busca dados dos produtos e cateorias
$dadosCategorias = $objeto->getCategorias();


?>
<!--Recebe categoria para filtrar produtos-->
<?$intCategoriaSelecionada = isset($_POST["slcCategoria"])?$_POST["slcCategoria"]:1;?>

<!--Inicio do form para seleção das categorias -->
<div class="w3-col s12 m2 l1" align="center" style="width:200px;"> 
  <form id="formCategoria" name="formCategoria" action="" method="POST">
    <label>Categorias </label>
    <select class="w3-input" name="slcCategoria" onchange="document.forms['formCategoria'].submit();" >
<?php
      for($i=0;$i<count($dadosCategorias);$i++){
?>
        <option value="<?=$dadosCategorias[$i]["id_categoria"]?>" <?=$intCategoriaSelecionada == $dadosCategorias[$i]["id_categoria"] ? "selected" : "" ;?>><?=$dadosCategorias[$i]["descricao_categoria"]?></option>
<?php
      }
?>
      </select>
  </form>
</div>
<!--Fim do form para seleção das categorias -->

<!--Inicio tabela Produtos com seus dados -->
<table class="w3-table-all" id="TabelaProdutos">
    <tr>
      <th></th>
      <th><input class="w3-input w3-border w3-padding" type="text" title="Faça sua pesquisa!" placeholder="Produto" id="BuscaProduto" onkeyup="myFunction(1,'Produto')"></th>
      <th class="w3-hide-medium w3-hide-small"><input class="w3-input w3-border w3-padding" type="text" title="Faça sua pesquisa!" placeholder="Descrição" id="BuscaDescricaoP" onkeyup="myFunction(2,'DescricaoP')"></th>
      <th><input class="w3-input w3-border w3-padding" type="text" title="Faça sua pesquisa!" placeholder="Preço" id="BuscaPreco" onkeyup="myFunction(3,'Preco')"></th>
    </tr>
<?php
  
//Busca dados dos produtos e cateorias
$dadosProdutos = $objeto->getProdutosXCategorias($intCategoriaSelecionada);

//Monta linhas dos produtos
for($i=0;$i<count($dadosProdutos);$i++){
?>
  <tr class="w3-hover-pale-red">
    <td><img src="<?=$dadosProdutos[$i]["foto"]."hjhjhjhjhj"?>" width="64px" height="64px" title="<?=$dadosProdutos[$i]["nome"]?>"></td>
    <td><?=$dadosProdutos[$i]["nome"]?></td>
    <td class="w3-hide-medium w3-hide-small"><?=$dadosProdutos[$i]["descricao_produto"]?></td>
    <td>
      <form class="w3-form" name="FormCarrinho" action="meucarrinho.php" method="post" enctype="multipart/form-data">
        <div class="w3-col s4 m4 l3">
          R$ <?=$dadosProdutos[$i]["preco"]?><br>
          <input type="hidden" name="hidIdProduto" id="hidIdProduto" value="<?=$dadosProdutos[$i]["id_produto"]?>">
        </div>
        <div class="w3-col s4 m4 l3">
          <input class="w3-input" type="number" name="numQuantidade" id="numQuantidade" value="1" style="width:60px;" min="1" max="<?=$dadosProdutos[$i]["quantidade"]?>">
        </div>
        <div class="w3-col s4 m4 l3">
          <button class="w3-button"><i class="material-icons" style="font-size:18px">add_shopping_cart</i></button>
        </div>


      </form>
    </td>
  </tr>
<?php
}
?>
</div>
<!--Fim tabela Produtos com seus dados -->

<?php
include($_SESSION["CaminhoInterno"].'reutiliza/rodape.php');
?>


<script>
function myFunction(idColuna,descricaoColuna) {
  var input, filter, table, tr, td, i;
  input = document.getElementById("Busca"+descricaoColuna);
  filter = input.value.toUpperCase();
  table = document.getElementById("TabelaProdutos");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[idColuna];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>