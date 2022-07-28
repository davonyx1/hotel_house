<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
	/**
	 * @Route("/inscription", name="user_register", methods={"GET|POST"})
	 */
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
      $user = new User();

      $form = $this->createForm(RegisterFormType::class, $user)
        ->handleRequest($request);

      if( $form->isSubmitted() && $form->isValid()) {

        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());

        $user->setPassword($passwordHasher->hashPassword(
            $user, $user->getPassword()
        )
        );

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Vous vous êtes inscrit avec succès !');
		return $this->redirectToRoute('app_login');
      }  

      return $this->render("user/register.html.twig", [
          'form' => $form->createView()
      ]);
    }
    
    /**
     * @Route("/profile/mon-espace-perso", name="show_profile", methods={"GET"})
     */
    public function showProfile(EntityManagerInterface $entityManager): Response
    {
        return$this->render("user/show_profile.html.twig");
    }
}