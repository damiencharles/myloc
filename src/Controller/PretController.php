<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Pret;
use App\Entity\User;
use App\Form\PretType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PretController extends AbstractController
{
    /**
     * @Route("profile/bien/{id}/pret", name="pret")
     */
    public function new($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $newPret = new Pret();
        

        $bien = $em->getRepository(Bien::class)->find($id);
        $proprio = $bien->getproprietaire();
        $prets = $bien->getPretBien();

        foreach ($prets as $pret){
            $dateDebutPret = $pret->getDateDebut();
            $dateFinPret= $pret->getDateFin();
        }
       
        $newPret->setBienPret($bien);

        $date = $this->date = new \DateTime('now');
        $newPret->setDateDebut($date);
        $newPret->setDateFin($date);
        $newPret->setUser($user);
        $pointsResa = '50';
        
        $form = $this->createForm(PretType::class, $newPret);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
        $newPret = $form->getData();
        dump($newPret);
        
        $newPret->setPointsPret($pointsResa);
        
        $proprioPoints = $proprio->getPoints();  
        $proprio->setPoints($proprioPoints += $pointsResa); 
            
        $em = $this->getDoctrine()->getManager();
        
    
        $em->persist($newPret);
        $em->flush();
        $this->addFlash('success', 'Félicitations ! Votre réservation est validée');
        return $this->redirectToRoute('index');
        }
        

        return $this->render('pret/pret.html.twig', [
            'form' => $form->createView(),
            'bien' => $bien,
            'user' => $user,
            'dateDebut' => $dateDebutPret,
            'dateFin' => $dateFinPret
        ]);
    }

    
}
