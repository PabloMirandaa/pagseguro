<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>paypal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <img src="assets/img/banner.jpeg" alt="banner" >
    </header>

    <main>
        <div class="product">
            <div class="product-title">Notebook</div>
            <div class="product-price">R$ 3000,00</div>
            <div class="product-image">
            <img src="assets/img/notbook.jpg" alt="notebook" style="width: 50%">
            </div>
            <a href="checkout.php?name=casinha&&price=3000">
            <div class="product-button"> 
                <div        class="product-button-label">Comprar</div>
            </div>
            </a>
        </div>
    </main>

    <div style="width: 30%; margin: 30px 1.5%; border-radius: 5px; box-shadow: 0 10px 20px #999; text-align: center; padding: 10px; ">
        Notebook Gamer <br>
        R$3000,00 <br> 

        <img src="assets/img/notbook.jpg" alt="notbook" style="width: 50%">

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick" />
            <input type="hidden" name="hosted_button_id" value="FZ49DXHQCPURG" />
            <input type="hidden" name="currency_code" value="BRL" />
            <input type="image" src="https://www.paypalobjects.com/pt_BR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="O PayPal é a forma fácil e segura de pagar suas compras on-line." alt="Comprar agora" />
        </form>
    </div>
    </main>

    <footer>
        <strong>Informatica Brasil</strong><br>
        Brasília <br>
        Telefone : (61)4002-8922

    </footer>
<script src="assets/js/custom.js"></script>
</body>
</html>