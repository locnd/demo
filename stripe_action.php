<?php

// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");

// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];

// Create a Customer
$customer = \Stripe\Customer::create(array(
  "source" => $token,
  "description" => "Example customer")
);

// Charge the Customer instead of the card
\Stripe\Charge::create(array(
  "amount" => 1000, // amount in cents, again
  "currency" => "usd",
  "customer" => $customer->id)
);

// YOUR CODE: Save the customer ID and other info in a database for later!

// YOUR CODE: When it's time to charge the customer again, retrieve the customer ID!

\Stripe\Charge::create(array(
  "amount"   => 1500, // $15.00 this time
  "currency" => "usd",
  "customer" => $customerId // Previously stored, then retrieved
  ));