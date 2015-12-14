<form action="stripe_action.php" method="POST" id="payment-form">
    <span class="payment-errors"></span>
    <div class="form-row">
        <label>
            <span>Card Number</span>
            <input id="card-number" type="text" size="20" data-stripe="number" value="4242424242424242"/>
        </label>
    </div>
    <div class="form-row">
        <label>
            <span>CVC</span>
            <input id="card-cvc" type="text" size="4" data-stripe="cvc" />
        </label>
    </div>
    <div class="form-row">
        <label>
            <span>Expiration (MM/YYYY)</span>
            <input id="card-expiry-month" type="text" size="2" data-stripe="exp-month" />
        </label>
        <span> / </span>
        <input id="card-expiry-year" type="text" size="4" data-stripe="exp-year" />
    </div>
    <button type="button" id="submit">Submit Payment</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(document).ready(function(){
        Stripe.setPublishableKey('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
        $('#submit').click(function() {
            $('.payment-errors').text('');
            $('input').removeAttr('style');
            var check = true;
            if (!Stripe.card.validateCardNumber($('#card-number').val())) {
                check = false;
                $('#card-number').attr('style','border-color:red');
            }
            if (!Stripe.card.validateExpiry($('#card-expiry-month').val(), $('#card-expiry-year').val())) {
                check = false;
                $('#card-expiry-month').attr('style','border-color:red');
                $('#card-expiry-year').attr('style','border-color:red');
            }
            if (!Stripe.card.validateCVC($('#card-cvc').val())) {
                check = false;
                $('#card-cvc').attr('style','border-color:red');
            } 
            if (check) {
                Stripe.card.createToken({
                    number: $('#card-number').val(),
                    cvc: $('#card-cvc').val(),
                    exp_month: $('#card-expiry-month').val(),
                    exp_year: $('#card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });
    });
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.payment-errors').text(response.error.message);
        } else {
            var token = response.id;
            $('#payment-form').append($('<input type="hidden" name="stripeToken" />').val(token));
            console.log(token);
            $('#payment-form').submit();
        }
    }
</script>