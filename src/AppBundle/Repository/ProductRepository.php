<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use function Symfony\Component\VarDumper\Tests\Caster\reflectionParameterFixture;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for blog post information.
 *
 * See https://symfony.com/doc/current/book/doctrine.html#custom-repository-classes
 */
class ProductRepository extends EntityRepository
{
    public function findFromCache()
    {

}

}