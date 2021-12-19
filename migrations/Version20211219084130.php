<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219084130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recit_tag (recit_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_56066EA235C669E7 (recit_id), INDEX IDX_56066EA2BAD26311 (tag_id), PRIMARY KEY(recit_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recit_tag ADD CONSTRAINT FK_56066EA235C669E7 FOREIGN KEY (recit_id) REFERENCES recit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recit_tag ADD CONSTRAINT FK_56066EA2BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article CHANGE contenu contenu MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE recit CHANGE content content MEDIUMTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recit_tag');
        $this->addSql('ALTER TABLE article CHANGE contenu contenu MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE recit CHANGE content content MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
