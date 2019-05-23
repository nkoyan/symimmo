<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminPropertyController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_property_index")
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findAll();
        return $this->render('admin/property/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/admin/property/create", name="admin_property_new")
     */
    public function new(Request $request, ObjectManager $manager)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($property);
            $manager->flush();
            $this->addFlash('success', 'property.new.success');

            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin/property/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin_property_edit", methods={"GET", "POST"})
     */
    public function edit(Property $property, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $this->addFlash('success', 'property.edit.success');

            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin_property_delete", methods={"DELETE"})
     */
    public function delete(Property $property, Request $request, ObjectManager $manager)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->request->get('token'))) {
            $manager->remove($property);
            $manager->flush();
            $this->addFlash('success', 'property.delete.success');
        }

        return $this->redirectToRoute('admin_property_index');
    }
}