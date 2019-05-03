<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form.whatever")
     */
    public function index(Request $request)
    {
        $post=new Post();

        $form = $this->createForm(PostType::class,$post,[
            'action'=>$this->generateUrl('form.whatever'),
            'method'=>'POST'
        ]);

        //handle the request
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //saving to db
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

        }

        return $this->render('form/index.html.twig', [
            'post_form' => $form->createView()
        ]);
    }

}
