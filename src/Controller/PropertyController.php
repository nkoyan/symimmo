<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("/biens", name="property_index")
     */
    public function index(PropertyRepository $propertyRepository)
    {
        $properties = $propertyRepository->findAllVisible();

        return $this->render('property/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/biens/{slug}", name="property_show")
     */
    public function show(Property $property)
    {
        return $this->render('property/show.html.twig', [
            'property' => $property
        ]);
    }
}