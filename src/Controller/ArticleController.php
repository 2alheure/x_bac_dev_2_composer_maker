<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController {
    #[Route('/articles', name: 'articles')]
    public function list(ArticleRepository $ar): Response {
        $articles = $ar->findAll();

        return $this->render('articles/list.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/articles/new', name: 'article_create')]
    public function new(EntityManagerInterface $em, Request $request): Response {
        $article = new Article;

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('articles');
        }

        return $this->render('articles/form.html.twig', [
            'formulaire' => $form,
            'action' => 'Ajouter',
        ]);
    }

    #[Route('/articles/{id}/update', name: 'article_update')]
    public function update(Article $article, EntityManagerInterface $em, Request $request): Response {

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('articles');
        }

        return $this->render('articles/form.html.twig', [
            'formulaire' => $form,
            'action' => 'Modifier',
        ]);
    }

    #[Route('/articles/{id}/remove', name: 'article_remove')]
    public function remove(Article $article, EntityManagerInterface $em): Response {
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('articles');
    }


    #[Route('/articles/{id}', name: 'article_details')]
    public function details(Article $article): Response {
        return $this->render('articles/details.html.twig', [
            'article' => $article
        ]);
    }
}
