<?php
session_start();
$pixQRCode = isset($_SESSION['pix_qrcode']) ? $_SESSION['pix_qrcode'] : '#';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Concluída</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Compra Concluída!</h4>
        <p>Sua compra foi concluída com sucesso. O QR code do PIX foi gerado e está disponível para pagamento.</p>
        <a href="<?php echo $pixQRCode; ?>" target="_blank" class="btn btn-primary">Abrir QR code</a>
        <hr>
        <p class="mb-0">Obrigado por comprar conosco!</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
