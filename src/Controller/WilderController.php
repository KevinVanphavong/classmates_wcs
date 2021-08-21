<?php

namespace App\Controller;

use App\Entity\Wilder;
use App\Entity\WilderImage;
use App\Form\WilderType;
use App\Repository\WilderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/wilder")
 */
class WilderController extends AbstractController
{
    /**
     * @Route("/", name="wilder_index", methods={"GET"})
     */
    public function index(WilderRepository $wilderRepository): Response
    {
        return $this->render('wilder/index.html.twig', [
            'wilders' => $wilderRepository->findAll(),
        ]);
        // return $this->render('admin/wilder.html.twig', [
        //     'wilders' => $wilderRepository->findAll()
        // ]);
    }

    /**
     * @Route("/new", name="wilder_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wilder = new Wilder();
        $form = $this->createForm(WilderType::class, $wilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('wilderImage')->getData();

            if ($image) {
                // Générer un nouveau nom de fichier pour l'image
                $imageName = md5(uniqId()) . '.' . $image->guessExtension();

                // envoyer l'image sur le disque dans uploads
                $image->move($this->getParameter('wilder_images'), $imageName);

                // envoyer/stocker le nom de l'image en bdd pour appeler et afficher l'image plus tard
                $newImage = new WilderImage();
                $newImage->setName($imageName);
                $wilder->setWilderImage($newImage);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wilder);
            $entityManager->flush();

            return $this->redirectToRoute('wilder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wilder/new.html.twig', [
            'wilder' => $wilder,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="wilder_show", methods={"GET"})
     */
    public function show(Wilder $wilder): Response
    {
        return $this->render('wilder/show.html.twig', [
            'wilder' => $wilder,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wilder_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Wilder $wilder): Response
    {
        $form = $this->createForm(WilderType::class, $wilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('wilderImage')->getData();

            if ($image) {
                // Générer un nouveau nom de fichier pour l'image
                $imageName = md5(uniqId()) . '.' . $image->guessExtension();

                // envoyer l'image sur le disque dans uploads
                $image->move($this->getParameter('wilder_images'), $imageName);

                // envoyer/stocker le nom de l'image en bdd pour appeler et afficher l'image plus tard
                $newImage = new WilderImage();
                $newImage->setName($imageName);
                $wilder->setWilderImage($newImage);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wilder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wilder/edit.html.twig', [
            'wilder' => $wilder,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="wilder_delete", methods={"POST"})
     */
    public function delete(Request $request, Wilder $wilder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wilder->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wilder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wilder_index', [], Response::HTTP_SEE_OTHER);
    }
}