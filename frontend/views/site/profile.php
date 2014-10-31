<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\User */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'options' => ['enctype'=>'multipart/form-data']
            ]); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'surname') ?>
                <?= $form->field($model, 'image')->fileInput() ?>
                <div>
                    <?php if ($model->avatar) { ?>
                        <?= Html::img($model->getUrlAvatar()) ?>
                    <?php } ?>
                </div>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
