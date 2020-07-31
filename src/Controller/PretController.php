<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Pret;
use App\Form\PretType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PretController extends AbstractController
{
    /**
     * @Route("/bien/{id}/pret", name="pret")
     */
    public function new($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $newPret = new Pret();
        $newPret->setUser($user);
        $bien = $em->getRepository(Bien::class)->find($id);
        $newPret->setBienPret($bien);
        
        $form = $this->createForm(PretType::class, $newPret);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
        $newPret = $form->getData();
    
        $em = $this->getDoctrine()->getManager();
        $em->persist($newPret);
        $em->flush();

        }

        return $this->render('pret/pret.html.twig', [
            'form' => $form->createView(),
            'bien' => $bien
        ]);
    }

    
}
