<?php

use yii\db\Schema;
use yii\db\Migration;

class m141031_114700_status_reports extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%status_reports}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        try {
            $this->execute("ALTER TABLE `status_reports` ADD FOREIGN KEY (`user_id`) REFERENCES user (id);");
        } catch (\Exception $e) {}
    }

    public function down()
    {
        echo "m141031_114700_status_reports cannot be reverted.\n";
        $this->dropTable('{{%user}}');
        return false;
    }
}
