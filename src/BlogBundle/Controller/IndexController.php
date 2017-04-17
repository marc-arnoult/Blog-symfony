<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $number = mt_rand(1, 100);

        return $this->render('BlogBundle:Default:index.html.twig', [
            'number' => $number
        ]);
    }

    /**
     * @Route("/article/{slug}", name="article_page", requirements={"slug": "^[A-z]+$"})
     */
    public function showAction($slug)
    {
        if (!$slug) {
            throw $this->createNotFoundException('There is no slug... ');
        }
        return $this->render('BlogBundle:Article:article.html.twig', array('slug' => $slug));
    }
}
