<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_form}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m210902_225737_create_request_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_form}}', [
            'id' => $this->primaryKey(),
            'requester' => $this->string(120),
            'office' => $this->string(60),
            'department' => $this->string(60),
            'cost_center' => $this->string(11),
            'company' => $this->string(60),
            'unit' => $this->string(60),
            'direct_responsible' => $this->string(120),
            'vacancy_office' => $this->string(120),
            'vacancy_quantity' => $this->integer(),
            'vacancy_salary' => $this->float(),
            'vacancy_variable' => $this->string(60),
            'vacancy_benefits' => $this->string(45),
            'vacancy_type' => $this->string(45),
            'vacancy_workload' => $this->string(45),
            'vacancy_motive' => $this->string(120),
            'vacancy_gender' => $this->string(45),
            'vacany_confidential' => $this->string(45),
            'vacancy_formation' => $this->string(60),
            'vacancy_activities' => $this->text(),
            'vacancy_requirements' => $this->text(),
            'requester_authorization' => $this->string(60),
            'director_authorization' => $this->string(60),
            'rh_authorization' => $this->string(60),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-request_form-created_by}}',
            '{{%request_form}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-request_form-created_by}}',
            '{{%request_form}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-request_form-updated_by}}',
            '{{%request_form}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-request_form-updated_by}}',
            '{{%request_form}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-request_form-created_by}}',
            '{{%request_form}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-request_form-created_by}}',
            '{{%request_form}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-request_form-updated_by}}',
            '{{%request_form}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-request_form-updated_by}}',
            '{{%request_form}}'
        );

        $this->dropTable('{{%request_form}}');
    }
}
