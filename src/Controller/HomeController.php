<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Services\Fetcher;
use App\Services\Paginator;
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
     * @Route("/newpost", name="new_post")
     */
    public function newpost(Request $request)
    {
        //Request
        //$name = $request->get('name');

        //URL: https://api.coinmarketcap.com/v2/listings/

        //Form create FormBuilder and createForm
//        $form = $this->createFormBuilder()
//            ->add('fullname')
//            ->add('age', IntegerType::class )
//            ->add('Submit', SubmitType::class)
//            ->getForm()
//        ;

//        $person = [
//            'name'=>'Paweł',
//            'lastname'=>'Urbańczyk',
//            'age'=>29,
//
//        ];

        //Store stuff in DB
//        $post = new Post();
//        $post->setTitle('Overpower');
//        $post->setDescription('YouTube 4 life!');
//
//        $em = $this->getDoctrine()->getManager();
//
//        $retreivedPost = $em->getRepository(Post::class)->findOneBy([
//            'id' => 5
//        ]);


        //$em->persist($post);
        //$em->remove($retreivedPost);
        //$em->flush();

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $image = '1e2aa7f1eb504116f47167c229e716db.jpeg';

        if($form->isSubmitted() && $form->isValid()){

            //File Uploading
            $file = $request->files->get('post')['my_file'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $file_name = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $uploads_directory,
                $file_name
            );


            $em = $this->getDoctrine()->getManager();

            $em->persist($post);
            $em->flush();
        }

        //Paginator Service
       // $result = $fetcher->get('https://api.coinmarketcap.com/v2/listings/');
       // $partialArray = $paginator->getPartial($result['data'], 100, 100);


        return $this->render('home/greet.htm.twig',[
            //'person'=> $person,
            'user_form'  => $form->createView(),
            'image'=>$image
            //'partial_array'=>$partialArray
            //'post'=>$retreivedPost
        ]);
    }

    /**
     * @Route("/showpost/{id}", name ="showpost")
     */
    public function showPost(Request $request, Post $post){

        return $this->render('home/show_post.html.twig', [
            'post'=>$post
        ]);
    }

    /**
     * @Route("/uploads", name="new_post")
     */
    public function uploads(Request $request)
    {
        //Request
        //$name = $request->get('name');

        //URL: https://api.coinmarketcap.com/v2/listings/

        //Form create FormBuilder and createForm
//        $form = $this->createFormBuilder()
//            ->add('fullname')
//            ->add('age', IntegerType::class )
//            ->add('Submit', SubmitType::class)
//            ->getForm()
//        ;

//        $person = [
//            'name'=>'Paweł',
//            'lastname'=>'Urbańczyk',
//            'age'=>29,
//
//        ];

        //Store stuff in DB
//        $post = new Post();
//        $post->setTitle('Overpower');
//        $post->setDescription('YouTube 4 life!');
//
//        $em = $this->getDoctrine()->getManager();
//
//        $retreivedPost = $em->getRepository(Post::class)->findOneBy([
//            'id' => 5
//        ]);


        //$em->persist($post);
        //$em->remove($retreivedPost);
        //$em->flush();

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $image = '1e2aa7f1eb504116f47167c229e716db.jpeg';

        if($form->isSubmitted() && $form->isValid()){

            $uploads_directory = $this->getParameter('uploads_directory');

            //File Uploading
            // get array of files
            $files = $request->files->get('post')['my_files'];

            //loop throught the files
            foreach ($files as $file){

                $file_name = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $uploads_directory,
                    $file_name
                );

            }

            //save to db
            $em = $this->getDoctrine()->getManager();

            $em->persist($post);
            $em->flush();
        }

        //Paginator Service
        // $result = $fetcher->get('https://api.coinmarketcap.com/v2/listings/');
        // $partialArray = $paginator->getPartial($result['data'], 100, 100);


        return $this->render('home/greet.htm.twig',[
            //'person'=> $person,
            'user_form'  => $form->createView(),
            'image'=>$image
            //'partial_array'=>$partialArray
            //'post'=>$retreivedPost
        ]);
    }
}
