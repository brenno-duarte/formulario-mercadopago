<?php

require_once 'vendor/autoload.php';

$status;
$token = $_REQUEST["token"];
$payment_method_id = $_REQUEST["paymentMethodId"];
$installments = $_REQUEST["installments"];

$values_form = filter_input_array(INPUT_POST);

function status($msg, $payment_method_id, $statement_descriptor, $installments)
{
    $status = [
        'accredited' => 'Pronto, seu pagamento foi aprovado! No resumo, você verá a cobrança do valor como ' . $statement_descriptor,
        'pending_contingency' => 'Estamos processando o pagamento. Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado.',
        'pending_review_manual' => 'Estamos processando seu pagamento. Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado ou se necessitamos de mais informação.',
        'cc_rejected_bad_filled_card_number' => 'Revise o número do cartão.',
        'cc_rejected_bad_filled_date' => 'Revise a data de vencimento.',
        'cc_rejected_bad_filled_other' => 'Revise os dados.',
        'cc_rejected_bad_filled_security_code' => 'Revise o código de segurança do cartão.',
        'cc_rejected_blacklist' => 'Não pudemos processar seu pagamento.',
        'cc_rejected_call_for_authorize' => 'Você deve autorizar ao ' . $payment_method_id . ' o pagamento do valor ao Mercado Pago.',
        'cc_rejected_card_disabled' => 'Ligue para o(a) ' . $payment_method_id . ' para ativar seu cartão. O telefone está no verso do seu cartão.',
        'cc_rejected_card_error' => 'Não conseguimos processar seu pagamento.',
        'cc_rejected_duplicated_payment' => 'Você já efetuou um pagamento com esse valor. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento.',
        'cc_rejected_high_risk' => 'Escolha outra forma de pagamento. Recomendamos meios de pagamento em dinheiro.',
        'cc_rejected_insufficient_amount' => 'O(A) ' . $payment_method_id . ' possui saldo insuficiente.',
        'cc_rejected_invalid_installments' => 'O(A) ' . $payment_method_id . ' não processa pagamentos em ' . $installments . ' parcelas.',
        'cc_rejected_max_attempts' => 'Você atingiu o limite de tentativas permitido. Escolha outro cartão ou outra forma de pagamento.',
        'cc_rejected_other_reason' => 'O(A) ' . $payment_method_id . ' não processa o pagamento.'
    ];

    return $status[$msg];
}

MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN");

$payment = new MercadoPago\Payment();
$payment->transaction_amount = $values_form['transactionAmount'];
$payment->token = $token;
$payment->description = $values_form['description'];
$payment->installments = $values_form['installments'];
$payment->payment_method_id = $payment_method_id;
$payment->payer = array(
    "email" => $values_form['email']
);
$payment->save();

#echo '<pre>';
#print_r($payment);

if ($payment->error) {
    echo 'Houve um erro na requisição! Por favor tente novamente.';
    exit;
}

echo status($payment->status_detail, $payment->payment_method_id, $payment->statement_descriptor, $payment->installments);