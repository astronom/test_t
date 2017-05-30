<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 22:33
 */

namespace AppBundle\Services\PaymentGateway;


use AppBundle\Model\Payment;

class PaymentBBuilder extends PaymentBuilder
{
    public function buildPaymentFromRequest()
    {
        $this->getLogger()->log('info', 'Payment B build from request', (array) $this->getRequestStack()->getCurrentRequest());

        $this->payment = new Payment(
            $this->getRequestStack()->getCurrentRequest()->get('x'),
            $this->getRequestStack()->getCurrentRequest()->get('y'),
            $this->getRequestStack()->getCurrentRequest()->get('md5')
        );
    }
}