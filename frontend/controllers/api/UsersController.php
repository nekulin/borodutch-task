<?php
namespace frontend\controllers\api;

use Yii;
use yii\rest\ActiveController;

class UsersController extends ActiveController {

    public $modelClass = 'common\models\User';
} 