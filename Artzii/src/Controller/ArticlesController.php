<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BasketService;
use App\Entity\Basket;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function goToArticles(ArticlesRepository $rep, BasketService $basketService ): Response
    {

        $articles = $rep->findAll();
        return $this->render('article/articles.html.twig', [
            'articles' => $articles,

        ]);
    }

    #[Route('/addToBasket/{id}', name: 'app_addToBasket')]
    public function addToBasket($id, BasketService $basketService): Response
    {
        $basketService->addToCart(32, $id);
        return $this->redirectToRoute('app_articles');
    }


    #[Route('/article/ajouter', name: 'app_article_ajouter')]
    public function goToAjouterArticle(): Response
    {
        return $this->render('article/ajouter.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/article/modifier', name: 'app_article_modifier')]
    public function goToModifierArticle(): Response
    {
        return $this->render('article/modifier.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/article/supprimer', name: 'app_article_supprimer')]
    public function goToSupprimerArticle(): Response
    {
        return $this->render('article/supprimer.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

}
