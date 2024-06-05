<?php
session_start();

class BolController {
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
                    'reference_id' => 'referencia do item',
                    'name' => 'notebook gamer',
                    'quantity' => 1,
                    'unit_amount' => 300000
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
            'charges' => [
                [
                    'reference_id' => 'referencia da cobranca',
                    'description' => 'descricao da cobranca',
                    'amount' => [
                        'value' => 300000,
                        'currency' => 'BRL'
                    ],
                    'payment_method' => [
                        'type' => 'BOLETO',
                        'boleto' => [
                            'due_date' => date('Y-m-d', strtotime('+3 days')),
                            'instruction_lines' => [
                                'line_1' => 'Pagamento processado para DESC Fatura',
                                'line_2' => 'Via PagSeguro'
                            ],
                            'holder' => [
                                'name' => 'Jose da Silva',
                                'tax_id' => '12345679891',
                                'email' => 'jose@email.com',
                                'address' => [
                                    'country' => 'Brasil',
                                    'region' => 'São Paulo',
                                    'region_code' => 'SP',
                                    'city' => 'Sao Paulo',
                                    'postal_code' => '01452002',
                                    'street' => 'Avenida Brigadeiro Faria Lima',
                                    'number' => '1384',
                                    'locality' => 'Pinheiros'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
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

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $retorno = json_decode($retorno);
            if (isset($retorno->error_messages)) {
                echo "Erro: " . $retorno->error_messages[0]->description;
            } else {
                foreach ($retorno->charges[0]->links as $link) {
                    if ($link->media == "application/pdf") {
                        $_SESSION['boleto_link'] = $link->href;
                        echo "<script>
                            window.open('{$link->href}', '_blank');
                            window.location.href = '../views/bol_view.php';
                        </script>";
                        exit;
                    }
                }
            }
        }
    }
}

$obj = new BolController();
?>
