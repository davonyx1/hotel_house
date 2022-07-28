<?php

namespace App\Controller;

use App\Entity\Slider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SliderController extends AbstractController
{
    /**
     * @Route("/slider", name="show_slider", methods={"GET|POST"})
     */
    public function showSlider(EntityManagerInterface $entityManager): Response
    {
        $sliders = $entityManager->getRepository(SLider::class)->findAll();

        return $this->render('slider/show_slider.html.twig', [
            'sliders' => $sliders
        ]);
    }
}
