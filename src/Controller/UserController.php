<?php

namespace App\Controller;

use DateTime;
use App\Entity\Bien;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("profile/moncompte", name="user")
     */
    public function show()
    {
        $user = $this->getUser();
        $biensUser = $user->getBiensUser();
        $pretsUser = $user->getPretUser();
        //$mesEmprunts = $emprunts->getBienPret();
        $datedujour = new DateTime();

        return $this->render('user/user.html.twig', [
            'user' => $user,
            'biensUser' => $biensUser,
            'pretsUser' => $pretsUser,
            'date' => $datedujour,
       ]);
    }


     /**
     * @Route("profile/delete/{id}", name="delete")
     * param int $id
     * @return Response
     */
    public function delete(Bien $bien):Response
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($bien);
        
        $em->flush();

        $this->addFlash('success', 'Annonce supprimée');

        return $this->redirectToRoute('index'); 
    }
}
