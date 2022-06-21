                        <form action="" method="POST">
                            <!-- Card bagian 1 -->
                            <div class="animate_animated card mx-auto " id="donationCard">
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- Banner JOIN #SANDHELP -->
                                    <div class="text-center" style="transform: scale(1.6);">
                                        <img src="/Images/banner.png" style="margin-top: -15px;margin-bottom:-15px"
                                            width="100%" alt="test">
                                    </div>
                                    <!-- Banner JOIN #SANDHELP End -->

                                    <!-- KG Buttons -->
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <button class="" id="btnKgLeft" data-value=10
                                                onclick="setKg(this)">10kg</button>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <button class="" id="btnKgRight" data-value=20
                                                onclick="setKg(this)">20kg</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <button class="" id="btnKgLeft" data-value=100
                                                onclick="setKg(this)">100kg</button>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <button class="" id="btnKgRight" data-value=200
                                                onclick="setKg(this)">200kg</button>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- KG Buttons End -->

                                    <!-- Custom amount input -->
                                    <div class="text-center">
                                        <input type="number" id="amountDonation" onclick="resetColorButtons()"
                                            placeholder="Other amount" name="amountDonation">
                                    </div>
                                    <!-- Custom amount input end -->

                                    <!-- Error -->
                                    <div id="errorInputKgTab"></div>
                                    <!-- Error end -->

                                    <hr style="border: solid 2px #bc8033">
                                    <div class="text-center">
                                        <button id="btnSubmit" type="button" onclick="" style="width: 95%;;">
                                            Next
                                        </button>
                                    </div>
                                </div>
                                <!-- Card body end -->
                            </div>
                            <!-- Card bagian 1 end -->

                            <!-- Card bagian 2 -->
                            <div class="card mx-auto" id="donationCard2" style="display:none;">
                                <div class="card-body">
                                    <!-- Details text -->
                                    <h1 class="text-center"
                                        style="color:#dbbe8b ;text-shadow:1px 1px rgba(0, 0, 0, 0.521)">
                                        Details
                                    </h1>
                                    <!-- Details text end -->

                                    <hr>

                                    <!-- Input form 2 -->
                                    <label for="displayName" class="labelInputs">Name</label>
                                    <br>
                                    <input type="hidden" name="money_amount_rupiah" class="money_amount_rupiah">
                                    <input type="hidden" name="money_amount_dollar" class="money_amount_dollar">
                                    <input type="text" id="displayName" class="inputDetails" required
                                        onclick="resetColorButtons()" placeholder="Name" name="amountDonation">
                                    <br>
                                    <label for="message" class="labelInputs">Message</label>
                                    <br>
                                    <input type="text" id="displayName" maxlength="40" class="inputDetails"
                                        onclick="resetColorButtons()" placeholder="Message for Indonesia's Beach"
                                        name="amountDonation">
                                    <br>
                                    <label for="total" class="labelInputs">Total</label>
                                    <br>
                                    <input type="text" id="total" class="inputDetails"
                                        onclick="resetColorButtons()" name="amountDonation" readonly value="Rp. ">
                                    <br>
                                    <label for="paymentOption " class="labelInputs">Choose payment method</label>
                                    <br>
                                    <div class="input-group">
                                        <select class="custom-select" id="paymentOption" required>
                                            <option selected>Choose payment..</option>
                                            <option value="1" style="font-weight: bold;">Paypal</option>
                                        </select>
                                    </div>
                                    <br>

                                    <div class="form-check form-switch">
                                        <label class="form-check-label" class="labelInputs" id="anonymousCheckbox">
                                            <input type="checkbox" class="form-check-input checkbox" value="">
                                            <div style="font-weight: bold;color:#d8b16f;">Send anonymously</div>
                                        </label>
                                    </div>

                                    <hr>
                                    {{-- <input type="submit" value="Pay" id="btnSubmit" style="width: 100%;"> --}}
                                    @guest
                                        <a href="{{ route('login_trial') }}" class="text-decoration-none text-white">
                                            <button type="button" value="" id="btnSubmit"
                                                style="width: 100%;">Pay</button>
                                        </a>
                                    @endguest
                                    @auth
                                        <div class="pepal">
                                            <div id="paypal-button-container" style="max-width: 100%;"></div>
                                        </div>
                                    @endauth
                                    <div class="text-center mt-3">
                                        <a onclick="" id="previousCard">Previous</a>
                                    </div>
                                    <!-- Input form 2 end -->
                                </div>
                            </div>
                        </form>

                        <script
                                                src="https://www.paypal.com/sdk/js?client-id=AWeEpkof-DJakIyEMwnJk8S00pRZvt6JBJSFvuG3ufOu24fLJQiXeQGxiKOwSdBSen6dkZmsgKeim2ZY&currency=USD">
                        </script>
                        {{ csrf_field() }}

                        <script>
                            $(document).ready(function() {
                                var final = 0;

                                paypal.Buttons({
                                    // Sets up the transaction when a payment button is clicked
                                    createOrder: (data, actions) => {
                                        return actions.order.create({
                                            purchase_units: [{
                                                amount: {
                                                    // value: '77.44' // Can also reference a variable or function
                                                    value: getTotalDonationDollar() // Can also reference a variable or function
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

                                $(document).on('click', '.pepal', function() {
                                    // getDollar();
                                    console.log('hi');
                                })

                                // $('#paypal-button-container').click(function() {

                                // });



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
                                    // let fromRate2 = currency.rates[resultFrom];
                                    // let toRate1 = currency.rates[resultTo];

                                    // console.log(fromRate);
                                    // console.log(toRate);

                                    var usd = getTotalDonationDollar();

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
                                    // console.log(final)
                                    return final;
                                }


                                function getTotalDonationDollar() {
                                    // alert(parseInt($('#test_payPal').val()));
                                    return $('.money_amount_dollar').val();
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
                                // getDollar();
                            });
                        </script>
