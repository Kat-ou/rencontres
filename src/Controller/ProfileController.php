<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\ProfilePicture;
use App\Entity\SearchCriteria;
use App\Form\ProfileType;
use App\Form\ProfilPictureType;
use App\Form\RegistrationFormType;
use App\Form\SearchCriteriaType;
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

        $user = $this->getUser();
        $profileForm = $this->createForm(RegistrationFormType::class, $user);

        $loginForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid() ){

        }

        $profile = new Profil();
        $profileForm = $this->createForm(ProfileType::class, $profile);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid() ){

        }

        $profilePicture = new ProfilePicture();
        $profilePictureForm = $this->createForm(ProfilPictureType::class, $profilePicture);
        $profilePictureForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid() ){


        $searchCritera = new SearchCriteria();
        $searchCriteraForm = $this->createForm(SearchCriteriaType::class, $searchCritera);
        $searchCriteraForm->handleRequest($request);

        }
        if ($profileForm->isSubmitted() && $profileForm->isValid() ){

        }

        return $this->render('profile/profile.html.twig', [
            'userId' => $userId,
            'profileForm' => $profileForm->createView(),
            'profilePictureForm' => $profilePictureForm->createView(),
            'searchCriteraForm' => $searchCriteraForm->createView(),
        ]);
    }

    public function

}
