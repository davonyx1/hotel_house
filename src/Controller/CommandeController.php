<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Commande;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="show_commande", methods={"GET|POST"})
     */
    public function showCommand(EntityManagerInterface $entityManager): Response
    {
        $commandes = $entityManager->getRepository(Commande::class)->findAll();
        return $this->render('commande/show_commande.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}
