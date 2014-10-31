<?php

use yii\db\Schema;
use yii\db\Migration;

class m141031_093820_add_columns_user extends Migration
{
    public function up()
    {
        try {
            $this->execute("
            ALTER TABLE `user` ADD `surname` VARCHAR( 120 ) NULL COMMENT 'Фамилия' AFTER `username` ;
            ALTER TABLE `user` ADD `avatar` VARCHAR( 50 ) NULL COMMENT 'Аватарка' AFTER `surname` ;
            ");
        } catch (\Exception $e) {}
    }

    public function down()
    {
        echo "m141031_093820_add_columns_user cannot be reverted.\n";

        return false;
    }
}
