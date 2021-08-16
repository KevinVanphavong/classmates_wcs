<?php

namespace App\Controller;

use App\Repository\WilderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/newRandomWilfers", name="newRandomWilfers")
     * @return Response
     */
    public function getNewRandomWilders(WilderRepository $wilderRepository, Request $request): ?Response
    {
        $wilders = $wilderRepository->findAll();
        $rand_keys = array_rand($wilders, 3);

        if ($request->attributes->get('_route') == "newRandomWilfers") {
            $arrayNewWilders = [];
            $newWilders = $wilderRepository->getThreeRandomWilders($rand_keys);

            foreach ($newWilders as $newWilder) {
                $arrayNewWilders[] = [
                    'firstname' => $newWilder->getFirstname(),
                    'lastname' => $newWilder->getLastname(),
                    'birthDate' => $newWilder->getBirthDate()->format('Y-m-d'),
                    'informations' => $newWilder->getInformations()
                ];
            }
            
            return new JsonResponse($arrayNewWilders);
        } else {
            return $wilderRepository->getThreeRandomWilders($rand_keys);
        }
    }
}