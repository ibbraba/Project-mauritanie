<?php


namespace App\Tests\Article;


use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    private Article $article;

    protected function setUp(): void
        {

            $this->article = new Article();
        }

    public function test_get_titre(){
        $value = "nouveau titre";
        $response = $this->article->setTitre($value);
        $this->assertInstanceOf(Article::class, $response);
    }

    public function test_get_preview(){
        $value = "preview d'un article";
        $response = $this->article->setTitre($value);
        $this->assertInstanceOf(Article::class, $response);
    }

    public function test_get_contenu(){
        $value = "Contenu de l'article";
        $response = $this->article->setTitre($value);
        $this->assertInstanceOf(Article::class, $response);
    }

    public function test_get_image(){
        $value = "img.jpg";
        $response = $this->article->setTitre($value);
        $this->assertInstanceOf(Article::class, $response);
    }

    //Test Titre
    public function test_error_no_title(){
        $this->expectError();
        $this->article->setTitre(null);
    }

    public function test_error_invalid_title(){
        $this->expectError();
        $this->article->setTitre(array(6));
    }

    // Test Preview
    public function test_error_no_preview (){
        $this->expectError();
        $this->article->setPreview(null);
    }

    public function test_error_invalid_preview(){
        $this->expectError();
        $this->article->setPreview(new \DateTime());
    }

    //Test Content

    public function test_error_no_content(){
        $this->expectError();
        $this->article->setContenu(null);
    }

    public function test_error_invalid_content(){
        $this->expectError();
        $this->article->setContenu(array(5));
    }

}