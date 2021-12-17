<?php


namespace App\Tests\PostsFormTest;


use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsFormTest extends WebTestCase
{
    /**
     *
     *
     * @var AbstractDatabaseTool
     */
    protected $databaseTool;

    private $testClient = null;

    protected function setUp(): void
    {
        //Etre connecté
        $this->testClient = static::createClient();

        $this->databaseTool = $this->databaseTool = $this->testClient->getContainer()
            ->get(DatabaseToolCollection::class)->get();

        $this->databaseTool->loadAliceFixture([__DIR__ . "/UserFixtures.yaml"]);
        $userRepo = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepo->findOneBy([
            'username' => 'user1'
        ]);

        $this->assertNotNull($testUser);
        $this->testClient->loginUser($testUser);

    }


    public function test_new_article_created()
    {
        // Request page new article
        $crawler = $this->testClient->request("GET", "/intgestionarticle/new");
        $this->assertResponseStatusCodeSame(200);
        //Submit form new article
        $form = $crawler->selectButton("Save")->form([
            "article[titre]" => "testunarticle",
            "article[preview]" => "testpreview",
            "article[contenu]" => "testcontenu",
            "article[image]" => "imgbg"

        ]);
        $this->testClient->submit($form);
        $this->testClient->followRedirect();

        //Check alert article created
        $this->assertSelectorExists("div", "Votre article a bien été créée ! ");

    }

    public function test_new_recit_created()
    {
        // Request page new article
        $crawler = $this->testClient->request("GET", "/intgestionrecit/new");
        $this->assertResponseStatusCodeSame(200);
        //Submit form new article
        $form = $crawler->selectButton("Save")->form([
            "recit[titre]" => "testunarticle",
            "recit[author]" => "MEEEEEE",
            "recit[description]" => "testpreview",
            "recit[content]" => "testcontenu",


        ]);
        $this->testClient->submit($form);
        $this->testClient->followRedirect();

        //Check alert article created
        $this->assertSelectorExists("div", "Votre récit a bien été créée !");

    }

    public function test_success_article_edited()
    {

        $this->databaseTool->loadAliceFixture([__DIR__ . '/PostFixtures.yaml'], true);


        $crawler = $this->testClient->request("GET", "/intgestionarticle/1/edit");
        $this->assertResponseStatusCodeSame(200);
        $form = $crawler->selectButton("Update")->form([
            "article[titre]" => "testunarticle",
            "article[preview]" => "testpreview",
            "article[contenu]" => "testcontenu",
            "article[image]" => "imgbg"
        ]);

        $this->testClient->submit($form);


        $this->testClient->followRedirect();
        $this->assertSelectorExists("h1", "Bienvenue dans votre interface de gestion");
        //  $this->assertSelectorExists("div", "Article modifié !");
    }


    public function test_success_recit_edited()
    {

        $this->databaseTool->loadAliceFixture([__DIR__ . '/PostFixtures.yaml'], true);


        $crawler = $this->testClient->request("GET", "/intgestionrecit/1/edit");;
        $form = $crawler->selectButton("Update")->form([
            "recit[titre]" => "testunarticle",
            "recit[author]" => "MEEEEEE",
            "recit[description]" => "testpreview",
            "recit[content]" => "testcontenu",
        ]);

        $this->testClient->submit($form);


        $this->testClient->followRedirect();

        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorExists("h1", "Bienvenue dans votre interface de gestion");
        /* $this->assertGreaterThan(
             0,
             $crawler->filter('div:contains("Récit modifié !")')->count()
         );*/
//        $this->assertSelectorExists("div", "Récit modifié !");
    }

    public function test_success_delete_article()
    {

        $this->databaseTool->loadAliceFixture([__DIR__ . "/PostFixtures.yaml"], true);

        $crawler = $this->testClient->request("GET", "/intgestionarticle/1/edit");
        $form = $crawler->selectButton("Supprimer")->form([]);

        $this->testClient->submit($form);
        $this->testClient->followRedirect();
        $this->assertResponseStatusCodeSame(200);

        $this->assertSelectorExists("h1", "Bienvenue dans votre interface de gestion");
    }

    public function test_success_delete_recit()
    {

        $this->databaseTool->loadAliceFixture([__DIR__ . "/PostFixtures.yaml"], true);

        $crawler = $this->testClient->request("GET", "/intgestionrecit/1/edit");
        $this->assertResponseStatusCodeSame(200);
        $form = $crawler->selectButton("Supprimer")->form([]);

        $this->testClient->submit($form);
        $this->testClient->followRedirect();
        $this->assertResponseStatusCodeSame(200);

        $this->assertSelectorExists("h1", "Bienvenue dans votre interface de gestion");


    }

}