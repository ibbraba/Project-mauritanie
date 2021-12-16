<?php


namespace App\Tests\MainControllerTest;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Component\HttpFoundation\Response;

class IndexPageTest extends WebTestCase
{
    /** @var AbstractDatabaseTool */
    protected $databaseTool;

    private $testClient;

    protected function setUp(): void
    {
        $this->testClient = static::createClient();
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_index_page_ok(){
        $crawler = $this->testClient->request("GET", '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

    }

    public function test_index_with_no_article(){


        $this->databaseTool->loadAliceFixture([__DIR__."/IndexEntityTest.yaml"]);
        $crawler = $this->testClient->request("GET", "/");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains("h1", 'Bienvenue sur Zone Mauritanienne');
    }

    public function test_index_with_no_recit(){


        $this->databaseTool->loadAliceFixture([__DIR__ . "/IndexnoRecit.yaml"]);
        $crawler = $this->testClient->request("GET", "/");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains("h1", 'Bienvenue sur Zone Mauritanienne');

    }




}