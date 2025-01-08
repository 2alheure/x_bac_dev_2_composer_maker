<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController {
    #[Route('/articles', name: 'articles')]
    public function list(ArticleRepository $ar): Response {
        $articles = $ar->findAll();
        
        return $this->render('articles/list.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/articles/{id}', name: 'article_details')]
    public function details(Article $article): Response {
        return $this->render('articles/details.html.twig', [
            'article' => $article
        ]);
    }
}
