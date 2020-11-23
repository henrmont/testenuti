<?php

namespace App\Controller;

use App\Entity\Ripd;
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
           
            return $this->render('system/users.html.twig', [
                'users' => $users,
                'usercontrol' => $uc,
            ]);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/user/define/{id}", name="admin_user_define")
     */
    public function adminUserDefine($id): Response
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);

            $user->setControl($this->getUser()->getId());
            $user->setModifiedAt(new \DateTime('now'));

            $ripd = new Ripd();
            $ripd->setControl($user->getControl());
            $ripd->setOperator($user->getId());
            $ripd->setReason('Razão do relatório');
            $ripd->setCreatedAt(new \DateTime('now'));

            $em->persist($ripd);
            $em->flush();

            return $this->redirectToRoute('admin_users');
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

     /**
     * @Route("/ripd", name="admin_ripd")
     */
    public function adminRipd(): Response
    {
        try{
            $uc = $this->getUser()->getControl();
            $em = $this->getDoctrine()->getManager();
            $ripd = $em->getRepository(Ripd::class)->findBy([
                'control'   =>  $this->getUser()->getId(),
            ]);
           
            return $this->render('system/ripd.html.twig', [
                'ripd' => $ripd,
                'usercontrol' => $uc,
            ]);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
