# Flex Microform Sample

Flex Microform is a CyberSource-hosted HTML/JavaScript component that replaces the card number input field on your checkout page and calls the Flex API on your behalf. This simple example integration demonstrates using the Flex Microform SDK to embed this PCI SAQ A level component in your form. For more details on this see our Developer Guide at:  https://developer.cybersource.com/api/developer-guides/dita-flex/SAFlexibleToken/FlexMicroform.html

## Prerequisites

- PHP 5.6 or later
- Built-in PHP Web Server
- Composer

## Setup Instructions

1. Clone or download this repo.

2. Modify ExternalConfiguration.php with the CyberSource REST credentials created through [EBC Portal](https://ebc2test.cybersource.com/).

  ```php
  $this->merchantID  = 'YOUR MERCHANT ID';
  $this->apiKeyID = "YOUR KEY ID (SHARED SECRET SERIAL NUMBER)";
  $this->secretKey = "YOUR SHARED SECRET";
  ```

3. Pull down the package dependencies
  ```bash
  composer update
  ```

4. Run the web server
```bash
php -S localhost:8000 -t php-microform
```

5. Navigate to http://localhost:8000/checkout.php to try the sample application

## Tips

- If you are having issues, checkout the full [FLEX Microform documentation](https://developer.cybersource.com/api/developer-guides/dita-flex/SAFlexibleToken/FlexMicroform.html).

- Safari version 10 and below does not support `RsaOaep256` encryption schema, for those browser please specify encryption type `RsaOaep` when making a call to the `/keys` endpoint.  For a detailed example please see [FlexKeyProvider.java](./src/main/java/com.cybersource/example/FlexKeyProvider.java), line 47.
