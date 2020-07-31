<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\NewBienType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewBienController extends AbstractController
{
    /**
     * @Route("profile/ajout", name="new_produit")
     */
    public function new(Request $request)
    {
        
        $user = $this->getUser();
        $newBien= new Bien ();
        $newBien->setproprietaire($user);

        $form = $this->createForm(NewBienType::class, $newBien);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
        $newBien = $form->getData();
    
        $em = $this->getDoctrine()->getManager();
        $em->persist($newBien);
        $em->flush();

        }

        return $this->render('new_bien/newBien.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
