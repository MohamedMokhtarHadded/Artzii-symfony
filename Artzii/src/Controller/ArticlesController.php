<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;

class ArticlesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/articles', name: 'app_articles')]
    public function goToArticles(ArticleRepository $rep): Response
    {

        $articles = $rep->findAll();
        return $this->render('article/articles.html.twig', [
            'articles' => $articles,

        ]);
    }

    #[Route('/articlesArtiste/{idArtiste}', name: 'app_articlesArtiste')]
    public function goToArticlesArtiste($idArtiste, ArticleRepository $articleRep, UtilisateurRepository $userRep): Response
    {

        $articles = $articleRep->findBy(['idartiste' => $userRep->find($idArtiste)]);

        return $this->render('article/articlesArtiste.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/removeArticleArtiste/{idArticle}', name: 'app_removeArticleArtiste')]
    public function removeArticle($idArticle, ArticleRepository $articleRep)
    {
        $article = $articleRep->find($idArticle);
        $artiste = $article->getIdartiste()->getIdu();
        if (!$article) {
            throw new \Exception('Article not found');
        }

        $this->entityManager->remove($article);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_articlesArtiste', ['idArtiste' => $artiste]);
    }
}
