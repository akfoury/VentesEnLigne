<?php
  // include configuration file
  require_once('config.php');

  // include Stripe PHP library
  require_once('stripe-php/init.php');

  //set Stripe API key
  $client = new \Stripe\StripeClient($stripe["publishable_key"]);

  $customerEmail = $_POST['customerEmail'];
  $amountTotal = $_POST['amountTotal'];
  $description = $_POST['description'];

  $token  = $_POST['stripeToken'];

  $success =  FALSE;
  $result = "";
  $err = "";
  $content = "";
  $headerColor = "row header green";

  if (!empty($token)){
      try {
          // Add customer to stripe
          $customer = \Stripe\Customer::create(array(
              'email' => $customerEmail,
              'source'  => $token
          ));

          // Charge a credit or a debit card
          $charge = \Stripe\Charge::create(array(
              'customer' => $customer->id,
              'description' => $description,
              'amount'   => $amountTotal,
              'currency' => 'eur'));

          // Get charge details
          $response = $charge->jsonSerialize(); 

          $status = $response['status'];

          if ($status == 'succeeded'){
              $success = TRUE;
          } else {
              $err = $response['failure_message'];
          }

      } catch(Stripe_Error $e) {
          $err = $e->getMessage();
      } catch (Exception $e) {
          $err = $e->getMessage();
      }
  } else {
      $err = "Payment form submission fails";
  }

  if ($success == TRUE) {
      $result = "Payment sucessful";
      $content = "Your payment (".$amountTotalStr.") has been received, thank you!";
  } else {
      $result = "Payment error";
      $content = $err;
      $headerColor = "row header";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="table">
        <div class="<?php echo $headerColor;?>">
            <div class="cell">
                <?php echo $result;?>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <?php echo $content;?>
            </div>
        </div>
    </div>
</body>
</html>

