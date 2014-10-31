<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-signup',
        'options' => ['enctype'=>'multipart/form-data', 'autocomplete'=>'off']
    ]); ?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'surname') ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
