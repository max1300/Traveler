<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/voyage")
 */
class VoyageController extends AbstractController
{
    /**
     * @Route("/", name="voyage_index", methods={"GET"})
     */
    public function index(VoyageRepository $voyageRepository): Response
    {
        return $this->render('admin/voyage/index.html.twig', [
            'voyages' => $voyageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voyage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);        

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['photos']->getData();
            if ($uploadedFile) {
                $entityManager = $this->getDoctrine()->getManager();

                foreach($uploadedFile as $upload){
                    $photo = new Photo();
                    $destination = $this->getParameter('kernel.project_dir').'/public/uploads/photos';
                    $originalFilename = pathinfo($upload->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $originalFilename.'-'.uniqid().'.'.$upload->guessExtension();
                    $upload->move(
                        $destination,
                        $newFilename
                    );
                    $photo->setNom($voyage->getNom());
                    $photo->setFilePath($newFilename);
                    $photo->setVoyage($voyage);
                    $entityManager->persist($photo);
                }
            }
            $entityManager->persist($voyage);
            
            $entityManager->flush();

            return $this->redirectToRoute('admin_voyage_index');
        }

        return $this->render('admin/voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_show", methods={"GET"})
     */
    public function show(Voyage $voyage): Response
    {
        

        return $this->render('admin/voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voyage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voyage $voyage): Response
    {
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['photos']->getData();
            if ($uploadedFile) {
                $entityManager = $this->getDoctrine()->getManager();

                foreach($uploadedFile as $upload){
                    $photo = new Photo();
                    $destination = $this->getParameter('kernel.project_dir').'/public/uploads/photos';
                    $originalFilename = pathinfo($upload->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $originalFilename.'-'.uniqid().'.'.$upload->guessExtension();
                    $upload->move(
                        $destination,
                        $newFilename
                    );
                    $photo->setNom($voyage->getNom());
                    $photo->setFilePath($newFilename);
                    $photo->setVoyage($voyage);
                    $entityManager->persist($photo);
                }
            }
            $entityManager->persist($voyage);
            
            $entityManager->flush();

            return $this->redirectToRoute('admin_voyage_index');
        }

        return $this->render('admin/voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Voyage $voyage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_voyage_index');
    }
}
