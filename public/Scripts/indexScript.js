
    //Animate Number Function
    function animateProgessNumber(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const currencyFractionDigits = new Intl.NumberFormat('de-DE', {
                style: 'currency',
                currency: 'IDR',
            }).resolvedOptions().maximumFractionDigits;
            obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString('en-US', {
                maximumFractionDigits: currencyFractionDigits
            });
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    obj = document.getElementById("currentProgress");
    console.log(obj.getAttribute("data-value"))
    animateProgessNumber(obj, 0, Number(obj.getAttribute("data-value")), 3500)
    // animateProgessNumber(obj, 0, Number(obj.getAttribute("data-value")), 60000)

    //Function Ganti background sesuai jam
    function changeBackground() {
        var now = new Date();
        hour = now.getHours();
        // hour = 15;
        // x = 1;
        if (hour >= 0 && hour <= 3) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_night.mp4");
        } else if (hour >= 4 && hour <= 7) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_dawn.mp4");
        } else if (hour >= 8 && hour <= 14) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_sunny.mp4");
        } else if (hour >= 15 && hour <= 17) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_dawn.mp4");
        } else if (hour >= 18 && hour <= 24) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_night.mp4");
        }
    }
    //changeBackground();


    // Set Kilograms choose
    var amount = null;
    var inputAmount = document.getElementById("amountDonation");
    var buttonBefore = null

    function setKg(btnChoose) {
        inputAmount.style.backgroundColor = "#fceee1";
        if (buttonBefore != null) {
            buttonBefore.style.backgroundColor = "#fceee1";
            buttonBefore.style.border = "0.5px solid #e9cea0";
            buttonBefore.style.color = "#e2ac4d"
        }
        buttonBefore = btnChoose;

        amount = btnChoose.getAttribute('data-value');
        btnChoose.style.backgroundColor = "#dcbe89";
        btnChoose.style.border = "0px solid black";
        btnChoose.style.color = "white";
        inputAmount.value = null;
    }

    //Reset warna button yang tidak dipilih
    function resetColorButtons() {
        buttonBefore.style.backgroundColor = "#fceee1";
        buttonBefore.style.border = "0.5px solid #e9cea0";
        buttonBefore.style.color = "#e2ac4d"
        inputAmount.style.border = "0.5px solid #e9cea0";
        inputAmount.style.backgroundColor = "#dcbe89";
        amount = null;
    }

    var buttonRecent = document.getElementById("switchInner1");
    var buttonMost = document.getElementById("switchInner2");

    //Switch functions
    function switchLeaderboardRecent() {

        buttonMost.style.boxShadow = "0px 0px";
        buttonMost.style.backgroundColor = "rgba(255, 255, 255, 0)";
        buttonRecent.style.boxShadow = "0px 0px 10px 5px rgba(0, 0, 0, 0.247)"
        buttonRecent.style.backgroundColor = "rgba(255, 255, 255, 1)";

    }

    function switchLeaderboardMost() {

        buttonRecent.style.boxShadow = "0px 0px";
        buttonRecent.style.backgroundColor = "rgba(255, 255, 255, 0)";
        buttonMost.style.boxShadow = "0px 0px 10px 5px rgba(0, 0, 0, 0.247)"
        buttonMost.style.backgroundColor = "rgba(255, 255, 255, 1)";

    }

    // includeHTML();

    //Ganti card
    $(document).ready(function() {
        $("#btnSubmit").click(function() {
            if (inputAmount.value != "") {
                amount = inputAmount.value;
            }
            if (amount != null && amount >= 1) {
                $("#donationCard").hide();
                $("#donationCard2").show();
                document.getElementById("donationCardLink").href = "#donationCard2";
                document.getElementById("donation-card-link-footer").href = "#donationCard2";
                var jumlahBayar = parseInt(amount) * 5000;
                getDollar();
                $('.money_amount_rupiah').val(jumlahBayar);
                const currencyFractionDigits = new Intl.NumberFormat('de-DE', {
                    style: 'currency',
                    currency: 'IDR',
                }).resolvedOptions().maximumFractionDigits;
                document.getElementById("total").value = "Rp. " + jumlahBayar.toLocaleString('en-US', {
                    maximumFractionDigits: currencyFractionDigits
                }) + ".00 (" + amount + " kg)";
            } else {
                var errorInputTab = document.getElementById("errorInputKgTab");
                errorInputTab.innerHTML = "Input your weight first or value must be 1 or more !";
            }

        });

        function getDollar() {
            const api = "https://api.exchangerate-api.com/v4/latest/USD";

            fetch(`${api}`).then(currency => {
                return currency.json()
            }).then(getDalla)
        }

        function getDalla(currency) {
            let resultFrom = 'IDR';
            let resultTo = 'USD';

            let fromRate = currency.rates[resultFrom];
            let toRate = currency.rates[resultTo];
            // let fromRate2 = currency.rates[resultFrom];
            // let toRate1 = currency.rates[resultTo];

            // console.log(fromRate);
            // console.log(toRate);

            var rupiah = parseInt(getTotalDonationRupiah());

            // alert('woohoo');

            var finalValue = ((toRate / fromRate) * rupiah).toFixed(2);

            // alert(finalValue);
            $('.money_amount_dollar').val(finalValue);
        }

        function getTotalDonationRupiah() {
            // alert(parseInt($('#test_payPal').val()));
            return $('.money_amount_rupiah').val();
        }
        $("#previousCard").click(function() {
            $("#donationCard2").hide();
            $("#donationCard").show();
            document.getElementById("donationCardLink").href = "#donationCard";
            document.getElementById("donation-card-link-footer").href = "#donationCard";
            inputAmount.value = "";
            buttonBefore.style.backgroundColor = "#fceee1";
            buttonBefore.style.border = "0.5px solid #e9cea0";
            buttonBefore.style.color = "#e2ac4d"
            amount = null;
            document.getElementById("errorInputKgTab").innerHTML = "";
        });
    });

    $(document).ready(function() {
        $(".container-full").click(function() {
            closeNav();
        });
    });