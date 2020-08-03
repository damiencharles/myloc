<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("profil/{id}", name="profile")
     */
    public function show(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $biensUser = $user->getBiensUser();

        return $this->render('profile/profile.html.twig', [
            'user' => $user,   
            'biens' => $biensUser         
        ]);
    }
}
