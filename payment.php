<?php
  session_start();
  require('./totalPrice.php');
  $paymentAmount = getTotalPrice();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./checkout.js" defer></script>
  <link rel="stylesheet" href="./styles/checkout.css"></link>
</head>
<body>
  <form id="payment-form">
    <div id="payment-element">
      <!--Stripe.js injects the Payment Element-->
    </div>
    <button id="submit">
      <div class="spinner hidden" id="spinner"></div>
      <span id="payment-button">Payer</span>
    </button>
    <div id="payment-message" class="hidden"></div>
  </form>
</body>
</html>