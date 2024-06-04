<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Transação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Compra Realizada com Sucesso</h1>
    <div class="alert alert-success" role="alert">
        A compra foi realizada com sucesso. Confira os detalhes abaixo:
    </div>
    <h2>Detalhes da Transação</h2>
    <p><strong>ID da Transação:</strong> <?php echo $transacao->id; ?></p>
    <p><strong>ID de Referência:</strong> <?php echo $transacao->reference_id; ?></p>
    <p><strong>Data de Criação:</strong> <?php echo $transacao->created_at; ?></p>
    <p><strong>Status:</strong> <?php echo $transacao->charges[0]->status; ?></p>
    <h3>Cliente</h3>
    <p><strong>Nome:</strong> <?php echo $transacao->customer->name; ?></p>
    <p><strong>Email:</strong> <?php echo $transacao->customer->email; ?></p>
    <p><strong>CPF:</strong> <?php echo $transacao->customer->tax_id; ?></p>
    <h3>Endereço de Entrega</h3>
    <p><?php echo $transacao->shipping->address->street . ', ' . $transacao->shipping->address->number . ', ' . $transacao->shipping->address->complement; ?></p>
    <p><?php echo $transacao->shipping->address->locality . ', ' . $transacao->shipping->address->city . ' - ' . $transacao->shipping->address->region_code; ?></p>
    <p><?php echo $transacao->shipping->address->country . ' - CEP: ' . $transacao->shipping->address->postal_code; ?></p>
    <h3>Itens</h3>
    <ul>
        <?php foreach ($transacao->items as $item) : ?>
            <li><?php echo $item->name . ' - Quantidade: ' . $item->quantity . ' - Preço: R$' . number_format($item->unit_amount / 100, 2, ',', '.'); ?></li>
        <?php endforeach; ?>
    </ul>
    <h3>Pagamento</h3>
    <p><strong>Valor Total:</strong> R$<?php echo number_format($transacao->charges[0]->amount->value / 100, 2, ',', '.'); ?></p>
    <p><strong>Status:</strong> <?php echo $transacao->charges[0]->payment_response->message; ?></p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
