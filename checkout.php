<?php 
include('controllers/KeyController.php');
$objKey= new KeyController();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>pagseguro</title>
</head>
<body>
<div class="col-6 m-auto">
    <label for="paymentMethod">Método de Pagamento:</label>
    <select class="form-select" id="paymentMethod" name="paymentMethod">
        <option value="" selected disabled>Escolha o método de pagamento</option>
        <option value="creditCard">Cartão de Crédito</option>
        <option value="boleto">Boleto</option>
        <option value="pix">Pix</option>
    </select>
</div>

<form method="post" name="formCard" id="formCard" action="controllers/PayController.php" style="display: none;">
    <div class="col-6 m-auto">
        <input type="text" name="publicKey" id="publicKey" value="<?php echo $objKey::getPublicKey(); ?>" hidden>
        <input type="text" name="encryptedCard" id="encryptedCard" hidden>
        <div class="mb-3">
            <label for="cardNumber" class="form-label">Número do Cartão</label>
            <input type="text" class="form-control" name="cardNumber" id="cardNumber" maxlength="16" placeholder="Número do Cartão">
        </div>
        <div class="mb-3">
            <label for="cardHolder" class="form-label">Nome no Cartão</label>
            <input type="text" class="form-control" name="cardHolder" id="cardHolder" placeholder="Nome no Cartão">
        </div>
        <div class="mb-3">
            <label for="cardMonth" class="form-label">Mês de Validade</label>
            <input type="text" class="form-control" name="cardMonth" id="cardMonth" maxlength="2" placeholder="MM">
        </div>
        <div class="mb-3">
            <label for="cardYear" class="form-label">Ano de Validade</label>
            <input type="text" class="form-control" name="cardYear" id="cardYear" maxlength="4" placeholder="AAAA">
        </div>
        <div class="mb-3">
            <label for="cardCvv" class="form-label">CVV</label>
            <input type="text" class="form-control" name="cardCvv" id="cardCvv" maxlength="4" placeholder="CVV">
        </div>
        <input type="submit" class="btn btn-primary" value="Pagar">
    </div>
</form>

<form method="post" name="formBoleto" id="formBoleto" action="controllers/BolController.php" style="display: none;">
    <div class="col-6 m-auto">
        <input type="hidden" name="paymentMethod" value="boleto">
        <input type="submit" class="btn btn-primary" value="Gerar Boleto">
    </div>
</form>

<form method="post" name="formPix" id="formPix" action="controllers/PixController.php" style="display: none;">
    <div class="col-6 m-auto">
        <input type="hidden" name="paymentMethod" value="pix">
        <input type="submit" class="btn btn-primary" value="Gerar Pix">
    </div>
</form>

<script src="https://assets.pagseguro.com.br/checkout-sdk-js/rc/dist/browser/pagseguro.min.js"></script>
<script src="assets/js/javascript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>