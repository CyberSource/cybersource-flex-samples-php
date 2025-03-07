<?php
// START GENAI
if (php_sapi_name() == 'cli-server') {
    // Serve the requested resource as-is if it exists
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

// Your custom routing logic here
switch ($_SERVER['REQUEST_URI']) {
    case '/':
        echo 'Welcome to the home page!';
        break;
    case '/about':
        echo 'This is the about page.';
        break;
    case '/checkout':
        require 'checkout.php';
        break;
    default:
        echo 'Page not found.';
        break;
}
// END GENAI

?>