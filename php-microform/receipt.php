<?php
session_start();

// 1. CSRF Token Validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die('CSRF token validation failed');
    }
}

// 2. Session Validation - Check if user initiated checkout
if (!isset($_SESSION['checkout_session_id'])) {
    http_response_code(401);
    die('Unauthorized: No active checkout session');
}

// 3. Rate Limiting - Track payment attempts per session
$rate_limit_key = 'payment_attempts_' . session_id();
$max_attempts = 5;
$time_window = 3600; // 1 hour

if (!isset($_SESSION[$rate_limit_key])) {
    $_SESSION[$rate_limit_key] = [];
}

// Clean old attempts outside time window
$_SESSION[$rate_limit_key] = array_filter(
    $_SESSION[$rate_limit_key],
    function($timestamp) use ($time_window) {
        return time() - $timestamp < $time_window;
    }
);

// Check if rate limit exceeded
if (count($_SESSION[$rate_limit_key]) >= $max_attempts) {
    http_response_code(429);
    die('Rate limit exceeded: Too many payment attempts');
}

// 4. Validate transient token format and origin
if (empty($_POST['flexresponse'])) {
    http_response_code(400);
    die('Missing payment token');
}

$transientToken = json_decode($_POST["flexresponse"], true);

// Verify token matches session token
if (!isset($_SESSION['expected_token']) || $transientToken !== $_SESSION['expected_token']) {
    http_response_code(400);
    die('Invalid or mismatched payment token');
}

// Record this payment attempt
$_SESSION[$rate_limit_key][] = time();

// Clear sensitive session data after validation
unset($_SESSION['expected_token']);
unset($_SESSION['csrf_token']);

include 'paymentWithFlexTransientToken.php';

?>


<html lang="en">
    <head>
        <title>Receipt</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <style>
            .td-1 {
                word-break: break-all;
                word-wrap: break-word;
            }
        </style>
    </head>
    
    <body>
        <div class="container card">
            <div class="card-body">
                <h1>Receipt</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Key</th>
                            <th scope="col">value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td>PaymentResponse</td>
                            <td>
                            <?php echo $apiResponse[0]; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="checkout.php" class="btn btn-primary">Repeat checkout process</a>
            </div>
        </div>
    </body>
</html>