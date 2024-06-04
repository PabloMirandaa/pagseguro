<?php 
class PixController {

    public function __construct() {
        $data = [
            'reference_id' => 'ex-00001',
            'customer' => [
                'name' => 'Jose da Silva',
                'email' => 'email@test.com',
                'tax_id' => '12345678909',
                'phones' => [
                    [
                        'country' => '55',
                        'area' => '11',
                        'number' => '999999999',
                        'type' => 'MOBILE'
                    ]
                ]
            ],
            'items' => [
                [
                    'reference_id' => 'Notebook gamer',
                    'name' => 'notebook',
                    'quantity' => 1,
                    'unit_amount' => 3000
                ]
            ],
            "qr_codes"=> [
                [
                  "amount"=> [
                    "value"=> 3000
                  ],
                  "expiration_date"=> "2024-08-29T20:15:59-03:00",
                ]
              ],
            'shipping' => [
                'address' => [
                    'street' => 'Avenida Brigadeiro Faria Lima',
                    'number' => '1384',
                    'complement' => 'apto 12',
                    'locality' => 'Pinheiros',
                    'city' => 'São Paulo',
                    'region_code' => 'SP',
                    'country' => 'BRA',
                    'postal_code' => '01452002'
                ]
            ],
            'notification_urls' => [
                'https://meusite.com/notificacoes'
            ],
            
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://sandbox.api.pagseguro.com/orders');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            'Content-Type: application/json',
            'Authorization: Bearer 3D692C03C55B48EB9ED61F2851AD7F4D'
        ));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)); 
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $retorno = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $retorno = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $retorno = json_decode($retorno);
            if (isset($retorno->error_messages)) {
                echo "Erro: " . $retorno->error_messages[0]->description;
            }  else {
                if (isset($retorno->qr_codes[0]->links)) {
                    foreach ($retorno->qr_codes[0]->links as $link) {
                        if ($link->rel == "QRCODE.PNG") {
                            echo "<img src='" . $link->href . "' alt='QR Code'>";
                        } 
                    }
                } else {
                    echo "QR Code não encontrado na resposta.";
                }
            }
        }  
    }
}

$obj = new PixController();
?>
