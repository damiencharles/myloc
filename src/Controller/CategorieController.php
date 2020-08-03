<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Categorie;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("categorie/{id}", name="categorie")
     */
    public function show(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->find($id);
        $biens = $categorie->getBiensCategorie();
        $user = $this->getUser();

        return $this->render('categorie/categorie.html.twig', [
            'biens' => $biens,
            'categorie' => $categorie,
            'user' => $user
            
        ]);
    }

}
