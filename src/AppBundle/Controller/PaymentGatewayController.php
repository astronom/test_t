<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 18:03
 */

namespace AppBundle\Controller;


use AppBundle\Services\PaymentGateway\GatewayException;
use AppBundle\Services\PaymentGateway\PaymentBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PaymentGatewayController extends Controller
{
    public function paymentAAction()
    {
        try {
            $this->get('monolog.logger.gateway')->log('info', 'Payment gateway provider A');

            /**
             * @var $builder PaymentBuilder
             */
            $builder = $this->get('app.services.payment_gateway.builder.payment_a');
            $builder->buildPaymentFromRequest();

            $payment = $this->get('app.services.payment_gateway.validator_a')
                ->validate($builder->getPayment());

            $this->get('app.services.payment_gateway.gateway')->acceptPayment($payment);

        } catch (GatewayException $e) {
            $this->get('monolog.logger.gateway')->log('error', $e->getMessage(), (array) $e->getPayment());
            return $this->paymentAResponse(0);
        } catch (\Exception $e) {
            $this->get('monolog.logger.gateway')->log('error', $e->getMessage());
            return $this->paymentAResponse(0);
        }

        return $this->paymentAResponse(1);
    }

    public function paymentBAction()
    {
        try {
            $this->get('monolog.logger.gateway')->log('info', 'Payment gateway provider B');

            /**
             * @var $builder PaymentBuilder
             */
            $builder = $this->get('app.services.payment_gateway.builder.payment_b');
            $builder->buildPaymentFromRequest();

            $payment = $this->get('app.services.payment_gateway.validator_b')
                ->validate($builder->getPayment());

            $this->get('app.services.payment_gateway.gateway')->acceptPayment($payment);

        } catch (GatewayException $e) {
            $this->get('monolog.logger.gateway')->log('error', $e->getMessage(), (array) $e->getPayment());
            return $this->paymentBResponse('ERROR');
        } catch (\Exception $e) {
            $this->get('monolog.logger.gateway')->log('error', $e->getMessage());
            return $this->paymentBResponse('ERROR');
        }

        return $this->paymentBResponse('OK');
    }

    protected function paymentAResponse($code)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<answer>'.$code.'</answer>';

        $response = new Response($xml);
        $response->headers->set('Content-Type', 'xml');

        return $response;
    }

    protected function paymentBResponse($code)
    {
        $response = new Response($code);
        $response->headers->set('Content-Type', 'plain/text');

        return $response;
    }

}