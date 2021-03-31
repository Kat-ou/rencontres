<?php

namespace App\Controller;

use App\Repository\ProfilePictureRepository;
use App\Repository\ProfilRepository;
use App\Repository\SearchCriteriaRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/profile", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/update{userId}", name="update")
     */
    public function update($userId,
                           EntityManagerInterface $entityManager,
                           UserRepository $userRepository,
                           ProfilePictureRepository $profilePictureRepository,
                           ProfilRepository $profilRepository,
                           SearchCriteriaRepository $searchCriteriaRepository): Response
    {
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

}
