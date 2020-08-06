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
        $user = $this->getUser();
        $profil = $em->getRepository(User::class)->find($id);
        $biensUser = $profil->getBiensUser();

        return $this->render('profile/profile.html.twig', [
            'profil' => $profil,   
            'biens' => $biensUser, 
            'user' => $user     
        ]);
    }
}
