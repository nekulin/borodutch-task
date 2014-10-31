<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $attrReports common\models\StatusReports[] */
$this->title = 'Status Report Borodutch';
$objDate = new \common\libs\Date();
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Status Report Borodutch!</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <?php if (Yii::$app->user->isGuest) { ?>
                <div class="col-lg-12">
                    <img src="/images/logo411.png" />
                </div>
            <?php } else { ?>
            <div class="col-lg-12">
                <h3>Status Report</h3>
                <div class="user-form">
                    <?php $form = ActiveForm::begin([
                        'id' => 'form-status-report',
                        'action' => ['report/create'],
                        'options' => ['autocomplete'=>'off']
                    ]); ?>
                    <?= $form->field($model, 'title')->textarea() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
                <div>
                    <?php if ($attrReports) { ?>
                        <?php foreach ($attrReports as $objStatusReport) { ?>
                            <div>
                                <time><?= $objDate->format($objStatusReport->created_at, 'Y-m-d H:i:s') ?></time>
                                <?= Html::encode($objStatusReport->title) ?>
                                <?= Html::a('<i class="glyphicon glyphicon-remove-circle"></i>', ['report/delete', 'id'=>$objStatusReport->id]) ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php  } ?>
        </div>

    </div>
</div>
