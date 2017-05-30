<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 22:24
 */

namespace AppBundle\Services\PaymentGateway;


use AppBundle\Model\Payment;

class PaymentABuilder extends PaymentBuilder
{
    public function buildPaymentFromRequest()
    {
        $this->getLogger()->log('info', 'Payment A build from request', (array) $this->getRequestStack()->getCurrentRequest());

        $this->payment = new Payment(
            $this->getRequestStack()->getCurrentRequest()->get('a'),
            $this->getRequestStack()->getCurrentRequest()->get('b'),
            $this->getRequestStack()->getCurrentRequest()->get('md5')
            );
    }
}