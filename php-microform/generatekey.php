<?php

    require_once __DIR__. DIRECTORY_SEPARATOR .'../vendor/autoload.php';
    require_once __DIR__. DIRECTORY_SEPARATOR .'../configuration.php';

    $commonElement = new configuration();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\KeyGenerationApi($apiclient);
	$flexRequestArr = [
	'encryptionType' => "RsaOaep256",
    'targetOrigin' => 'http://localhost:3000'
	];
	$flexRequest = new CyberSource\Model\KeyParameters($flexRequestArr);
	$keyResponse = list($response, $statusCode, $httpHeader)=null;
	try {
		$keyResponse = $api_instance->generatePublicKey($flexRequest);
		print_r($keyResponse);
		
	} catch (Cybersource\ApiException $e) {
		print_r($e->getResponseBody());
        print_r($e->getMessage());
	}
?>