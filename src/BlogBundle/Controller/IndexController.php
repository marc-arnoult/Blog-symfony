<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Article;
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
        /*$article = new Article();
        $article
            ->setAuthor('marc')
            ->setContent('Lorem ipsum')
            ->setTitle('First article')
            ->setPublished(false);
        */
        $em = $this->getDoctrine()->getManager()->getRepository('BlogBundle:Article');
        $articleList = $em->find(1);
        dump($articleList);
        return $this->render('BlogBundle:Default:index.html.twig');
    }

    /**
     * @Route(
     *     "/article/{page}",
     *     name="article_list",
     *     defaults={"page": 1},
     *     requirements={"page": "\d+"})
     */
    public function listAction($page)
    {
        return new Response("Page n° {$page}");
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
