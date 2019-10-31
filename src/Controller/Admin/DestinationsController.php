<?php

namespace App\Controller\Admin;

use App\Entity\Destinations;
use App\Entity\Photo;
use App\Form\DestinationsType;
use App\Repository\DestinationsRepository;
use App\Service\OpenStreet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/destinations")
 */
class DestinationsController extends AbstractController
{
    /**
     * @Route("/", name="destinations_index", methods={"GET"})
     */
    public function index(DestinationsRepository $destinationsRepository): Response
    {
        return $this->render('admin/destinations/index.html.twig', [
            'destinations' => $destinationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="destinations_new", methods={"GET","POST"})
     */
    public function new(Request $request, OpenStreet $openStreet): Response
    {
        $destination = new Destinations();
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tab = $openStreet->createConn($destination->getVille() . ', ' .$destination->getPays()->getNom());
            $latitude = $tab[0]['lat'];
            $longitude = $tab[0]['lon'];
            $destination->setLat($latitude);
            $destination->setLng($longitude);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('admin_destinations_index');
        }

        return $this->render('admin/destinations/new.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="destinations_show", methods={"GET"})
     */
    public function show(Destinations $destination): Response
    {
        return $this->render('admin/destinations/show.html.twig', [
            'destination' => $destination,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="destinations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Destinations $destination): Response
    {
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_destinations_index');
        }

        return $this->render('admin/destinations/edit.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="destinations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Destinations $destination): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destination->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($destination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_destinations_index');
    }
}
