@extends('layouts.main')

@section('container')
    <h2>This is a testing page</h2>
    {{-- <input type="text" id="test_payPal" class="form-control col-sm-4 mb-2"> --}}
    
    <script
        src="https://www.paypal.com/sdk/js?client-id=AWeEpkof-DJakIyEMwnJk8S00pRZvt6JBJSFvuG3ufOu24fLJQiXeQGxiKOwSdBSen6dkZmsgKeim2ZY&currency=USD">
        paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                // value: '77.44' // Can also reference a variable or function
                                value: '77.44' // Can also reference a variable or function
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
                        // getConversionAndAjax();
                        // getTotalDonation();
                    });
                }
            }).render('#paypal-button-container');
    </script>

<div id="paypal-button-container" style="max-width: 50%;"></div>
    
@endsection
