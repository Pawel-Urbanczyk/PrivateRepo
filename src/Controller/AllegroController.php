<?php

namespace App\Controller;

use App\Entity\AllegroCSV;
use App\Entity\Bonus;
use App\Form\AllegroType;
use App\Repository\AllegroCSVRepository;
use App\Repository\BonusRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\CharsetConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AllegroController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/allegro", name="allegro")
     */
    public function index(AllegroCSVRepository $allegroCSVRepository, BonusRepository $bonusRepository)
    {

        return $this->render('allegro/index.html.twig', [
            'controller_name' => 'AllegroController',
            'allegro'=>$allegroCSVRepository->findAll(),
            'bonusik'=>$bonusRepository->findAll()
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

            $info = pathinfo($_FILES['allegro']['name']['allegro']);

            if($info['extension'] == 'csv'){
                $file = $request->files->get('allegro')['allegro'];
                //$originalName = $_FILES['allegro']['name'];

                $uploads_directory = $this->getParameter('uploads_directory');
                $allegro->setDirectory($uploads_directory);

                $file_name = $_FILES['allegro']['name']['allegro'];
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

/////////////////////////////////////////
                $directory = 'D:\Programy\xampp\htdocs\symfony\practice/public/uploads/Allegro (1).csv.txt';


                $reader = Reader::createFromPath($uploads_directory.'/'.$file_name,'r');
                $reader->setHeaderOffset(2);
                //$result = $reader->fetchColumn();

                $input_bom = $reader->getInputBOM();
                if ($input_bom === Reader::BOM_UTF16_LE || $input_bom === Reader::BOM_UTF16_BE) {
                    CharsetConverter::addTo($reader, 'utf-16', 'utf-8');
                }

                $stmt = (new Statement())
                    ->offset(10)
                    ->limit(25);

                $result = $stmt->process($reader);
                echo"<pre>";
                var_dump($result);



                foreach ($reader as $row){
                    $bonus = (new Bonus())
                        ->setDzial($row[0])
                        ->setNazwa($row[1])
                        ->setEAN($row[2])
                        ->setCena($row[3])
                        ->setMinLiczbaSztuk($row[4])
                        ->setProwizja($row[5])
                        ->setPoprzedniaCena($row[6])
                        ->setPoprzedniaProwizja($row[7])
                        ->setKomentarzCena($row[8])
                        ->setKomentarzProwizja($row[9])
                    ;


                    $this->em->persist($bonus);
                }
                $this->em->flush();

///////////////////////////////////////


                return $this->redirectToRoute('allegro');
            }else{
                $this->addFlash(
                    'info',
                    'Wrong file extension, should be a .csv!!!'
                );
                return $this->redirectToRoute('allegro');
            }

        }


        return $this->render('allegro/new.html.twig', [
            'allegro_form' => $form->createView()
        ]);
    }
}
