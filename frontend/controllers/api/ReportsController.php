<?php
namespace frontend\controllers\api;

use common\models\StatusReports;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class ReportsController extends Controller {


    public function actionIndex($user_id=null)
    {
        $attrStatusReports = [];
        if (is_null($user_id)) {
            $attrStatusReports = StatusReports::find();
        } else {
            $objUser = new User();
            $objUser->id = $user_id;
            $attrStatusReports = StatusReports::find()->andWhere(['user_id'=>$user_id]);
        }
        return new ActiveDataProvider([
            'query' => $attrStatusReports,
        ]);
    }

} 