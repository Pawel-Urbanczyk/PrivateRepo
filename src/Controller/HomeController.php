<?php

namespace App\Controller;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HomeController
 * @package App\Controller
 * @Route("/home", name="home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/helloUser/{name}", name="hello_user", methods={"GET", "POST"})
     */
    public function helloUser(Request $request, $name)
    {
        //Request
        //$name = $request->get('name');

        //Form create FormBuilder and createForm
        $form = $this->createFormBuilder()
            ->add('fullname', TextType::class)
            ->getForm()
        ;

        $person = [
            'name'=>'Paweł',
            'lastname'=>'Urbańczyk',
            'age'=>29,

        ];
        return $this->render('home/greet.htm.twig',[
            'person'=> $person,
            'user_form'  => $form
        ]);
    }
}
