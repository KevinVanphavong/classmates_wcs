<?php

namespace App\Controller;

use App\Repository\WilderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WilderController extends AbstractController
{
    /**
     * @Route("/admin/index", name="admin_wilder_index")
     * @return Response
     */
    public function adminIndex(WilderRepository $wilderRepository): Response
    {
        return $this->render('admin/wilder.html.twig', [
            'wilders' => $wilderRepository->findAll()
        ]);
    }
}
