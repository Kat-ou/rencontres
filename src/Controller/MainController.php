<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("", name="main_")
 */
class MainController extends AbstractController
{

    /**
     * @Route ("/", name="home")
     */
    public function home()
    {
        return $this->render("main/home.html.twig");

    }

    /**
     * @Route ("/", name="home")
     */
    public function test()
    {
        return $this->render("main/test.html.twig");

    }
}