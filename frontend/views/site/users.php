<?php
/**
 * @var \common\models\User $attrUsers[]
 */
use yii\helpers\Html;

?>
<table class="table table-hover">
    <thead>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Email</th>
        <th>Аватарка</th>
    </thead>
    <tbody>
        <?php foreach ($attrUsers as $objUser) { ?>
            <tr>
                <td><?= Html::a(Html::encode($objUser->username), ['user/reports', 'id'=>$objUser->id]) ?></td>
                <td><?= Html::encode($objUser->surname) ?></td>
                <td><?= Html::encode($objUser->email) ?></td>
                <td><?= Html::img($objUser->getUrlAvatar()) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
