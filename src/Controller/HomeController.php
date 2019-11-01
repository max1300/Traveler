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
    public function index(DestinationsRepository $destRepo)
    {
        $destinations = $destRepo->getDestinationsWithLatLng();
        $destinationsView = [];

        foreach($destinations as $destination){
            $destinationsView[] = [
                'lat' => $destination->getLat(),
                'lng' => $destination->getLng(),
                'ville' => $destination->getVille()
            ];
        }
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'destinationsJs' => $destinationsView,
        ]);
    }
}
