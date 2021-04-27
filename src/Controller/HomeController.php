<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('', name: '')]
    public function index(): Response
    {
        return $this->render('log/base_user.html.twig', [
            'controller_name' => 'HomeController'
            //object.property
        ]);
    }

    #[Route('/home', name: '')]
    public function isConnected(): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController'
            //object.property
        ]);
    }
}
