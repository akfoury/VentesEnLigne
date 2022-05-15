(() => {
  const { error: backendError, clientSecret } = fetch('paymentIntent.php').then(res => res.json());

  if(backendError) {
    console.log(backendError.message);
  }

  console.log('')
});