<?php
declare(strict_types=1);


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;


class CrawlerController extends AbstractController
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @Route("/crawler", name="crawler")
     */
    public function findByEan(): array
    {
        $ean = 9788372297136;
        //$html = file_get_contents('https://www.empik.com/szukaj/produkt?q='.$ean);
        $search = $this->client->request('GET', sprintf('https://www.empik.com/szukaj/produkt?q=%s', $ean));

        //$response = $this->client->request('GET', 'https://www.empik.com/kolekcja-harry-potter-columbus-chris-cuaron-alfonso-newell-mike-yates-david,p1222736711,film-p');

        $searchCrawler = new Crawler($search->getBody()->getContents());
        $link = $searchCrawler->filter('div.search-list-item-hover div.productWrapper a.img')->attr('href');

        $response = $this->client->request('GET', sprintf('https://www.empik.com%s',$link));
        $crawler = new Crawler($response->getBody()->getContents());

        $title = $crawler->filterXpath('//meta[@property="og:title"]')->attr('content');

        $cover = $crawler->filter('h1.ta-product-title span.ta-product-carrier')->text();
        $cover = str_replace(array( '(', ')' ), '', $cover);

        $url = $crawler->filterXpath('//meta[@property="og:url"]')->attr('content');


       // $author = $crawler->filter('span.pDAuthorList')->text();
        $author = array_filter($crawler->filter('span.pDAuthorList')->children()->each(function (Crawler $crw, $i) {
            return $crw->text();
        }));
        for ($i = 0; $i < 1; $i++) {
            array($author);
        }



        $publisher = '';
        $serie = '';

        $category = array_filter($crawler->filter('ul[itemscope] li')->each(function (Crawler $node, $i) {
            return $node->text();
        }));
        for ($i = 0; $i < 1; $i++) {
            array_shift($category);
        }


        $value = array_filter($crawler->filter('tbody tr.ta-attribute-row td span')->each(function (Crawler $val, $i) {
            return $val->text();
        }));
        for ($i = 0; $i < 1; $i++) {
            array($value);
        }

        $attribute = array_filter($crawler->filter('tbody tr.ta-attribute-row')->each(function (Crawler $attr, $i) {
            return $attr->text();
            }));
            for ($i = 0; $i < 1; $i++) {
                array($attribute);
            }

       // $attributes = array($value=>$attribute);

        $data = [
            $title,
            $cover,
            $url,
            $author,
            $ean,
            $publisher,
            $serie,
            $category,
            $attribute,
        ];
        echo '<pre>';
        print_r($data);
        die;
        echo '</pre>';


//        $connect = mysqli_connect("localhost", "root", "", "zzz");
//        $messsage = '';
//        if(isset($_POST["add"]))
//        {
//            if(!empty($_POST["brand"]))
//            {
//                $sql = "
//                INSERT INTO brand (brand_name)
//                SELECT '".$_POST["brand"]."' FROM brand
//                WHERE NOT EXIST(
//                 SELECT brand_name FROM brand WHERE brand_name = '".$_POST["brand"]."'
//                ) LIMIT 1
//           ";
//                if(mysqli_query($connect, $sql))
//                {
//                    $insert_id = mysqli_insert_id($connect);
//                    if($insert_id != '')
//                    {
//                        header("location:data_already_inserted.php?inserted=1");
//                    }
//                    else
//                    {
//                        header("location:data_already_inserted.php?already=1");
//                    }
//                }
//            }
//            else
//            {
//                header("location:data_already_inserted.php?required=1");
//            }
//        }
//        if(isset($_GET["inserted"]))
//        {
//            $message = "Brand inserted";
//        }
//        if(isset($_GET["already"]))
//        {
//            $message = "Brand Already inserted";
//        }
//        if(isset($_GET["required"]))
//        {
//            $message = "Brand Name Required";
//        }
    }
}