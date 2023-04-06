<?php

namespace App\Controller;

use App\Repository\CommandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $livMethod, $payMethod
        ): Response {

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

        $command->setAdresse($connectedUser->getAdresse());
        
        $command->setModeLivraison($livMethod);

        $command->setModePaiement($payMethod);

        $commandsRepository->save($command, true);

        return $this->redirectToRoute('app_commands');
    }

    #[Route('/commandHistory', name: 'app_commandHistory')]
    public function commandHistory(CommandsRepository $rep): Response
    {
        $commands = $rep->findAll();
        return $this->render('commands/backCommands.html.twig', [
            'controller_name' => 'CommandsController',
            'commands' => $commands
        ]);
    }


    #[Route('/removeCommand/{idCommand}', name: 'app_removeCommand')]
    public function removeArticle($idCommand, CommandsRepository $commandRep)
    {
        $command = $commandRep->find($idCommand);
      
        if (!$command) {
            throw new \Exception('Article not found');
        }

        $commandRep->remove($command, true);

        return $this->redirectToRoute('app_commandHistory');
    }


    #[Route('/updateCommand/{idCommand}/{etatCommand}', name: 'app_updateCommand')]
    public function updateCommand($idCommand, $etatCommand, CommandsRepository $commandRep)
    {
        $command = $commandRep->find($idCommand);
      
        if (!$command) {
            throw new \Exception('Article not found');
        }

        $command->setEtatCommande($etatCommand);

        $commandRep->save($command, true);

        return $this->redirectToRoute('app_commandHistory');
    }
}
