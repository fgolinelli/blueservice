<?php
Class Conexao{
private $host= "localhost";
private $dbname= "u553825348_blueservice";
private $user = "u553825348_blueservice";
private $pass = "BlueService2022";
private $dbh;

  function conectar(){
    
    try {
      
      $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      return $this->dbh;
      
      echo "Sucesso na conexão";
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  function getProdutos(){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $query = $conn->prepare("SELECT t1.*, t2.* FROM TB_Produto AS t1 INNER JOIN TB_Categoria AS t2 ON t2.id_categoria = t1.id_categoria ORDER BY t2.descricao_categoria, t1.nome;");
      $query->execute();
      $dados = $query->fetchAll();
      
      if( count($dados) >0 ){
        
        return $dados;
        
      }else{
        
        return false;
        
      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  
  function getProdutosXCategorias($idCategoria){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $query = $conn->prepare("SELECT t1.*, t2.* FROM TB_Produto AS t1 INNER JOIN TB_Categoria AS t2 ON t2.id_categoria = t1.id_categoria WHERE t2.id_categoria = $idCategoria ORDER BY t2.descricao_categoria, t1.nome;");
      $query->execute();
      $dados = $query->fetchAll();
      
      if( count($dados) > 0 ){
        
        return $dados;
        
      }else{
        
        return false;
        
      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  
  function getCategorias(){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $query = $conn->prepare("SELECT t1.* FROM TB_Categoria AS t1 ORDER BY t1.descricao_categoria;");
      $query->execute();
      $dados = $query->fetchAll();
      
      if( count($dados) >0 ){
        
        return $dados;
        
      }else{
        
        return false;
        
      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  function getProduto($idProduto){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $query = $conn->prepare("SELECT t1.* FROM TB_Produto AS t1 WHERE t1.id_produto = $idProduto;");
      $query->execute();
      $dados = $query->fetchAll();
      
      if( count($dados) == 1 ){
        
        return $dados;
        
      }else{
        
        return false;
        
      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  
  function postCliente($VDados){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $strSQL = "INSERT INTO TB_Cliente(
                              nome,
                              email,
                              cpf,
                              endereco,
                              ccredito
                          )
                          VALUES(
                              #nome#,
                              #email#,
                              #CPF#,
                              #endereco#,
                              #ccredito#
                          )";
      
      $strSQL = str_replace("#nome#","'".$VDados["nome"]."'",$strSQL);             //Nome
      $strSQL = str_replace("#email#","'".$VDados["email"]."'",$strSQL);          //Email
      $strSQL = str_replace("#CPF#","'".$VDados["CPF"]."'",$strSQL);              //CPF
      $strSQL = str_replace("#endereco#","'".$VDados["endereco"]."'",$strSQL);              //CPF
      $strSQL = str_replace("#ccredito#","'".$VDados["ccredito"]."'",$strSQL);    //CCredito
      
      $query = $conn->prepare($strSQL);
      
      $query->execute();
      
      if ($query->rowCount() > 0){

              $idCliente = $conn->lastInsertId();
        
              return $idCliente;

      }else{

              return false;

      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  
  function getCliente($CPF){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $query = $conn->prepare("SELECT t1.* FROM TB_Cliente AS t1 WHERE t1.cpf = $CPF;");
      $query->execute();
      $dados = $query->fetchAll();
      
      if( count($dados) == 1 ){
        
        return $dados;
        
      }else{
        
        return false;
        
      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  
  
  function postPedido($id_cliente,$total_pedido){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $strSQL = "INSERT INTO `TB_Pedido`(
                      id_cliente,
                      preco_total,
                      dth_pgth
                  )
                  VALUES(
                      #id_cliente#,
                      #preco_total#,
                      #dth_pagamento#
                  )";
      
      $strSQL = str_replace("#id_cliente#","'".$id_cliente."'",$strSQL);                   //identifica o cliente
      $strSQL = str_replace("#preco_total#","'".$total_pedido."'",$strSQL);                  //Preco total
      $strSQL = str_replace("#dth_pagamento#","'".date("Y-m-d H:i:s")."'",$strSQL);          //data e hora do pagamento
      
      $query = $conn->prepare($strSQL);
      
      $query->execute();

      if ($query->rowCount() > 0){
        
              $idPedido = $conn->lastInsertId();

              return $idPedido;

      }else{

              return false;

      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  
  
  
  function postListaPedido($id_cliente,$preco,$quantidade,$id_pedido){
    
    try {
    
      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $strSQL = "INSERT INTO `TB_ListaPedido`(
                    id_produto,
                    preco_unitario,
                    quantidade,
                    id_pedido
                )
                VALUES(
                    #id_produto#,
                    #preco_unitario#,
                    #quantidade#,
                    #id_pedido#
                )";
      
      $strSQL = str_replace("#id_produto#","".$id_cliente."",$strSQL);                   //identifica o produto
      $strSQL = str_replace("#preco_unitario#","".$preco."",$strSQL);                  //Preco do produto
      $strSQL = str_replace("#quantidade#","".$quantidade."",$strSQL);           //quantidade do produto
      $strSQL = str_replace("#id_pedido#","".$id_pedido."",$strSQL);            //Id pedido
      
      $query = $conn->prepare($strSQL);
      
      $query->execute();

      if ($query->rowCount() > 0){
        
              $idLista = $conn->lastInsertId();

              return $idLista;

      }else{

              return false;

      }
      
    } catch(PDOException $e) {
      
      return false;
      
      echo 'ERROR: ' . $e->getMessage();
      
    }
    
  }
  

  
  
  
  function getTodosPedidosXCPF($strCPF){

    try {

      $objeto = new Conexao;
      $conn = $objeto->conectar();

      $query = $conn->prepare("
                          SELECT
                              t1.*, t2.*, t3.*, (SELECT nome FROM TB_Produto WHERE id_produto = t3.id_produto) AS nome_produto
                          FROM
                              TB_Cliente AS t1
                          INNER JOIN TB_Pedido AS t2 ON t2.id_cliente = t1.id_cliente
                          INNER JOIN TB_ListaPedido AS t3 ON t3.id_pedido = t2.id_pedido
                          WHERE
                              t1.cpf = '$strCPF'
                          ORDER BY
                            t2.id_pedido
                          ;");
      $query->execute();
      $dados = $query->fetchAll();

      if( count($dados) >0 ){

        return $dados;

      }else{

        return false;

      }

    } catch(PDOException $e) {

      return false;

      echo 'ERROR: ' . $e->getMessage();

    }

  }

  
}
?>
