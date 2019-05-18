<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(PropertyRepository $propertyRepository)
    {
        $properties = $propertyRepository->findLatest(4);

        return $this->render('home/index.html.twig', [
            'properties' => $properties
        ]);
    }
}