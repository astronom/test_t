<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 21:54
 */

namespace AppBundle\Services\PaymentGateway;


use AppBundle\Entity\User;
use AppBundle\Entity\UserTransaction;
use AppBundle\Model\Payment;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;

class Gateway
{
    private $em;
    private $logger;

    public function __construct(ObjectManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function acceptPayment(Payment $payment)
    {

        if (!$payment->isValid()) {
            throw GatewayException::paymentIsInvalid($payment);
        }

        /**
         * @var $user User
         */
        if (null !== $user = $this->em->getRepository('AppBundle:User')
                ->findOneBy(['id' => $payment->getUserId()])
        ) {

            $userTransaction = new UserTransaction();
            $userTransaction->setAmount($payment->getAmount());
            $userTransaction->setUser($user);

            $user->addTransaction($userTransaction);

            $this->em->persist($user);
            $this->em->flush();

            $this->logger->log('info', 'payment successful', (array) $payment);
        } else {
            throw GatewayException::userNotFound($payment);
        }
    }
}

