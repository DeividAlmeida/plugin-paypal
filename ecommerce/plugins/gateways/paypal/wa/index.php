<?php
$reads =  DBRead('ecommerce_paypal','*', "WHERE id = '1'")[0];
//Incluindo o arquivo que contém a função sendNvpRequest
require_once('request.php');
 
//Vai usar o Sandbox, ou produção?
$sandbox = false;
 
//Baseado no ambiente, sandbox ou produção, definimos as credenciais
//e URLs da API.
if ($sandbox) {
    //credenciais da API para o Sandbox
    $user = $reads['usuario'];
    $pswd = $reads['senha'];
    $signature = $reads['token'];
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
    //credenciais da API para produção
    $user = $reads['usuario'];
    $pswd = $reads['senha'];
    $signature = $reads['token'];
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
}
//Campos da requisição da operação SetExpressCheckout, como ilustrado acima.



     
$requestNvp = array(

            'USER' => $user,
            'PWD' => $pswd,
            'SIGNATURE' => $signature,
         
            'VERSION' => '108.0',
            'METHOD'=> 'SetExpressCheckout',
         
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
            'PAYMENTREQUEST_0_AMT' => strval(post('valor')),
            'PAYMENTREQUEST_0_CURRENCYCODE' => $reads['moeda'],
            'PAYMENTREQUEST_0_ITEMAMT' => strval(post('valor') - post('vl_frete')),
            'PAYMENTREQUEST_0_SHIPPINGAMT' => strval(post('vl_frete')),
            'RETURNURL' => 'https://'.$reads['link_retorno'],
            'CANCELURL' => 'https://'.$reads['link_cancelado'],
            'PAYMENTREQUEST_0_INVNUM' => strval($read['id'])

);
            
 
           foreach($read as  $r){
        $pdt = json_decode($r['produto'], true);
        foreach($pdt as $keyf => $fds){
            
            $a = $fds['produto_pg'];
            $b = $fds['qtd'];
            $c = strval($fds['un_valor']);

       $_SESSION[$keyf] = [  
            'L_PAYMENTREQUEST_0_NAME'.$keyf => $a,
            'L_PAYMENTREQUEST_0_DESC'.$keyf => '',
            'L_PAYMENTREQUEST_0_AMT'.$keyf => $c,
            'L_PAYMENTREQUEST_0_QTY'.$keyf => $b,
            ];

            $requestNvp =  array_merge($_SESSION[$keyf], $requestNvp);
        }
    }      

   


#var_dump($requestNvp);

//Envia a requisição e obtém a resposta da PayPal
$responseNvp = sendNvpRequest($requestNvp, $sandbox);

//Se a operação tiver sido bem sucedida, redirecionamos o cliente para o
//ambiente de pagamento.
if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
    $query = array(
        'cmd'    => '_express-checkout',
        'token'  => $responseNvp['TOKEN']
    );
 
    $redirectURL = sprintf('%s?%s', $paypalURL, http_build_query($query));
 
    header('Location: ' . $redirectURL);
} else {
 print_r($responseNvp);
}
