<?php


namespace App\Tests\MainControllerTest;

/*
 * Here we make sure all categories pages work well
 */

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends WebTestCase
{
    /** @var AbstractDatabaseTool */
    protected $databaseTool;

    private $testClient;

    protected function setUp(): void
    {
        $this->testClient = static::createClient();

        $this->databasetool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }


    public function test_categories_pages_ok (){
        $categories = ["/articles", "/decouverte", "/recits", "/culture" ];

        foreach ($categories as $category){
            $this->testClient->request("GET", $category);
            $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        }
    }

    //Tested, via URL in dev mode
    public function test_page_not_found(){

        $crawler = $this->testClient->request('GET', "/pageIntrouvable");
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);



    }



}