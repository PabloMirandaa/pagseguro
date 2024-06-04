document.getElementById('paymentMethod').addEventListener('change', function() {
    var formCard = document.getElementById('formCard');
    var formBoleto = document.getElementById('formBoleto');
    var formPix = document.getElementById('formPix');

    switch (this.value) {
        case 'creditCard':
            formCard.style.display = 'block';
            formBoleto.style.display = 'none';
            formPix.style.display = 'none';
            break;
        case 'boleto':
            formCard.style.display = 'none';
            formBoleto.style.display = 'block';
            formPix.style.display = 'none';
            break;
        case 'pix':
            formCard.style.display = 'none';
            formBoleto.style.display = 'none';
            formPix.style.display = 'block';
            break;
        default:
            formCard.style.display = 'none';
            formBoleto.style.display = 'none';
            formPix.style.display = 'none';
    }
});

(function(win, doc) {
    'use strict';

    if (doc.querySelector('#formCard')) {
        let formCard = doc.querySelector('#formCard');
        formCard.addEventListener('submit', (e) => {
            e.preventDefault();
            let card = PagSeguro.encryptCard({
                publicKey: doc.querySelector('#publicKey').value,
                holder: doc.querySelector('#cardHolder').value,
                number: doc.querySelector('#cardNumber').value,
                expMonth: doc.querySelector('#cardMonth').value,
                expYear: doc.querySelector('#cardYear').value,
                securityCode: doc.querySelector('#cardCvv').value
            });

            if (card && card.hasOwnProperty('encryptedCard')) {
                let encrypted = card.encryptedCard;
                doc.querySelector('#encryptedCard').value = encrypted;
                formCard.submit();
            } else {
                console.error('Erro: Propriedade encryptedCard não encontrada no objeto card');
            }
        });
    }

    if (doc.querySelector('#formBoleto')) {
        let formBoleto = doc.querySelector('#formBoleto');
        formBoleto.addEventListener('submit', (e) => {
            e.preventDefault();
            // Se precisar de lógica adicional para Boleto, adicione aqui
            formBoleto.submit();
        });
    }

    if (doc.querySelector('#formPix')) {
        let formPix = doc.querySelector('#formPix');
        formPix.addEventListener('submit', (e) => {
            e.preventDefault();
            // Se precisar de lógica adicional para Pix, adicione aqui
            formPix.submit();
        });
    }

})(window, document);
