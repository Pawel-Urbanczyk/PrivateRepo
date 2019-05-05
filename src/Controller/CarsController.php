<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarsType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CarsController extends AbstractController
{
    /**
     * @Route("/cars", name="cars")
     */
    public function index(CarRepository $carRepository)
    {

        return $this->render('cars/index.html.twig', [
            'controller_name' => 'CarsController',
            'cars'=>$carRepository->findAll(),
        ]);
    }

    /**
     * @Route("/newcar", name="new_car")
     */
    public function newcar(Request $request)
    {
        $car = new Car();
        $car_form = $this->createForm(CarsType::class, $car);
        $car_form->handleRequest($request);
        if($car_form->isSubmitted() && $car_form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();
        }

        return $this->render('cars/new.html.twig', [
            'car_form'=> $car_form->createView()
        ]);

    }
}
