<?php

require 'vendor/autoload.php';
require("./consoleLog.php");
require('./totalPrice.php');

// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51Kx59vB6hoQ7isu8B9E49vVyg0T1a1peBI618AGITFjTYV99IXwN6OsHglxnK0SRe9L8vNkSuhOcj0C37xZUOAoJ00FJhCovg8');

function calculateOrderAmount() {
    return 1400;
}


header('Content-Type: application/json');

try {
    // retrieve JSON from POST body
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);

    // Create a PaymentIntent with amount and currency
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => getTotalPrice()*100,
        'currency' => 'eur',
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
        'metadata' => [
            'order_id' => '1'
        ]
    ]);

    $output = [
        'clientSecret' => $paymentIntent->client_secret,
    ];

    echo json_encode($output);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}