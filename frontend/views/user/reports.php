<?php
use common\models\StatusReports;
use common\models\User;
use yii\helpers\Html;

/**
 * @var StatusReports[] $attrReports
 * @var User $objUser
 */
$objDate = new \common\libs\Date();
?>

<h1>Все репорты пользователя <?= Html::encode($objUser->username) ?></h1>

<?php if ($attrReports) { ?>
    <?php foreach ($attrReports as $objStatusReport) { ?>
        <div>
            <time><?= $objDate->format($objStatusReport->created_at, 'Y-m-d H:i:s') ?></time>
            <?= Html::encode($objStatusReport->title) ?>
        </div>
    <?php } ?>
<?php } ?>