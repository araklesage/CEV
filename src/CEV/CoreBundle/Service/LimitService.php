<?php

namespace CEV\CoreBundle\Service;



use Doctrine\ORM\EntityManager;


class LimitService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getLastArticles()
    {
        $articles = $this->em->getRepository('CEVNewsBundle:Article')->findBy(
            array(),
            array('date' =>'desc'),
            3,
            0
        );
        return $articles;
    }
}