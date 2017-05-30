<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 22:00
 */

namespace AppBundle\Services\PaymentGateway;


use AppBundle\Model\Payment;
use Exception;

class GatewayException extends \Exception
{
    const USER_ID_NOT_SPECIFIED = 1;
    const AMOUNT_NOT_SPECIFIED = 2;
    const TRANSACTION_HASH_NOT_CORRECT = 3;
    const TRANSACTION_HASH_NOT_SPECIFIED = 4;
    const USER_NOT_FOUND = 5;
    const TRANSACTION_AMOUNT_IS_NEGATIVE = 7;
    const PAYMENT_IS_INVALID = 8;

    private $payment;

    public function __construct($message = "", $code = 0, Payment $payment, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->payment = $payment;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public static function userIdNotSpecified(Payment $payment)
    {
        return new GatewayException('USER_ID_NOT_SPECIFIED', self::USER_ID_NOT_SPECIFIED, $payment);
    }

    public static function amountNotSpecified(Payment $payment)
    {
        return new GatewayException('AMOUNT_NOT_SPECIFIED', self::AMOUNT_NOT_SPECIFIED, $payment);
    }

    public static function transactionHashNotCorrect(Payment $payment)
    {
        return new GatewayException('TRANSACTION_HASH_NOT_CORRECT', self::TRANSACTION_HASH_NOT_CORRECT, $payment);
    }

    public static function transactionHashNotSpecified(Payment $payment)
    {
        return new GatewayException('TRANSACTION_HASH_NOT_SPECIFIED', self::TRANSACTION_HASH_NOT_SPECIFIED, $payment);
    }

    public static function userNotFound(Payment $payment)
    {
        return new GatewayException('USER_NOT_FOUND', self::USER_NOT_FOUND, $payment);
    }

    public static function transactionAmountIsNegative(Payment $payment)
    {
        return new GatewayException('TRANSACTION_AMOUNT_IS_NEGATIVE', self::TRANSACTION_AMOUNT_IS_NEGATIVE, $payment);
    }

    public static function paymentIsInvalid(Payment $payment)
    {
        return new GatewayException('PAYMENT_IS_INVALID', self::PAYMENT_IS_INVALID, $payment);
    }
}
