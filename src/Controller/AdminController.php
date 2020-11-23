<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/users", name="admin_users")
     */
    public function adminUsers(): Response
    {
        try{
            $uc = $this->getUser()->getControl();
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository(User::class)->findBy([
                'control'   =>  0,
            ]);

            // echo "<pre>";
            // print_r($users);
            // echo "</pre>";
            // die();

            return $this->render('system/users.html.twig', [
                'users' => $users,
                'usercontrol' => $uc,
            ]);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
