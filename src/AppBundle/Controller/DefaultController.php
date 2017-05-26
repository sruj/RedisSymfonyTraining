<?php

namespace AppBundle\Controller;

use Predis\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
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

        $predisClient->set('mama','supernajnowszenowe');
        $mam=$predisClient->get('mama');



        return $this->render('@App/index.html.twig', [
            'mam'=>$mam,
            'mama'=>$mama??' nie ma '
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

        try {
            $predisClient = new Client();
        }
        catch (Exception $e){
            die($e->getMessage());
        }

        $mam=$predisClient->get('mama');


        return $this->render('@App/index.html.twig', [
            'mama'=>$val,
            'mam'=>$mam??' nie ma '
        ]);
    }

    /**
     *
     * @Route("/cache", name="cache")
     */
    public function queryCacheAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Product');

        $query = $repository->createQueryBuilder('p')
            ->where('p.id < :id')
            ->setParameter('id', '100')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->useQueryCache(true)    // here
            ->useResultCache(true);  // and here

        $products = $query->getResult();

        return $this->render('@App/cache.html.twig', [
            'products'=>$products,
        ]);
    }
}
