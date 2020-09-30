<?php header('Access-Control-Allow-Origin: *');
require_once('../../../../includes/funcoes.php');
require_once('../../../../database/config.database.php');
require_once('../../../../database/config.php');
$read =  DBRead('ecommerce_paypal','*', "WHERE id = '1'")[0];
$paypal = DBRead('ecommerce_plugins','*', "WHERE nome = 'paypal'")[0];
?>
<div class="card">
    <div class="card-header white">
    <strong>Configurar Meio de Pagamento</strong>
</div>
<div class="card-body">        
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Coloque o usuário de configuração do PayPal" value="<?php echo $read['usuario']; ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="text" name="senha" id="senha" class="form-control" placeholder="Coloque a senha de configuração do PayPal" value="<?php echo $read['senha']; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="token">Token:</label>
                <input type="text" name="token" id="token" class="form-control" placeholder="Coloque o token de configuração do PayPal" value="<?php echo $read['token']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Moeda:</label>
                <div class="input-group focused">
                    <select class="form-control" name="moeda" id="moeda">
                        <option value="BRL" <?php Selected($read['moeda'], 'BRL'); ?>>BRL</option>
                        <option value="USD" <?php Selected($read['moeda'], 'USD'); ?>>USD</option>
                        <option value="EUR" <?php Selected($read['moeda'], 'EUR'); ?>>EUR</option> 
                    </select>          
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="link_retorno">Link de Pagamento Efetuado:<i class="icon icon-question-circle tooltips" data-tooltip="Não coloque o protocolo http ou https"><span class="inner">Não coloque o protocolo http ou https</span></i></label>
                <input type="text" name="link_retorno" id="link_retorno" class="form-control" placeholder="Coloque o link de redirecionamento" value="<?php echo $read['link_retorno']; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="link_cancelado">Link de Pagamento Cancelado:<i class="icon icon-question-circle tooltips" data-tooltip="Não coloque o protocolo http ou https"><span class="inner">Não coloque o protocolo http ou https</span></i></label>
                <input type="text" name="link_cancelado" id="link_cancelado" class="form-control" placeholder="Coloque o link de redirecionamento" value="<?php echo $read['link_cancelado']; ?>">
            </div>
        </div>
    </div>
</div>
<script>
function paypal(){

    
    let m = new XMLHttpRequest();
    let a = document.getElementById('usuario').value;
    let b = document.getElementById('senha').value;
    let c = document.getElementById('token').value;
    let d = document.getElementById('moeda').value;
    let e = document.getElementById('link_retorno').value;
    let f = document.getElementById('link_cancelado').value;
    m.open("GET", "?paypal&usuario="+a+"&senha="+b+"&token="+c+"&moeda="+d+"&link_retorno="+e+"&link_cancelado="+f);
    m.send();
    m.onload = () => {swal("Informações de pagamento Atualizadas!", "Informações de pagamento atualizadas com sucesso!", "success");}
}
</script>