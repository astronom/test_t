<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 22:22
 */

namespace AppBundle\Services\PaymentGateway;


use AppBundle\Model\Payment;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class PaymentBuilder
 * @package AppBundle\Services\PaymentGateway
 */
abstract class PaymentBuilder
{
    /**
     * @var Payment
     */
    protected $payment;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @return RequestStack
     */
    public function getRequestStack()
    {
        return $this->request;
    }

    /**
     * @param RequestStack $requestStack
     */
    public function setRequest(RequestStack $requestStack)
    {
        $this->request = $requestStack;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Payment
     */
    final public function getPayment()
    {
        return $this->payment;
    }

    /**
     * create payment
     */
    abstract public function buildPaymentFromRequest();
}