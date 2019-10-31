<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Destinations;
use App\Repository\DestinationsRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Destinations $destinations = null)
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'destinations' => $destinations,
        ]);
    }
}
