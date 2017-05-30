<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 18:08
 */

namespace AppBundle\Services\PaymentGateway;


use AppBundle\Model\Payment;

class PaymentValidator
{
    private $salt;

    public function __construct(string $salt)
    {
        $this->salt = $salt;
    }

    public function validate(Payment $payment)
    {
        if (null === $payment->getUserId()) {
            throw GatewayException::userIdNotSpecified($payment);
        }

        if (null !== $payment->getAmount()) {
            if((float) $payment->getAmount() < 0) {
                throw GatewayException::transactionAmountIsNegative($payment);
            }
        } else {
            throw GatewayException::amountNotSpecified($payment);
        }

        if (null !== $payment->getMd5()) {
            if ($payment->getMd5() !== md5((string)$payment->getUserId() . (string)$payment->getAmount() . $this->getSalt())) {
                throw GatewayException::transactionHashNotCorrect($payment);
            }
        } else {
            throw GatewayException::transactionHashNotSpecified($payment);
        }

        $payment->setValid(true);

        return $payment;
    }

    /**
     * @return string
     */
    protected function getSalt()
    {
        return $this->salt;
    }
}