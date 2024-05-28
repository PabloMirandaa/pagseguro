<?php 
class PayController{

    public function __construct()
    {
        {

        $data['reference_id'] = "ex-00001";
        $data["customer"] = [
            "name"=> "Jose da Silva",
            "email"=> "email@test.com",
            "tax_id"=> "12345678909",
            "phones"=> [
                [
                    "country"=> "55",
                    "area"=> "11",
                    "number"=> "999999999",
                    "type"=> "MOBILE"
                ]
            ]
        ];
        $data["items"]=[
            [
                "reference_id"=> "referencia do item",
                "name"=> "nome do item",
                "quantity"=> 1,
                "unit_amount"=> 500
            ]
        ];
        $data["shipping"]= [
            "address"=> [
                "street"=> "Avenida Brigadeiro Faria Lima",
                "number"=> "1384",
                "complement"=> "apto 12",
                "locality"=> "Pinheiros",
                "city"=> "São Paulo",
                "region_code"=> "SP",
                "country"=> "BRA",
                "postal_code"=> "01452002"
            ]
        ];
        $data["notification_urls"]= [
            "https://meusite.com/notificacoes"
        ];
        $data["charges"] = [           
            [
                "reference_id"=> "referencia da cobranca",
                "description"=> "descricao da cobranca",
                "amount"=> [
                    "value"=> 500,
                    "currency"=> "BRL"
                ],
                "payment_method"=> [
                    'soft_descriptor'=>'WEBDESIGN',
                    "type"=> "CREDIT_CARD",
                    "installments"=> 1,
                    "capture"=> true,
                    "card"=> [
                        "encrypted"=>$_POST['encryptedCard'],
                        "security_code"=> "123",
                        "holder"=> [
                            "name"=> "Jose da Silva",
                            "tax_id"=> "65544332211"
                        ],
                        "store"=> true
                    ]
                    
                ]
            ]
        ];
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL,'https://sandbox.api.pagseguro.com/orders' );
      curl_setopt($curl,CURLOPT_HTTPHEADER,Array(
          "accept: application/json",
          'Content-Type: application/json',
          'Authorization: Bearer 3D692C03C55B48EB9ED61F2851AD7F4D'
      ));
      curl_setopt($curl,CURLOPT_POST,true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
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
        var_dump(json_decode($retorno));
      }

    }
}
}
$obj = new PayController();
?>