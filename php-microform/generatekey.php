<?php

    require_once __DIR__. DIRECTORY_SEPARATOR .'../vendor/autoload.php';
    require_once __DIR__. DIRECTORY_SEPARATOR .'../ExternalConfiguration.php';

    $allowedCardNetworks = ["VISA", "MASTERCARD", "AMEX", "CARNET", "CARTESBANCAIRES", "CUP", "DINERSCLUB", "DISCOVER", "EFTPOS", "ELO", "JCB", "JCREW", "MADA", "MAESTRO", "MEEZA"];

    $requestObjArr = [
            "targetOrigins" => ["http://localhost:8000"],
            "clientVersion" => "v2",
            "allowedCardNetworks" => $allowedCardNetworks,
            "allowedPaymentTypes" => ["CARD"]
    ];
    $requestObj = new CyberSource\Model\GenerateCaptureContextRequest($requestObjArr);

	$commonElement = new CyberSource\ExternalConfiguration();
	$config = $commonElement->ConnectionHost();
	$merchantConfig = $commonElement->merchantConfigObject();
	$apiClient = new CyberSource\ApiClient($config, $merchantConfig);
    $apiInstance = new CyberSource\Api\MicroformIntegrationApi($apiClient);
	$captureContext = '';
	$clientLibrary = '';
	$clientLibraryIntegrity = '';
	try {
        $apiResponse = $apiInstance->generateCaptureContext($requestObj);
		$captureContext = $apiResponse[0];
		$decoded = json_decode(base64_decode(explode('.', $captureContext)[1]), true);
		$clientLibrary = $decoded['ctx'][0]['data']['clientLibrary'];
		$clientLibraryIntegrity =$decoded['ctx'][0]['data']['clientLibraryIntegrity'];
        //return $apiResponse;
	} catch (Cybersource\ApiException $e) {
		print_r($e->getResponseBody());
        print_r($e->getMessage());
	}

?>