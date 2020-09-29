<?php 
header('Access-Control-Allow-Origin: *');
require_once('../../../../../includes/funcoes.php');
require_once('../../../../../database/config.database.php');
require_once('../../../../../database/config.php');

if(isset($_GET['statuspaypal'])){
    $status =$_GET['statuspaypal'];
    if($status == "true"){
      $callback = "checked";
    }else{ $callback = ""; }
    $query  = DBUpdate('ecommerce_plugins', array('status' => $callback), "nome = 'paypal'");
  }

  if(isset($_GET['paypal'])){

  $data = array(
    'usuario' =>        $_GET['usuario'],
    'senha' =>          $_GET['senha'],
    'token' =>          $_GET['token'],
    'moeda' =>          $_GET['moeda'],
    'link_retorno' =>   $_GET['link_retorno'],
    'link_cancelado' => $_GET['link_cancelado']
  );
  $query  = DBUpdate('ecommerce_paypal', $data, "id = '1'");
}