<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 17:40
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{

    public function indexAction(Request $request)
    {
        $userTransactions = [];

        if (null !== ($name = $request->get('name'))) {
            $userTransactions = $this->get('doctrine')
                ->getManager()->getRepository('AppBundle:UserTransaction')
                ->searchByUserName($name);
        }

        return $this->render('AppBundle:default:index.html.twig', [
            'userTransactions' => $userTransactions,
            'name' => $name
        ]);
    }
}