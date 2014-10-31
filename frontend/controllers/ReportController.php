<?php
namespace frontend\controllers;


use common\models\StatusReports;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ReportController extends Controller {
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new StatusReports();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->created_at = time();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Статус успешно опубликован.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка добавление статуса.');
            }
        }
        return $this->redirect('/');
    }

    public function actionDelete($id)
    {
        $objReport = StatusReports::findOne((int)$id);
        if ($objReport && $objReport->user_id==Yii::$app->user->id) {
            Yii::$app->session->setFlash('success', 'Статус успешно удален.');
            $objReport->delete();
        }
        return $this->redirect('/');
    }
} 