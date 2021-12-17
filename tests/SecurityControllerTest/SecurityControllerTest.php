<?php


namespace App\Tests\SecurityControllerTest;


use App\DataFixtures\TestFixtures;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{

    /**
     *
     *
     * @var AbstractDatabaseTool
     */
    protected $databaseTool
    ;

    private $testClient = null;


    public function setUp(): void
    {
        $this->testClient = static::createClient();
        $this->databaseTool = $this->testClient->getContainer()
            ->get(DatabaseToolCollection::class)->get();
        //     $this->testClient->getContainer()->get(DatabaseToolCollection::class)->get();

        parent::setUp();

        // self::bootKernel();

        // $this->databaseTool = static::getContainer()->get(DatabaseTools\ORMDatabaseTool::class)->get();
    }

    public function test_redirect_to_login_if_not_loggedin(){

        $crawler = $this->testClient->request("GET", '/intgestion/main');
        $this->assertResponseRedirects("/login");
    }

    public function test_access_ok_with_good_credentials(){
        //Load User Fixtures
        $this->databaseTool->loadAliceFixture([__DIR__."/SecurityFixtures.yaml"]);
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy([
            'username' => 'user1'
        ]);


        $this->testClient->loginUser($testUser);

        //Request login page and connect
        $crawler = $this->testClient->request("GET", '/intgestion/main');
        $this->assertResponseStatusCodeSame(200);
      /*  $form= $crawler->selectButton("Se connecter")->form([
           'username' => 'user1',
           'password' => 'test'
        ]);
        $this->testClient->submit($form);
        $this->testClient->followRedirect();*/

        //Test if redirect to admin page
//       $this->assertSelectorTextNotContains("div", "Invalid credentials");
        $this->assertSelectorTextContains('h1' , 'Bienvenue dans votre interface de gestion');
    }


    public function test_access_denied_with_bad_credentials(){
        $this->databaseTool->loadAliceFixture([__DIR__."/SecurityFixtures.yaml"]);


        //Request login page and connect
        $crawler = $this->testClient->request("GET", '/login');

        $form =  $crawler->selectButton("Se connecter")->form([
            'username' => 'user1',
            'password' => "wrongpassword"
        ]);
        $this->testClient->submit($form);
        $this->testClient->followRedirect();

        //Test if redirect to admin page
        $this->assertSelectorTextContains("div", "Invalid credentials");

    }

    public function test_access_denied_with_bad_roles(){
        $this->databaseTool->loadAliceFixture([__DIR__."/SecurityFixtures.yaml"]);

        //Request login page and connect
        $crawler = $this->testClient->request("GET", '/login');
        $form =  $crawler->selectButton("Se connecter")->form([
            'username' => 'user2',
            'password' => "00000"
        ]);
        $this->testClient->submit($form);
        $this->testClient->followRedirect();

        //Test if redirect to admin page
        $this->assertSelectorTextContains("div", "Invalid credentials");

    }








}