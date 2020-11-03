<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
      * Require ROLE_ADMIN for only this controller method.
      *
      * @IsGranted("ROLE_USER")
      */
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('child.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
