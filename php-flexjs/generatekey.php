<?php

    require_once __DIR__. DIRECTORY_SEPARATOR .'../vendor/autoload.php';
    require_once __DIR__. DIRECTORY_SEPARATOR .'../ExternalConfiguration.php';

	$commonElement = new CyberSource\ExternalConfiguration();
	$config = $commonElement->ConnectionHost();
	$merchantConfig = $commonElement->merchantConfigObject();
	$apiclient = new CyberSource\ApiClient($config, $merchantConfig);
	$api_instance = new CyberSource\Api\KeyGenerationApi($apiclient);
	$flexRequestArr = [
	"encryptionType" => "RsaOaep256",
	"targetOrigin" => "http://localhost:8000",
	];
	
	$keyResponse = list($response, $statusCode, $httpHeader)=null;
	$jwkJSON = '{}';

	try {
		$keyResponse = $api_instance->generatePublicKey($format = 'legacy', $flexRequestArr);
		
		$jwkArray = $keyResponse[0]["jwk"];
		// print_r($jwkArray);

        // NOTE json_encode is not working because the array is protected
		$jwk = json_encode($jwkArray,JSON_FORCE_OBJECT);
        // print_r($jwk);

		// SO that's why we're string handling the JSON object
        $jwkJSON = '{"kty":"'.$jwkArray['kty'].'","kid":"'.$jwkArray['kid'].'","use":"'.$jwkArray['use'].'","n":"'.$jwkArray['n'].'","e":"'.$jwkArray['e'].'"}';
        // print_r($jwkJSON);

	} catch (Cybersource\ApiException $e) {
		print_r($e->getResponseBody());
        print_r($e->getMessage());
	}

    
?>