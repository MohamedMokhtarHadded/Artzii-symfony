<?php

namespace App\Controller;

use App\Repository\CommandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\UtilisateurRepository;
use App\Service\BasketService;
use App\Entity\Commands;


class CommandsController extends AbstractController
{
    #[Route('/command', name: 'app_commands')]
    public function index(BasketService $basketService, UtilisateurRepository $userRep): Response
    {
        $connectedUser = $userRep->find(32);
        $basketData = $basketService->getCartItems(32);

        $totalPrice = array_reduce($basketData, function ($total, $product) {
            return $total + $product->getIdArticle()->getArtprix();
        }, 0);

        return $this->render('commands/command.html.twig', [
            'controller_name' => 'CommandsController',
            'basketData' => $basketData,
            'totalPrice' => $totalPrice,
            'connectedUser' => $connectedUser
        ]);
    }

    #[Route('/confirmCommand/{livMethod}/{payMethod}/{adress}', name: 'app_confirmCommand')]
    public function ajoutCommand(
        CommandsRepository $commandsRepository,
        UtilisateurRepository $userRep,
        BasketService $basketService,
        $livMethod, $payMethod, $adress
    ): Response {
        // dd ($livMethod);

        $connectedUser = $userRep->find(32);

        $command = new Commands();
        $command->setDateCommande(new \DateTime());
        $command->setIdClient($connectedUser);
        $command->setEtatCommande('En Attente');

        $basketData = $basketService->getCartItems(32);

        $totalPrice = array_reduce($basketData, function ($total, $product) {
            return $total + $product->getIdArticle()->getArtprix();
        }, 0);
        $command->setCoutTotale($totalPrice + 8);

        $command->setAdresse($adress);
        
        $command->setModeLivraison($livMethod);

        $command->setModePaiement($payMethod);

        $commandsRepository->save($command, true);

        return $this->redirectToRoute('app_commands');
    }
}
