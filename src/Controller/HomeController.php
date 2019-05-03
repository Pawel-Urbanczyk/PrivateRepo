<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('fullname')
            ->add('age', IntegerType::class )
            ->add('Submit', SubmitType::class)
            ->getForm()
        ;

        $person = [
            'name'=>'Paweł',
            'lastname'=>'Urbańczyk',
            'age'=>29,

        ];

        //Store stuff in DB
        $post = new Post();
        $post->setTitle('Overpower');
        $post->setDescription('YouTube 4 life!');

        $em = $this->getDoctrine()->getManager();

        $retreivedPost = $em->getRepository(Post::class)->findOneBy([
            'id' => 4
        ]);


        //$em->persist($post);
        //$em->remove($retreivedPost);
        //$em->flush();

        return $this->render('home/greet.htm.twig',[
            'person'=> $person,
            'user_form'  => $form->createView(),
            'post'=>$retreivedPost
        ]);
    }
}
