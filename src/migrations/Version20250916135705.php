<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250916135705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assessment (id UUID NOT NULL, new_level_id UUID DEFAULT NULL, individual_development_plan_id UUID DEFAULT NULL, previous_level_id UUID DEFAULT NULL, assignee_id UUID DEFAULT NULL, next_assessment_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7523D7018D8C78B ON assessment (new_level_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7523D703F6725A6 ON assessment (individual_development_plan_id)');
        $this->addSql('CREATE INDEX IDX_F7523D70405A53A3 ON assessment (previous_level_id)');
        $this->addSql('CREATE INDEX IDX_F7523D7059EC7D60 ON assessment (assignee_id)');
        $this->addSql('COMMENT ON COLUMN assessment.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assessment.new_level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assessment.individual_development_plan_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assessment.previous_level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assessment.assignee_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assessment.next_assessment_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN assessment.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE assessment_topic (assessment_id UUID NOT NULL, topic_id UUID NOT NULL, PRIMARY KEY(assessment_id, topic_id))');
        $this->addSql('CREATE INDEX IDX_9464E10DDD3DD5F1 ON assessment_topic (assessment_id)');
        $this->addSql('CREATE INDEX IDX_9464E10D1F55203D ON assessment_topic (topic_id)');
        $this->addSql('COMMENT ON COLUMN assessment_topic.assessment_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN assessment_topic.topic_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE individual_development_plan (id UUID NOT NULL, recommendation VARCHAR(255) NOT NULL, result VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN individual_development_plan.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN individual_development_plan.recommendation IS \'(DC2Type:recommendation)\'');
        $this->addSql('COMMENT ON COLUMN individual_development_plan.result IS \'(DC2Type:result)\'');
        $this->addSql('CREATE TABLE level (id UUID NOT NULL, name VARCHAR(255) NOT NULL, weight INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN level.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN level.name IS \'(DC2Type:name)\'');
        $this->addSql('COMMENT ON COLUMN level.weight IS \'(DC2Type:weight)\'');
        $this->addSql('CREATE TABLE material (id UUID NOT NULL, topic_id UUID DEFAULT NULL, level_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(50000) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CBE75951F55203D ON material (topic_id)');
        $this->addSql('CREATE INDEX IDX_7CBE75955FB14BA7 ON material (level_id)');
        $this->addSql('COMMENT ON COLUMN material.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN material.topic_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN material.level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN material.name IS \'(DC2Type:name)\'');
        $this->addSql('COMMENT ON COLUMN material.content IS \'(DC2Type:content)\'');
        $this->addSql('CREATE TABLE material_user (material_id UUID NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(material_id, user_id))');
        $this->addSql('CREATE INDEX IDX_D9FBBB7CE308AC6F ON material_user (material_id)');
        $this->addSql('CREATE INDEX IDX_D9FBBB7CA76ED395 ON material_user (user_id)');
        $this->addSql('COMMENT ON COLUMN material_user.material_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN material_user.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE topic (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN topic.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN topic.name IS \'(DC2Type:name)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, level_id UUID DEFAULT NULL, email VARCHAR(180) NOT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE INDEX IDX_8D93D6495FB14BA7 ON "user" (level_id)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE assessment ADD CONSTRAINT FK_F7523D7018D8C78B FOREIGN KEY (new_level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assessment ADD CONSTRAINT FK_F7523D703F6725A6 FOREIGN KEY (individual_development_plan_id) REFERENCES individual_development_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assessment ADD CONSTRAINT FK_F7523D70405A53A3 FOREIGN KEY (previous_level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assessment ADD CONSTRAINT FK_F7523D7059EC7D60 FOREIGN KEY (assignee_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assessment_topic ADD CONSTRAINT FK_9464E10DDD3DD5F1 FOREIGN KEY (assessment_id) REFERENCES assessment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assessment_topic ADD CONSTRAINT FK_9464E10D1F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75951F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75955FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_user ADD CONSTRAINT FK_D9FBBB7CE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_user ADD CONSTRAINT FK_D9FBBB7CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6495FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assessment DROP CONSTRAINT FK_F7523D7018D8C78B');
        $this->addSql('ALTER TABLE assessment DROP CONSTRAINT FK_F7523D703F6725A6');
        $this->addSql('ALTER TABLE assessment DROP CONSTRAINT FK_F7523D70405A53A3');
        $this->addSql('ALTER TABLE assessment DROP CONSTRAINT FK_F7523D7059EC7D60');
        $this->addSql('ALTER TABLE assessment_topic DROP CONSTRAINT FK_9464E10DDD3DD5F1');
        $this->addSql('ALTER TABLE assessment_topic DROP CONSTRAINT FK_9464E10D1F55203D');
        $this->addSql('ALTER TABLE material DROP CONSTRAINT FK_7CBE75951F55203D');
        $this->addSql('ALTER TABLE material DROP CONSTRAINT FK_7CBE75955FB14BA7');
        $this->addSql('ALTER TABLE material_user DROP CONSTRAINT FK_D9FBBB7CE308AC6F');
        $this->addSql('ALTER TABLE material_user DROP CONSTRAINT FK_D9FBBB7CA76ED395');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6495FB14BA7');
        $this->addSql('DROP TABLE assessment');
        $this->addSql('DROP TABLE assessment_topic');
        $this->addSql('DROP TABLE individual_development_plan');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE material_user');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE "user"');
    }
}
