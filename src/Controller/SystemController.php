<?php

namespace App\Controller;

use App\Entity\Airplane;
use App\Entity\City;
use App\Entity\Ripd;
use App\Entity\Voo;
use App\Form\AirplaneType;
use App\Form\CityType;
use App\Form\VooType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/system")
 */
class SystemController extends AbstractController
{
    /**
     * @Route("/", name="system")
     */
    public function index(): Response
    {
        try{
            $uc = $this->getUser()->getControl();

            return $this->render('system/index.html.twig', [
                'usercontrol' => $uc,
            ]);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/city", name="system_city")
     */
    public function systemCity(Request $request): Response
    {
        try{
            $uc = $this->getUser()->getControl();
            $em = $this->getDoctrine()->getManager();
            $cities = $em->getRepository(City::class)->findAll();

            $city = new City();
            $form = $this->createForm(CityType::class, $city);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $city->setName($form->get('name')->getData());
                $city->setCreatedAt(new \DateTime('now'));
                $city->setModifiedAt(new \DateTime('now'));

                $ripd = new Ripd();
                $ripd->setControl($this->getUser()->getControl());
                $ripd->setOperator($this->getUser()->getId());
                $ripd->setReason('Razão do relatório');
                $ripd->setCreatedAt(new \DateTime('now'));

                $em->persist($ripd);

                $em->persist($city);
                $em->flush();
    
                return $this->redirectToRoute('system_city');
            }

            return $this->render('system/city.html.twig', [
                'usercontrol' => $uc,
                'cities'    => $cities,
                'newCityForm' => $form->createView(),
            ]);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/city/update", name="system_city_update")
     */
    public function systemCityUpdate(Request $request): Response
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $city = $em->getRepository(City::class)->find($request->get('editCityId'));

            $city->setName($request->get('editCityName'));
            $city->setModifiedAt(new \DateTime('now'));

            $ripd = new Ripd();
            $ripd->setControl($this->getUser()->getControl());
            $ripd->setOperator($this->getUser()->getId());
            $ripd->setReason('Razão do relatório');
            $ripd->setCreatedAt(new \DateTime('now'));

            $em->persist($ripd);

            $em->flush();
    
            return $this->redirectToRoute('system_city');
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/city/remove/{id}", name="system_city_remove")
     */
    public function systemCityRemove($id): Response
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $city = $em->getRepository(City::class)->find($id);

            $ripd = new Ripd();
            $ripd->setControl($this->getUser()->getControl());
            $ripd->setOperator($this->getUser()->getId());
            $ripd->setReason('Razão do relatório');
            $ripd->setCreatedAt(new \DateTime('now'));

            $em->persist($ripd);

            $em->remove($city);
            $em->flush();
    
            return $this->redirectToRoute('system_city');
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/airplane", name="system_airplane")
     */
    public function systemAirplane(Request $request): Response
    {
        try{
            $uc = $this->getUser()->getControl();
            $em = $this->getDoctrine()->getManager();
            $airplanes = $em->getRepository(Airplane::class)->findAllAirplanes();
            $cities = $em->getRepository(City::class)->findAll();

            $airplane = new Airplane();
            $form = $this->createForm(AirplaneType::class, $airplane);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $airplane->setName($form->get('name')->getData());
                $airplane->setLocal($request->get('newAirplaneCities'));
                $airplane->setIsValid(true);
                $airplane->setCreatedAt(new \DateTime('now'));
                $airplane->setModifiedAt(new \DateTime('now'));

                $ripd = new Ripd();
                $ripd->setControl($this->getUser()->getControl());
                $ripd->setOperator($this->getUser()->getId());
                $ripd->setReason('Razão do relatório');
                $ripd->setCreatedAt(new \DateTime('now'));

                $em->persist($ripd);

                $em->persist($airplane);
                $em->flush();
    
                return $this->redirectToRoute('system_airplane');
            }

            return $this->render('system/airplane.html.twig', [
                'usercontrol' => $uc,
                'airplanes'    => $airplanes,
                'cities'    => $cities,
                'newAirplaneForm' => $form->createView(),
            ]);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/airplane/update", name="system_airplane_update")
     */
    public function systemAirplaneUpdate(Request $request): Response
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $airplane = $em->getRepository(Airplane::class)->find($request->get('editAirplaneId'));

            $airplane->setName($request->get('editAirplaneName'));
            $airplane->setLocal($request->get('editAirplaneCities'));
            $airplane->setModifiedAt(new \DateTime('now'));

            $ripd = new Ripd();
            $ripd->setControl($this->getUser()->getControl());
            $ripd->setOperator($this->getUser()->getId());
            $ripd->setReason('Razão do relatório');
            $ripd->setCreatedAt(new \DateTime('now'));

            $em->persist($ripd);

            $em->flush();
    
            return $this->redirectToRoute('system_airplane');
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/airplane/remove/{id}", name="system_airplane_remove")
     */
    public function systemAirplaneRemove($id): Response
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $airplane = $em->getRepository(Airplane::class)->find($id);

            $ripd = new Ripd();
            $ripd->setControl($this->getUser()->getControl());
            $ripd->setOperator($this->getUser()->getId());
            $ripd->setReason('Razão do relatório');
            $ripd->setCreatedAt(new \DateTime('now'));

            $em->persist($ripd);

            $em->remove($airplane);
            $em->flush();
    
            return $this->redirectToRoute('system_airplane');
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/voo", name="system_voo")
     */
    public function systemVoo(Request $request): Response
    {
        try{
            $uc = $this->getUser()->getControl();
            $em = $this->getDoctrine()->getManager();
            $cities = $em->getRepository(City::class)->findAll();
            $voos = $em->getRepository(Voo::class)->findAll();

            $voo = new Voo();
            $form = $this->createForm(VooType::class, $voo);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $airplane = $em->getRepository(Airplane::class)->find($request->get('newVooAirplane'));

                $voo->setCityFrom($request->get('newVooCityFrom'));
                $voo->setCityTo($request->get('newVooCityTo'));
                $voo->setAirplane($request->get('newVooAirplane'));
                $voo->setDeparture($form->get('departure')->getData());
                $voo->setTime($form->get('time')->getData());
                $voo->setStatus(true);
                $voo->setCreatedAt(new \DateTime('now'));
                $voo->setModifiedAt(new \DateTime('now'));

                $airplane->setIsValid(false);

                $ripd = new Ripd();
                $ripd->setControl($this->getUser()->getControl());
                $ripd->setOperator($this->getUser()->getId());
                $ripd->setReason('Razão do relatório');
                $ripd->setCreatedAt(new \DateTime('now'));

                $em->persist($ripd);

                $em->persist($airplane);
                $em->persist($voo);
                $em->flush();
    
                return $this->redirectToRoute('system_voo');
            }

            return $this->render('system/voo.html.twig', [
                'usercontrol' => $uc,
                'cities'    => $cities,
                'voos'      => $voos,
                'newVooForm' => $form->createView(),
            ]);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/city/search/{local}", name="system_city_search")
     */
    public function citySearchLocalTo($local, SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();

        $cityto = $em->getRepository(City::class)->findCityTo($local);
        
        $serializedLocal = $serializer->serialize($cityto,'json');

        return JsonResponse::fromJsonString($serializedLocal);
    }

    /**
     * @Route("/airplane/search/{local}", name="system_airplane_search")
     */
    public function airplaneSearchLocal($local, SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();

        $airplane = $em->getRepository(Airplane::class)->findValidAirplanes($local);
        
        $serializedAirplane = $serializer->serialize($airplane,'json');

        return JsonResponse::fromJsonString($serializedAirplane);
    }

    /**
     * @Route("/voo/finish/{id}/{airplane}/{local}", name="system_voo_finish")
     */
    public function systemVooFinish($id,$airplane,$local): Response
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $airplane = $em->getRepository(Airplane::class)->find($airplane);
            $voo = $em->getRepository(Voo::class)->find($id);

            $airplane->setIsValid(true);
            $airplane->setLocal($local);
            $voo->setStatus(false);

            $ripd = new Ripd();
            $ripd->setControl($this->getUser()->getControl());
            $ripd->setOperator($this->getUser()->getId());
            $ripd->setReason('Razão do relatório');
            $ripd->setCreatedAt(new \DateTime('now'));

            $em->persist($ripd);

            $em->flush();
    
            return $this->redirectToRoute('system_voo');
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * @Route("/voo/remove/{id}/{airplane}", name="system_voo_remove")
     */
    public function systemVooRemove($id,$airplane): Response
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $airplane = $em->getRepository(Airplane::class)->find($airplane);
            $voo = $em->getRepository(Voo::class)->find($id);

            $airplane->setIsValid(true);
            $voo->setStatus(false);

            $ripd = new Ripd();
            $ripd->setControl($this->getUser()->getControl());
            $ripd->setOperator($this->getUser()->getId());
            $ripd->setReason('Razão do relatório');
            $ripd->setCreatedAt(new \DateTime('now'));

            $em->persist($ripd);

            $em->remove($voo);
            $em->flush();
    
            return $this->redirectToRoute('system_voo');
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
