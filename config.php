<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);

error_reporting(E_ALL);

//Definir Time Zone
date_default_timezone_set('America/Sao_Paulo');

session_start();

//Configs
$strEmpresa                 = "Lojas Blue";
$strSistema                 = "Sys Blue";
$strSistemaVersao           = "202207081800";
$strCaminhoExterno          = "https://golinelli.eti.br/Projetos/BlueServiceDesafio/";
$strCaminhoInterno          = "/home/u553825348/public_html/Projetos/BlueServiceDesafio/";

$_SESSION["Empresa"]        = $strEmpresa;
$_SESSION["Sistema"]        = $strSistema;
$_SESSION["SistemaVersao"]  = $strSistemaVersao;
$_SESSION["CaminhoExterno"] = $strCaminhoExterno;
$_SESSION["CaminhoInterno"] = $strCaminhoInterno;


?>