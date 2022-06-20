@extends('layouts.main')

@section('container')
    <h2>This is PayPal Testing</h2>

    <label for="test_payPal" class="form-label">Donation Amount</label>
    <input type="text" id="test_payPal" class="form-control col-sm-4 mb-2">

    <script
        src="https://www.paypal.com/sdk/js?client-id=AWeEpkof-DJakIyEMwnJk8S00pRZvt6JBJSFvuG3ufOu24fLJQiXeQGxiKOwSdBSen6dkZmsgKeim2ZY&currency=USD">
    </script>
    {{ csrf_field() }}
    <div id="paypal-button-container" style="max-width: 50%;"></div>
    <script>
        $(document).ready(function() {
            // var final = 0;
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                // value: '77.44' // Can also reference a variable or function
                                value: getTotalDonation() // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        // Successful capture! For dev/demo purposes:
                        // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];
                        // alert(
                        //     `Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                        // When ready to go live, remove the alert and show a success message within this page. For example:
                        // const element = document.getElementById('paypal-button-container');
                        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                        // Or go to another URL:  actions.redirect('thank_you.html');
                        // ajaxSendData();
                        getConversionAndAjax();
                        // getTotalDonation();
                    });
                }
            }).render('#paypal-button-container');



            function getConversionAndAjax() {
                const api = "https://api.exchangerate-api.com/v4/latest/USD";

                fetch(`${api}`).then(currency => {
                    return currency.json()
                }).then(getResults)
            }

            function getResults(currency) {
                let resultFrom = 'USD';
                let resultTo = 'IDR';

                let fromRate = currency.rates[resultFrom];
                let toRate = currency.rates[resultTo];

                // console.log(fromRate);
                // console.log(toRate);

                var usd = getTotalDonation();

                var finalValue = ((toRate / fromRate) * usd).toFixed(2);

                final = parseInt(finalValue);

                // return final;
                ajaxSendData(final);
                // passTest(final);

                // console.log(final);
                // console.log(finalValue);

                // return parseInt(finalValue);
            }

            function passTest(final) {
                console.log(final)
            }

            // $('#test_payPal').keyup(function() {
            //     getConversionAndAjax();
            //     // console.log(final);
            // });

            function getTotalDonation() {
                // alert(parseInt($('#test_payPal').val()));
                return $('#test_payPal').val();
            }

            function getToken() {
                // alert(parseInt($('#test_payPal').val()));
                return $('input[name="_token"]').val();
            }

            function ajaxSendData(final) {
                $.ajax({
                    url: "{{ route('payPal.post') }}",
                    method: 'POST',
                    data: {
                        amount: final,
                        _token: getToken(),
                    },
                    success: function(data) {
                        // alert(data.table_button);
                        // $('#result').html(data.table_data);
                        // $('#load_more_button').remove();
                        // // alert(data)
                        // $('#result').append(data);
                        alert(data);
                    }
                });
            }
        });
    </script>

    <!-- Replace "test" with your own sandbox Business account app client ID -->
@endsection
