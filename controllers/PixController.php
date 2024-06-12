<?php 
session_start();

class PixController {
    protected static $configuracoes;
    protected static $accessToken;
    private static $_instancia = null;

    public function __construct() {
        self::iniciarVariaveis();
    }

    public static function get() {
        if (self::$_instancia == null) {
            self::$_instancia = new PixController();
        }
        return self::$_instancia;
    }

    private static function iniciarVariaveis() {
        // Caminho absoluto para o diretório base do projeto
        $baseDir = dirname(__DIR__);

        // Caminho absoluto para o arquivo de configuração
        $arquivoConfiguracoes = file_get_contents($baseDir . "/config/token.config");

        if ($arquivoConfiguracoes === false) {
            die("Erro ao abrir o arquivo de configuração.");
        }

        self::$configuracoes = json_decode($arquivoConfiguracoes, true);
        self::$accessToken = self::$configuracoes["tokenACesso"];
    }

    public function solicitarPagamento() {
        $stringCredenciais = self::$accessToken;

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
            "qr_codes" => [
                [
                    "amount" => [
                        "value" => 300000
                    ],
                    "expiration_date" => "2024-08-29T20:15:59-03:00",
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
            'Authorization: Bearer ' . $stringCredenciais
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
            } else{
                foreach ($retorno->qr_codes[0]->links as $link) {
                    if ($link->rel == "QRCODE.PNG") {
                        $_SESSION['pix_qrcode'] = $link->href;
                        echo "<script>
                            window.open('{$link->href}', '_blank');
                            window.location.href = '../views/pix_view.php';
                        </script>";
                        exit;
                    }
                }
            } 
        }
    }
}


$obj = PixController::get();
$obj->solicitarPagamento();
?>
