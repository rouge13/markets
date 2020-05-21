<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200521090325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment_market (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, market_id INT NOT NULL, notice VARCHAR(255) NOT NULL, INDEX IDX_A1BFDDD9A76ED395 (user_id), INDEX IDX_A1BFDDD9622F3F37 (market_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE market (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, track VARCHAR(255) NOT NULL, pc INT NOT NULL, city VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, time_from INT NOT NULL, time_to INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE market_day (market_id INT NOT NULL, day_id INT NOT NULL, INDEX IDX_36ABCB33622F3F37 (market_id), INDEX IDX_36ABCB339C24126 (day_id), PRIMARY KEY(market_id, day_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE market_stand (market_id INT NOT NULL, stand_id INT NOT NULL, INDEX IDX_AF97A7C3622F3F37 (market_id), INDEX IDX_AF97A7C39734D487 (stand_id), PRIMARY KEY(market_id, stand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, link LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stand_type (stand_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_10CFCECA9734D487 (stand_id), INDEX IDX_10CFCECAC54C8C93 (type_id), PRIMARY KEY(stand_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, region VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_market ADD CONSTRAINT FK_A1BFDDD9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment_market ADD CONSTRAINT FK_A1BFDDD9622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
        $this->addSql('ALTER TABLE market_day ADD CONSTRAINT FK_36ABCB33622F3F37 FOREIGN KEY (market_id) REFERENCES market (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE market_day ADD CONSTRAINT FK_36ABCB339C24126 FOREIGN KEY (day_id) REFERENCES day (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE market_stand ADD CONSTRAINT FK_AF97A7C3622F3F37 FOREIGN KEY (market_id) REFERENCES market (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE market_stand ADD CONSTRAINT FK_AF97A7C39734D487 FOREIGN KEY (stand_id) REFERENCES stand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stand_type ADD CONSTRAINT FK_10CFCECA9734D487 FOREIGN KEY (stand_id) REFERENCES stand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stand_type ADD CONSTRAINT FK_10CFCECAC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE market_day DROP FOREIGN KEY FK_36ABCB339C24126');
        $this->addSql('ALTER TABLE comment_market DROP FOREIGN KEY FK_A1BFDDD9622F3F37');
        $this->addSql('ALTER TABLE market_day DROP FOREIGN KEY FK_36ABCB33622F3F37');
        $this->addSql('ALTER TABLE market_stand DROP FOREIGN KEY FK_AF97A7C3622F3F37');
        $this->addSql('ALTER TABLE market_stand DROP FOREIGN KEY FK_AF97A7C39734D487');
        $this->addSql('ALTER TABLE stand_type DROP FOREIGN KEY FK_10CFCECA9734D487');
        $this->addSql('ALTER TABLE stand_type DROP FOREIGN KEY FK_10CFCECAC54C8C93');
        $this->addSql('ALTER TABLE comment_market DROP FOREIGN KEY FK_A1BFDDD9A76ED395');
        $this->addSql('DROP TABLE comment_market');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE market');
        $this->addSql('DROP TABLE market_day');
        $this->addSql('DROP TABLE market_stand');
        $this->addSql('DROP TABLE stand');
        $this->addSql('DROP TABLE stand_type');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
