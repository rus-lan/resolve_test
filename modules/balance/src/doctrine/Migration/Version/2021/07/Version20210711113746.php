<?php

namespace Migration\Version;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * {@inheritdoc}
 */
final class Version20210711113746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function preUp(Schema $schema): void
    {
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');
    }

    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function preDown(Schema $schema): void
    {
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE TABLE balance_history (
          id INT AUTO_INCREMENT NOT NULL, 
          value DOUBLE PRECISION NOT NULL, 
          balance DOUBLE PRECISION NOT NULL, 
          user_id INT NOT NULL, 
          created_at DATETIME NOT NULL, 
          updated_at DATETIME NOT NULL, 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('DROP TABLE balance_history');
    }

    public function postUp(Schema $schema): void
    {
        // empty
    }

    public function postDown(Schema $schema): void
    {
        // empty
    }
}
