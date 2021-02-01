<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="dados-cartao.php" method="post" id="paymentForm">
        <h3>Detalhe do comprador</h3>
        <div>
            <div>
                <label for="email">E-mail</label>
                <input id="email" name="email" type="text" value="test@test.com" />
            </div>
            <div>
                <label for="docType">Tipo de documento</label>
                <select id="docType" name="docType" data-checkout="docType" type="text"></select>
            </div>
            <div>
                <label for="docNumber">Número do documento</label>
                <input id="docNumber" name="docNumber" data-checkout="docNumber" type="text" value="71929241054" />
            </div>
        </div>

        <div style="margin-top: 15px;">
            <input type="radio" name="paymentMethod" id="paymentMethodCard" value="card" onclick="showCardDetails()"> Cartão de crédito
            <input type="radio" name="paymentMethod" id="paymentMethodTicket" value="ticket" onclick="showCardDetails()"> Boleto
        </div>

        <div id="cardDetails" style="display: none;">
            <h3>Detalhes do cartão</h3>
            <div>
                <div>
                    <label for="cardholderName">Titular do cartão</label>
                    <input id="cardholderName" data-checkout="cardholderName" type="text" value="Valentina Benedita Martins">
                </div>
                <div>
                    <label for="">Data de vencimento</label>
                    <div>
                        <input type="text" placeholder="MM-11" id="cardExpirationMonth" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                        <span class="date-separator">/</span>
                        <input type="text" placeholder="YY-25" id="cardExpirationYear" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                    </div>
                </div>
                <div>
                    <label for="cardNumber">Número do cartão</label>
                    <input type="text" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off value="5031433215406351">
                    <div class="brand"></div>
                </div>
                <div>
                    <label for="securityCode">Código de segurança</label>
                    <input id="securityCode" data-checkout="securityCode" type="text" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off placeholder="123">
                </div>
                <div id="issuerInput">
                    <label for="issuer">Banco emissor</label>
                    <select id="issuer" name="issuer" data-checkout="issuer"></select>
                </div>
                <div>
                    <label for="installments">Parcelas</label>
                    <select type="text" id="installments" name="installments"></select>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <input type="checkbox" name="terms" id="terms" required>
            <label for="terms">Estou ciente que meus dados estão protegidos e que a empresa não reterá nenhum dado digitado.</label>
        </div>

        <div>
            <input type="hidden" name="transactionAmount" id="transactionAmount" value="100" />
            <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
            <input type="hidden" name="description" id="description" value="Descrição teste" />
            <br>
            <button type="submit">Pagar</button>
            <br>
        </div>
    </form>

    <a href="https://www.mercadopago.com.br/ajuda/Custos-de-parcelamento_322">Custos de parcelamento</a>

    <img src="https://imgmp.mlstatic.com/org-img/MLB/MP/BANNERS/tipo2_735X40.jpg?v=1" alt="Mercado Pago - Meios de pagamento" title="Mercado Pago - Meios de pagamento" width="735" height="40" />

    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
    <script src="https://www.mercadopago.com/v2/security.js" view="home"></script>
    <script src="mercadopagofunctions.js"></script>
</body>

</html>