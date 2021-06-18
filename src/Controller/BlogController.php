<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Commentaire;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="Accueil")
     */
    public function Blog()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([], []);
        return $this->render('blog.html.twig', ['articles' => $articles,]);
    }
}
