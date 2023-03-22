<?php
// src/Service/CartService.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Basket;

class BasketService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

     public function addToCart($userId, $articleId)
     {
         $panier = new Basket();
         $panier->setIdClient($userId);
         $panier->setIdArticle($articleId);
         $panier->setDateAjout(new \DateTime());

         $this->entityManager->persist($panier);
         $this->entityManager->flush();
     }

    // public function removeFromCart($userId, $articleId)
    // {
    //     $panier = $this->entityManager->getRepository(Panier::class)->findOneBy([
    //         'idUser' => $userId,
    //         'idArticle' => $articleId
    //     ]);

    //     if (!$panier) {
    //         throw new \Exception("Item not found in cart");
    //     }

    //     $this->entityManager->remove($panier);
    //     $this->entityManager->flush();
    // }

    public function getCartItems($userId)
    {
        $panier = $this->entityManager->getRepository(Basket::class)->findBy([
            'idClient' => $userId
        ]);

        return $panier;
    }
}
