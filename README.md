# CyberSource Flex Samples (PHP)

This repository provides simple examples demonstrating usage of the CyberSource Flex SDK using either a headless JavaScript call (php-flexjs) or a fully customizable hosted field/microform (php-microform) which is incorporated into your checkout page.  For more details on Secure Acceptance Flex visit our Developer Guide at https://developer.cybersource.com/api/developer-guides/dita-flex/SAFlexibleToken.html

## Usage

1. Clone or download this repository.
2. Update ExternalConfiguration.php with your [CyberSource sandbox credentials](https://ebc2test.cybersource.com). 
3. Run ```composer update``` to pull down dependencies such as the CyberSource REST Client for PHP
4. Run ```php -S localhost:8000 router.php``` to run the built-in PHP web server
5. Browse to http://localhost:8000/checkout in your browser

## Requirements
* PHP 5.4 or later
* CyberSource PHP REST SDK


## API Reference
While these examples use the JavaScript libraries which we recommend as the most convenient option, you can try out the APIs behind the JavaScript SDKs by visiting our API Reference at https://developer.cybersource.com/api/reference/api-reference.html

## Background on PCI-DSS

Storing your customer’s card data can dramatically increase your repeat-customer conversion rate, but can also add additional risk and [PCI DSS](https://www.pcisecuritystandards.org/pci_security/) overhead. You can mitigate these costs by tokenizing card data. CyberSource will store your customer’s card data within secure Visa data centers, replacing it with a token that only you can use. 

Secure Acceptance Flexible Token is a secure method for Tokenizing card data, that leaves you in total control of the customer experience. Your customer’s card number is encrypted on their own device - for example inside a browser or native app - and sent directly to CyberSource. This means card data bypasses your systems altogether. This can help you qualify for [SAQ A](https://www.pcisecuritystandards.org/documents/Understanding_SAQs_PCI_DSS_v3.pdf) based PCI DSS assessments for web-based integrations, and [SAQ A-EP](https://www.pcisecuritystandards.org/documents/Understanding_SAQs_PCI_DSS_v3.pdf) for native app integrations.

You are in total control of the look and feel, with the ability to seamlessly blend the solution in to your existing checkout flow, on web or in-app.

On-device encryption helps to protect your customers from attacks on network middleware such as app accelerators, DLPs, CDNs, and malicious hotspots.

The token can be used in lieu of actual card data in server-side requests for other CyberSource services, for example to make a payment, using our REST APIs: https://developer.cybersource.com/api/reference/api-reference.html

## Samples

### JavaScript (Flex API) Sample (API Version 0.4)

This sample demonstrates how your checkout form can remain exactly as it is today, with the only addition of a JavaScript call to tokenize the customer's credit card information. This happens directly between their browser and CyberSource, replacing the provided data with a secure PCI-compliant token. This can then be sent to your server along with the other non-PCI order data.  This can help achieve PCI-DSS SAQ A-EP level compliance for your application.  

### Microform Sample (Microform Version 0.11)

This sample demonstrates how you can replace the sensitive data fields (credit card number) on your checkout form with a field (Flex Microform) hosted entirely on CyberSource servers. This field will accept and tokenize the customer's credit card information directly from their browser on a resource hosted by CyberSource, replacing that data with a secure PCI-compliant token. This can then be sent to your server along with the other non-PCI order data.  This can help achieve PCI-DSS SAQ A level compliance for your application as even your client-side code does not contain a mechanism to handle the credit card information.

## Using the Flex Payment Token

### Payment Processing Using (API Version 0.4)
You can use the token generated to make a payment with the CyberSource REST API (https://developer.cybersource.com/api/reference/api-reference.html).  

Place the token in the CustomerId field:

```json
{
  "clientReferenceInformation": {
    "code": "TC50171_3"
  },
  "processingInformation": {
    "commerceIndicator": "internet"
  },
  "paymentInformation": {
    "customer": {
      "customerId": "7500BB199B4270EFE05340588D0AFCAD"
    }
  },
  "orderInformation": {
    "amountDetails": {
      "totalAmount": "22",
      "currency": "USD"
    },
    "billTo": {
      "firstName": "John",
      "lastName": "Doe"
    }
  }
}

```

### Payment Processing Using (Microform Version 0.11)
You can use the transient token generated to make a payment with the CyberSource REST API (https://developer.cybersource.com/api/reference/api-reference.html).  

Place the token in the transienTokenJWK field:

```json
{
  "clientReferenceInformation": {
    "code": "TC50171_3"
  },
  "processingInformation": {
    "commerceIndicator": "internet"
  },
	
"tokenInformation": {
"transientTokenJwt": "eyJraWQiOiIwNzRsM3p5M2xCRWN5d1gxcnhXNFFoUmJFNXJLN1NmQiIsImFsZyI6IlJTMjU2In0.eyJkYXRhIjp7ImV4cGlyYXRpb25ZZWFyIjoiMjAyMSIsIm51bWJlciI6IjQxMTExMVhYWFhYWDExMTEiLCJleHBpcmF0aW9uTW9udGgiOiIwNSIsInR5cGUiOiIwMDEifSwiaXNzIjoiRmxleC8wOCIsImV4cCI6MTU4ODcwMjkxNSwidHlwZSI6Im1mLTAuMTEuMCIsImlhdCI6MTU4ODcwMjAxNSwianRpIjoiMUU0Q0NMSUw4NFFXM1RPSTFBM0pUU1RGMTZGQUNVNkUwNU9VRVNGWlRQNUhIVkJDWTQwUTVFQjFBRUMzNDZBMCJ9.FB3b2r8mjtvqo3_k05sRIPGmCZ_5dRSZp8AIJ4u7NKb8E0-6ZOHDwEpxtOMFzfozwXMTJ3C6yBK9vFIPTIG6kydcrWNheE2Pfort8KbxyUxG-PYONY-xFnRDF841EFhCMC4nRFvXEIvlcLnSK6opUUe7myKPjpZI1ijWpF0N-DzZiVT8JX-9ZIarJq2OI0S61Y3912xLJUKi5c2VpRPQOS54hRr5GHdGJ2fV8JZ1gTuup_qLyyK7uE1VxI0aucsyH7yeF5vTdjgSd76ZJ1OUFi-3Ij5kSLsiX4j-D0T8ENT1DbB_hPTaK9o6qqtGJs7QEeW8abtnKFsTwVGrT32G2w"
},
  "orderInformation": {
    "amountDetails": {
      "totalAmount": "22",
      "currency": "USD"
    },
    "billTo": {
      "firstName": "John",
      "lastName": "Doe"
    }
  }
}