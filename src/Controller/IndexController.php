<?php

namespace App\Controller;

use App\Entity\Bien;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $biens = $em->getRepository(Bien ::class)->findAll();

        return $this->render('index/index.html.twig', [
            'biens' => $biens,
        ]);
    }
}
