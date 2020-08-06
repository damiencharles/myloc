<?php

namespace App\Controller;

use App\Entity\Bien;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $biens = $em->getRepository(Bien::class)->findAll();
        foreach ($biens as $bien){
            $categorie = $bien->getCategorie();
            $proprio = $bien->getProprietaire();
            //dump($categorie);
        }


        $user = $this->getUser();
        

        return $this->render('index/index.html.twig', [
            'biens' => $biens,
            'user' => $user,
            'categorie' =>$categorie,
            'proprio' => $proprio
        ]);
    }
}
