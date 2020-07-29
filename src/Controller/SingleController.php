<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Categorie;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SingleController extends AbstractController
{
    /**
     * @Route("/{id}", name="single")
     */
    public function show (int $id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $bien = $em->getRepository(Bien::class)->find($id);


        return $this->render('single/single.html.twig', [
            'bien' => $bien,
    
        ]);
    }
}
