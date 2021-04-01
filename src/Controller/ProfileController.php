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
use claviska\SimpleImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\ByteString;

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

        $loginForm = $this->createForm(RegistrationFormType::class, $user);
        $loginForm->handleRequest($request);

        if ($loginForm->isSubmitted() && $loginForm->isValid()) {
            $entityManager->persist($user);

        }

        $profile = $user->getProfil();
        if ($profile == null) {
            $profile = $this->initProfile();
        }

        $profileForm = $this->createForm(ProfileType::class, $profile);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $profile->setDateUpdated(new \DateTime());
            $profile->setUser($this->getUser());
        }

            $profilePicture = new ProfilePicture();

        $profilePictureForm = $this->createForm(ProfilPictureType::class, $profilePicture);
        $profilePictureForm->handleRequest($request);

        if ($profilePictureForm->isSubmitted() && $profilePictureForm->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $profilePictureForm->get('pic')->getData();

            //génère un nom de fichier sécurisé de 30 caractères
            $newFileName = ByteString::fromRandom(30) . "." . $uploadedFile->guessExtension();

            //déplace le fichier dans mon répertoire public avant sa destruction
            //upload_dir est défini dans config/services.yaml
            $uploadedFile->move($this->getParameter('upload_dir'),$newFileName);

            //redimensionne l'image
            $simpleImage = new SimpleImage();
            $simpleImage->fromFile($this->getParameter('upload_dir')."/$newFileName")
                ->bestFit(300,300);

            //hydrate et sauvegarde les données de l'image
            $profilePicture->setFilename($newFileName);
            $profilePicture->setDateCreated(new \DateTime());

            // associe cette image à l'utilisateur connecté
            $profilePicture->setProfil($profile);

            $entityManager->persist($profilePicture);
            $entityManager->flush($profilePicture);
        }


        $searchCriteria = $profile->getUser()->getSearchCriteria();
        if ($searchCriteria == null) {
            $searchCriteria = new SearchCriteria();
        }

        $searchCriteriaForm = $this->createForm(SearchCriteriaType::class, $searchCriteria);
        $searchCriteriaForm->handleRequest($request);


        if ($searchCriteriaForm->isSubmitted() && $searchCriteriaForm->isValid()) {
            $searchCriteria->setUser($this->getUser());
        }

        $entityManager->flush();

        return $this->render('profile/profile.html.twig', [
            'userId' => $userId,
            'profileForm' => $profileForm->createView(),
            'profilePictureForm' => $profilePictureForm->createView(),
            'searchCriteriaForm' => $searchCriteriaForm->createView(),
        ]);
    }

    public function initProfile()
    {
        $newProfile = new Profil();
        $newProfile->setUser($this->getUser());
        $newProfile->setBirthDate(new \DateTime());
        $newProfile->setSex('M');
        $newProfile->setDateCreated(new \DateTime());
        $newProfile->setPostalCode('00000');
        $newProfile->setTown('Votre ville');

        return $newProfile;
    }

}
