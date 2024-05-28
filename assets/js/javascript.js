(function(win,doc){

    'use strict'; 

    if(doc.querySelector('#formCard')){
        let formCard = doc.querySelector('#formCard');
        formCard.addEventListener('submit',(e)=>{
            e.preventDefault();
            let card =PagSeguro.encryptCard({
                publicKey: doc.querySelector('#publicKey').value,
                holder: doc.querySelector('#cardHolder').value,
                number: doc.querySelector('#cardNumber').value,
                expMonth: doc.querySelector('#cardMonth').value,	
                expYear: doc.querySelector('#cardYear').value,	
                securityCode: doc.querySelector('#cardCvv').value
            });

            if (card && card.hasOwnProperty('encryptedCard')) { // usado para garantir que a propriedade existe antes de usa-la
                let encrypted = card.encryptedCard; 
                doc.querySelector('#encryptedCard').value = encrypted;  
                formCard.submit();
            } else {
                console.error('Erro: Propriedade encryptedCard não encontrada no objeto card');
            }
            
        })
    }
    
})(window,document)