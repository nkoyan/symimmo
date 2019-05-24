<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/picture")
 */
class AdminPictureController extends AbstractController
{
    /**
     * @Route("/delete/{id}", name="admin_picture_delete")
     */
    public function delete(Picture $picture, Request $request, ObjectManager $manager)
    {
        $data = json_decode($request->getContent(), true);
        $token = $data['_token'] ?? '';

        if ($request->isXmlHttpRequest() && $this->isCsrfTokenValid('delete' . $picture->getId(), $token)) {
            $manager->remove($picture);
            $manager->flush();

            return new JsonResponse(['success' => 1]);
        }

        return new JsonResponse(['error' => 'invalid token'], 400);
    }
}