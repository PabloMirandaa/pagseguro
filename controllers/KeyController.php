<?php 
class KeyController{

  public static function getPublicKey()
  {
      $data['type'] = "card";
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL,'https://sandbox.api.pagseguro.com/public-keys' );
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
        echo json_decode($retorno)->public_key;
      }
      
  }
}
?>


