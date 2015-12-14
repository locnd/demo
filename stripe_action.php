<?php

require 'strip-lib/Stripe.php';
if ($_POST) {
    Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");
    try {
        if (!isset($_POST['stripeToken'])) {
            echo "The Stripe Token was not generated correctly";
        } else {
            $customer = Stripe_Customer::create(array(
                "source" => $_POST['stripeToken'],
                "description" => "Example customer"
            ));
            Stripe_Charge::create(array(
                "amount" => 1000,
                "currency" => "usd",
                "customer" => $customer->id
            ));
            echo 'Your payment was successful.';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    header('/stripe.php');
}