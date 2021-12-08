<?php


namespace App\Tests\Recits;


use App\Entity\Recit;
use Doctrine\DBAL\Exception;
use phpDocumentor\Reflection\Types\Self_;
use PHPUnit\Framework\TestCase;

class RecitTest extends TestCase
{
    private Recit $recit;


    protected function setUp(): void
    {

        $this->recit = new Recit();
    }

    public function test_get_recit_titre()
    {
        $value = "Nouveau titre";
        $response = $this->recit->setTitre($value);
        self::assertInstanceOf(Recit::class, $response);

    }

    public function test_get_description()
    {
        $value = "description du recit";
        $response = $this->recit->setDescription($value);
        $this->assertInstanceOf(Recit::class, $response);
    }


    public function test_get_content()
    {
        $value = "contenu du reecit";
        $response = $this->recit->setContent($value);
        self::assertInstanceOf(Recit::class, $response);
    }


    //Test Titre

    public function test_error_if_no_title()
    {
        $this->expectError();
        $this->recit->setTitre(null);
    }

    public function test_error_invalid_title()
    {
        $this->expectError();
        $this->recit->setTitre(array((5)));

    }

    //Test Description
/*    public function test_error_no_description()
    {
        $this->expectError();
        $this->recit->setDescription(null);
    }*/

    public function test_error_invalid_description()
    {
        $this->expectError();
        $this->recit->setDescription(new \DateTimeImmutable());

    }

    //Test Content
    public function test_error_no_content()
    {
        $this->expectError();
        $this->recit->setContent(null);
    }

    public function test_error_invalid_content(){
        $this->expectError();
        $this->recit->setContent(new \DateTime());
    }

}