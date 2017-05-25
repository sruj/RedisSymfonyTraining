<?php

namespace AppBundle\Controller;

use Predis\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        try {
            $predisClient = new Client();
        }
        catch (Exception $e){
            die($e->getMessage());
        }

        $predisClient->set('mama','mama1');
        $mam=$predisClient->get('mama');


        return $this->render('@App/index.html.twig', [
            'mama'=>$mam
        ]);
    }
}
