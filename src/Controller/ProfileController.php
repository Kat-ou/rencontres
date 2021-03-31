<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Form\ProfileType;
use App\Repository\ProfilePictureRepository;
use App\Repository\ProfilRepository;
use App\Repository\SearchCriteriaRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
                           Request $request,
                           EntityManagerInterface $entityManager,
                           UserRepository $userRepository,
                           ProfilePictureRepository $profilePictureRepository,
                           ProfilRepository $profilRepository,
                           SearchCriteriaRepository $searchCriteriaRepository): Response
    {
        $profile = new Profil();
        $profileForm = $this->createForm(ProfileType::class, $profile);

        $profileForm->handleRequest($request);

        if ($profileForm->isValid() && $profileForm->isSubmitted()){

        }

        return $this->render('profile/profile.html.twig', [
            'userId' => $userId,
            'profileForm' => $profileForm->createView(),
        ]);
    }

}
