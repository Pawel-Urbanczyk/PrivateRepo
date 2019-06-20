<?php

namespace App\Controller;

use App\Entity\AllegroCSV;
use App\Form\AllegroType;
use function Couchbase\defaultDecoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AllegroController extends AbstractController
{
    /**
     * @Route("/allegro", name="allegro")
     */
    public function index()
    {
        return $this->render('allegro/index.html.twig', [
            'controller_name' => 'AllegroController',
        ]);
    }


    /**
     * @Route("/allegro/new", name="allegroNew")
     */
    public function newAllegro(Request $request)
    {
        $allegro = new AllegroCSV();
        $form = $this->createForm(AllegroType::class, $allegro);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $file = $request->files->get('post')['allegro'];

            $uploads_directory = $this->getParameter('uploads_directory');
            $allegro->setDirectory($uploads_directory);

            $file_name = md5(uniqid()) . '.' . $file->guessExtension();
            $allegro->setFileName($file_name);

            $file->move(
                $uploads_directory,
                $file_name
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($allegro);
            $em->flush();
            $this->addFlash(
                'info',
                'Added Successfull!!!'
            );
            return $this->redirectToRoute('allegro');
        }


        return $this->render('allegro/new.html.twig', [
            'allegro_form' => $form->createView()
        ]);
    }
}
