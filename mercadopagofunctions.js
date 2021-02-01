function showCardDetails() {
    if (document.getElementById("paymentMethodCard").checked == true) {
        document.querySelector("#cardDetails").style.display = 'block'
    } else if (document.getElementById("paymentMethodCard").checked == false) {
        document.querySelector("#cardDetails").style.display = 'none'
    }
}

(function (win, doc) {
    window.Mercadopago.setPublishableKey("YOUR_PUBLIC_KEY");
    window.Mercadopago.getIdentificationTypes();

    function cardBin(event) {
        let textLength = event.target.value.length

        if (textLength > 6) {
            let bin = event.target.value.substring(0, 6);
            window.Mercadopago.getPaymentMethod({
                "bin": bin
            }, setPaymentMethod);

            Mercadopago.getInstallments({
                "bin": bin,
                "amount": parseFloat(document.querySelector('#transactionAmount').value)
            }, setInstallments);
        }
    }

    if (doc.querySelector('#cardNumber')) {
        let cardNumber = doc.querySelector('#cardNumber')
        cardNumber.addEventListener('keyup', cardBin, false)
    }

    function setPaymentMethod(status, response) {
        if (status == 200) {
            const paymentMethodElement = doc.getElementById('paymentMethodId')
            paymentMethodElement.value = response[0].id
            doc.querySelector('.brand').innerHTML = "<img src='" + response[0].thumbnail.replace('http', 'https') + "' alt='Bandeira do cartão'>"
        } else {
            console.log(`payment method info error: ${JSON.stringify(response)}`);
        }
    }

    function setInstallments(status, response) {
        if (status == 200) {
            let label = response[0].payer_costs
            let installmentsSel = doc.querySelector('#installments')
            installmentsSel.options.length = 0

            label.map(function (elem, ind, obj) {
                let txtOpt = elem.recommended_message
                let valOpt = elem.installments

                installmentsSel.options[installmentsSel.options.length] = new Option(txtOpt, valOpt)
            })
        } else {
            console.log(response)
        }
    }
    
    function sendPayment(event) {
        event.preventDefault()
        window.Mercadopago.createToken(event.target, setCardTokenAndPay);
    }

    function setCardTokenAndPay(status, response) {
        if (status == 200 || status == 201) {
            let form = document.getElementById('paymentForm');
            let card = document.createElement('input');
            card.setAttribute('name', 'token');
            card.setAttribute('type', 'hidden');
            card.setAttribute('value', response.id);
            form.appendChild(card);
            doSubmit = true;
            form.submit();
        } else {
            errorCode(response.cause[0].code)
        }
    }

    if (doc.querySelector('#paymentForm')) {
        let formPay = doc.querySelector('#paymentForm')
        formPay.addEventListener('submit', sendPayment, false)
    }

    function errorCode(code) {
        if (code == '205') {
            alert('Digite o número do seu cartão.')
        } else if (code == '208') {
            alert('Escolha um mês.')
        } else if (code == '209') {
            alert('Escolha um ano.')
        } else if (code == '212') {
            alert('Informe seu documento.')
        } else if (code == '213') {
            alert('Informe seu documento.')
        } else if (code == '214') {
            alert('Informe seu documento.')
        } else if (code == '220') {
            alert('Informe seu banco emissor.')
        } else if (code == '221') {
            alert('Digite o nome e sobrenome.')
        } else if (code == '224') {
            alert('Digite o código de segurança.')
        } else if (code == 'E301') {
            alert('Há algo de errado com esse número. Digite novamente.')
        } else if (code == 'E302') {
            alert('Confira o código de segurança.')
        } else if (code == '316') {
            alert('Por favor, digite um nome válido.')
        } else if (code == '322') {
            alert('Confira seu documento.')
        } else if (code == '323') {
            alert('Confira seu documento.')
        } else if (code == '324') {
            alert('Confira seu documento.')
        } else if (code == '325') {
            alert('Confira a data.')
        } else if (code == '326') {
            alert('Confira a data.')
        } else if (code == '404') {
            alert('Método de pagamento não encontrado')
        } else if (code == 'default') {
            alert('Confira os dados.')
        }
    }
})(window, document)