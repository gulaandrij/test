<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730163604 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE blog_post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE blog_post (
          id INT NOT NULL, 
          author_id INT DEFAULT NULL, 
          title VARCHAR(60) NOT NULL, 
          slug VARCHAR(300) NOT NULL, 
          content TEXT NOT NULL, 
          status VARCHAR(7) DEFAULT \'draft\' NOT NULL, 
          published_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA5AE01D989D9B62 ON blog_post (slug)');
        $this->addSql('CREATE INDEX IDX_BA5AE01DF675F31B ON blog_post (author_id)');
        $this->addSql('ALTER TABLE 
          blog_post 
        ADD 
          CONSTRAINT FK_BA5AE01DF675F31B FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD first_name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE users ADD last_name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE users ADD birth_day TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE blog_post_id_seq CASCADE');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('ALTER TABLE users DROP first_name');
        $this->addSql('ALTER TABLE users DROP last_name');
        $this->addSql('ALTER TABLE users DROP birth_day');
    }
}
