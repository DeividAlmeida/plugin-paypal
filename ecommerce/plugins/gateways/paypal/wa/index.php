<?php
    

//Incluindo o arquivo que contém a função sendNvpRequest
require_once('request.php');
 
//Vai usar o Sandbox, ou produção?
$sandbox = true;
 
//Baseado no ambiente, sandbox ou produção, definimos as credenciais
//e URLs da API.
if ($sandbox) {
    //credenciais da API para o Sandbox
    $user = 'paypal_api1.tapiocacorp.com';
    $pswd = 'RM2563V97DB853B2';
    $signature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31AyIQDAysZVi3HnR9JoqEZEjhx1rf';
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
    //credenciais da API para produção
    $user = 'paypal_api1.tapiocacorp.com';
    $pswd = 'RM2563V97DB853B2';
    $signature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31AyIQDAysZVi3HnR9JoqEZEjhx1rf';
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
}
//Campos da requisição da operação SetExpressCheckout, como ilustrado acima.
 foreach($read as $r){
        $pdt = json_decode($r['produto'], true);
        foreach($pdt as $keyf => $fds){
            
            $a = $fds['produto_pg'];
            $b = $fds['qtd'];
            $c = $fds['un_valor'];
            $d += $fds['un_valor'];


$responseNvp = array(

            'USER' => $user,
            'PWD' => $pswd,
            'SIGNATURE' => $signature,
         
            'VERSION' => '108.0',
            'METHOD'=> 'SetExpressCheckout',
         
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
            'PAYMENTREQUEST_0_AMT' => post('valor'),
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL',
            'PAYMENTREQUEST_0_ITEMAMT' => $d,
            'PAYMENTREQUEST_0_INVNUM' => '1234',
            'PAYMENTREQUEST_0_SHIPPINGAMT' => post('vl_frete'),
         
            'L_PAYMENTREQUEST_0_NAME'.$keyf => $a,
            'L_PAYMENTREQUEST_0_DESC'.$keyf => '',
            'L_PAYMENTREQUEST_0_AMT'.$keyf => $c,
            'L_PAYMENTREQUEST_0_QTY'.$keyf => $b,
            
         
            'RETURNURL' => 'http://PayPalPartner.com.br/VendeFrete?return=1',
            'CANCELURL' => 'http://PayPalPartner.com.br/CancelaFrete',
            'BUTTONSOURCE' => 'BR_EC_EMPRESA'
);
            

print_r($requestNvp);

//Envia a requisição e obtém a resposta da PayPal
$responseNvp = sendNvpRequest($requestNvp, $sandbox);
        }
    }
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
