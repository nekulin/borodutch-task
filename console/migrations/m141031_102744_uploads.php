<?php

use yii\db\Schema;
use yii\db\Migration;

class m141031_102744_uploads extends Migration
{
    public function up()
    {
        $strPath = yii\BaseYii::$app->basePath . '/../frontend/web/uploads';

        if (!is_dir($strPath)) {
            mkdir($strPath, 7777);
        }
    }

    public function down()
    {
        echo "m141031_102744_uploads cannot be reverted.\n";

        return false;
    }
}
