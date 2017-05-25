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
     * predis
     *
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

    /**
     * snc redis bundle - predis w symfony
     * https://github.com/snc/SncRedisBundle/blob/master/Resources/doc/index.md
     *
     * konfiguruje klienta w config.yml
     * klientad 'default' tworzę zwracając serwis 'snc_redis.default'
     *
     * @Route("/snc", name="snc")
     */
    public function redisAction(Request $request)
    {
        $redis = $this->get('snc_redis.default');
        $val = $redis->incr('foo:bar');

        return $this->render('@App/index.html.twig', [
            'mama'=>$val
        ]);
    }
}
